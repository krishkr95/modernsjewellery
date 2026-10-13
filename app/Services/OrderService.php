<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
use App\Services\Notifications\NotificationService;
use Exception;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class OrderService
{
    public function __construct(
        protected InventoryService $inventoryService,
        protected CouponService $couponService,
        protected NotificationService $notificationService
    ) {}

    /**
     * Create an order from a shopping cart with strict database locking & stock validation.
     */
    public function createFromCart(
        Cart $cart,
        array $shippingAddress,
        array $billingAddress,
        string $customerEmail,
        ?string $customerPhone = null,
        ?string $customerNotes = null,
        ?User $user = null
    ): Order {
        if ($cart->items->isEmpty()) {
            throw new InvalidArgumentException("Cannot create an order from an empty cart.");
        }

        return DB::transaction(function () use (
            $cart,
            $shippingAddress,
            $billingAddress,
            $customerEmail,
            $customerPhone,
            $customerNotes,
            $user
        ) {
            // 1. Strict Server-Side Stock Validation with Row Locks
            foreach ($cart->items as $item) {
                $inventory = Inventory::where('product_variant_id', $item->product_variant_id)
                    ->lockForUpdate()
                    ->first();

                if ($inventory && $inventory->available_quantity < $item->quantity) {
                    throw new Exception("Insufficient atelier stock for '{$item->product->name}'. Only {$inventory->available_quantity} available.");
                }
            }

            // 2. Strict Server-Side Pricing Recalculation (Never trust client)
            $subtotal = 0;
            foreach ($cart->items as $item) {
                $actualPrice = (float) ($item->variant->price ?: $item->product->base_price);
                $subtotal += ($actualPrice * $item->quantity);
            }

            $discount = 0.00;
            if ($cart->coupon_code) {
                $coupon = Coupon::where('code', $cart->coupon_code)->first();
                if ($coupon && $coupon->isValidFor($subtotal, $user?->id ?? $cart->user_id)) {
                    $discount = (float) $coupon->calculateDiscount($subtotal);
                }
            }

            // Luxury Complimentary Courier ($0.00) or Express Concierge ($50.00)
            $shippingFee = 0.00;
            $taxRate = 0.08; // 8% standard luxury tax
            $taxAmount = round(max(0, $subtotal - $discount) * $taxRate, 2);
            $totalAmount = round(max(0, $subtotal - $discount + $shippingFee + $taxAmount), 2);

            // 3. Create Order in PAYMENT_PENDING state
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => $user?->id ?? $cart->user_id,
                'customer_email' => $customerEmail,
                'customer_phone' => $customerPhone,
                'pincode' => $shippingAddress['pincode'] ?? null,
                'status' => Order::STATUS_PAYMENT_PENDING,
                'payment_status' => Order::PAYMENT_UNPAID,
                'currency' => 'USD',
                'subtotal' => $subtotal,
                'discount_amount' => $discount,
                'coupon_code' => $cart->coupon_code,
                'shipping_fee' => $shippingFee,
                'tax_amount' => $taxAmount,
                'total_amount' => $totalAmount,
                'shipping_address' => $shippingAddress,
                'billing_address' => $billingAddress,
                'shipping_method' => 'Complimentary Insured Courier & White-Glove Delivery',
                'customer_notes' => $customerNotes,
                'expected_delivery_at' => now()->addDays(4),
            ]);

            // 4. Create Order Items & Reserve Inventory
            foreach ($cart->items as $item) {
                $unitPrice = (float) ($item->variant->price ?: $item->product->base_price);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_variant_id' => $item->product_variant_id,
                    'product_name' => $item->product->name,
                    'variant_title' => $item->variant->title,
                    'sku' => $item->variant->sku,
                    'unit_price' => $unitPrice,
                    'quantity' => $item->quantity,
                    'subtotal' => $unitPrice * $item->quantity,
                    'custom_engraving' => $item->custom_engraving,
                ]);

                // Atomically deduct inventory
                $this->inventoryService->adjustStock(
                    variant: $item->variant,
                    quantityChange: -$item->quantity,
                    type: 'sale',
                    reason: "Order {$order->order_number}",
                    reference: $order,
                    user: $user
                );
            }

            if ($order->coupon_code && $user) {
                $coupon = Coupon::where('code', $order->coupon_code)->first();
                if ($coupon) {
                    $this->couponService->recordUsage($coupon, $order, $user, $discount);
                }
            }

            // Do not delete cart immediately until payment is authorized, but mark status
            // Keep cart active until payment verification, then converted

            return $order;
        });
    }

    /**
     * Mark an order as securely paid following Razorpay verification.
     */
    public function markAsPaid(
        Order $order,
        string $paymentId,
        ?string $signature = null,
        ?array $gatewayPayload = null
    ): Payment {
        return DB::transaction(function () use ($order, $paymentId, $signature, $gatewayPayload) {
            // Check if already paid to ensure idempotency
            $existingPayment = Payment::where('gateway_transaction_id', $paymentId)->first();
            if ($existingPayment && $order->isPaid()) {
                return $existingPayment;
            }

            $payment = Payment::create([
                'order_id' => $order->id,
                'payment_reference' => Payment::generatePaymentReference(),
                'payment_method' => 'razorpay',
                'amount' => $order->total_amount,
                'currency' => $order->currency,
                'status' => Payment::STATUS_CAPTURED,
                'gateway_transaction_id' => $paymentId,
                'gateway_order_id' => $order->razorpay_order_id,
                'gateway_signature' => $signature,
                'gateway_payload' => $gatewayPayload ?: ['gateway' => 'razorpay', 'verified_at' => now()->toIso8601String()],
                'paid_at' => now(),
            ]);

            $order->update([
                'status' => Order::STATUS_PAID,
                'payment_status' => Order::PAYMENT_PAID,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signature,
                'paid_at' => now(),
            ]);

            // Dispatch asynchronous notifications via service layer
            $this->notificationService->sendOrderConfirmation($order);
            $this->notificationService->sendPaymentConfirmation($order, $payment);

            return $payment;
        });
    }

    /**
     * Mark payment as failed without falsely altering order status.
     */
    public function markPaymentFailed(Order $order, string $reason = 'Payment transaction failed or cancelled'): void
    {
        $order->update([
            'payment_status' => Order::PAYMENT_FAILED,
            'admin_notes' => "Payment attempt failed: {$reason} at " . now(),
        ]);
    }
}
