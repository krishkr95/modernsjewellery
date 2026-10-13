<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;
use App\Services\RazorpayService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(
        protected OrderService $orderService,
        protected RazorpayService $razorpayService
    ) {}

    public function index(Request $request): View|RedirectResponse
    {
        $cart = CartController::getActiveCart($request);

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('toast', [
                'type' => 'error',
                'message' => 'Your shopping bag is empty. Please select a fine jewellery creation first.',
            ]);
        }

        $subtotal = $cart->subtotal;
        $discount = (float) $cart->discount_amount;
        $shipping = 0.00; // Complimentary Insured Courier
        $tax = round(($subtotal - $discount) * 0.08, 2);
        $total = max(0, $subtotal - $discount + $shipping + $tax);

        $user = Auth::user();

        return view('pages.checkout.index', compact(
            'cart',
            'subtotal',
            'discount',
            'shipping',
            'tax',
            'total',
            'user'
        ));
    }

    /**
     * Process checkout form, validate Indian pincode, lock inventory & create Razorpay order.
     */
    public function process(Request $request): JsonResponse
    {
        $request->validate([
            // CONTACT
            'email' => ['required', 'email:rfc,dns', 'max:150'],
            'phone' => ['required', 'regex:/^[0-9+ -]{10,15}$/'],
            // DELIVERY ADDRESS
            'name' => ['required', 'string', 'max:100'],
            'address_line1' => ['required', 'string', 'max:255'],
            'address_line2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            // Valid Indian 6-digit Pincode (starts with 1-9)
            'pincode' => ['required', 'regex:/^[1-9][0-9]{5}$/'],
            'customer_notes' => ['nullable', 'string', 'max:500'],
        ], [
            'pincode.regex' => 'Please provide a valid 6-digit Indian delivery pincode (e.g. 400001, 110001).',
            'phone.regex' => 'Please enter a valid contact phone number.',
        ]);

        $cart = CartController::getActiveCart($request);

        if ($cart->items->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Your shopping bag is empty.',
            ], 422);
        }

        try {
            $shippingAddress = [
                'full_name' => $request->string('name'),
                'address_line1' => $request->string('address_line1'),
                'address_line2' => $request->string('address_line2'),
                'city' => $request->string('city'),
                'state' => $request->string('state'),
                'pincode' => $request->string('pincode'),
                'country' => 'India',
                'phone' => $request->string('phone'),
            ];

            // Create order with strict row-locking inventory validation
            $order = $this->orderService->createFromCart(
                cart: $cart,
                shippingAddress: $shippingAddress,
                billingAddress: $shippingAddress,
                customerEmail: $request->string('email'),
                customerPhone: $request->string('phone'),
                customerNotes: $request->string('customer_notes'),
                user: Auth::user()
            );

            // Generate Razorpay Order
            $razorpayOrder = $this->razorpayService->createOrder($order);
            $order->update([
                'razorpay_order_id' => $razorpayOrder['id'],
            ]);

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'razorpay_order_id' => $razorpayOrder['id'],
                'amount' => $razorpayOrder['amount'],
                'currency' => $razorpayOrder['currency'],
                'razorpay_key' => $this->razorpayService->getKeyId(),
                'customer' => [
                    'name' => $request->string('name'),
                    'email' => $order->customer_email,
                    'phone' => $order->customer_phone,
                ],
            ]);
        } catch (Exception $e) {
            Log::error('[CheckoutController] Process failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Server-side cryptographic payment verification.
     */
    public function verify(Request $request): JsonResponse
    {
        $request->validate([
            'order_id' => ['required', 'exists:orders,id'],
            'razorpay_order_id' => ['required', 'string'],
            'razorpay_payment_id' => ['required', 'string'],
            'razorpay_signature' => ['required', 'string'],
        ]);

        $order = Order::findOrFail($request->integer('order_id'));

        // Cryptographic HMAC SHA256 Signature Verification
        $isValid = $this->razorpayService->verifyPaymentSignature(
            razorpayOrderId: $request->string('razorpay_order_id'),
            razorpayPaymentId: $request->string('razorpay_payment_id'),
            signature: $request->string('razorpay_signature')
        );

        if (!$isValid) {
            $this->orderService->markPaymentFailed($order, 'Cryptographic signature mismatch');

            return response()->json([
                'success' => false,
                'message' => 'Your payment could not be completed. Signature authentication failed.',
            ], 422);
        }

        // Mark Order as Paid and trigger notifications
        $this->orderService->markAsPaid(
            order: $order,
            paymentId: $request->string('razorpay_payment_id'),
            signature: $request->string('razorpay_signature'),
            gatewayPayload: $request->all()
        );

        // Delete active cart items now that purchase is verified
        $cart = CartController::getActiveCart($request);
        $cart->items()->delete();
        $cart->update(['coupon_code' => null, 'discount_amount' => 0.00, 'status' => 'converted']);

        return response()->json([
            'success' => true,
            'message' => 'Payment successfully verified by Razorpay.',
            'redirect_url' => route('checkout.confirmation', $order->order_number),
        ]);
    }

    /**
     * Razorpay Asynchronous Webhook Endpoint for payment reconciliation.
     */
    public function webhook(Request $request): JsonResponse
    {
        $rawPayload = $request->getContent();
        $signature = $request->header('X-Razorpay-Signature', '');

        if (!$this->razorpayService->verifyWebhookSignature($rawPayload, $signature)) {
            Log::warning('[CheckoutController] Webhook signature invalid.');
            return response()->json(['status' => 'invalid_signature'], 400);
        }

        $data = json_decode($rawPayload, true);
        $event = $data['event'] ?? '';

        Log::info("[CheckoutController] Razorpay Webhook Event: {$event}");

        if (in_array($event, ['payment.captured', 'order.paid'])) {
            $paymentEntity = $data['payload']['payment']['entity'] ?? [];
            $razorpayOrderId = $paymentEntity['order_id'] ?? null;
            $paymentId = $paymentEntity['id'] ?? null;

            if ($razorpayOrderId) {
                $order = Order::where('razorpay_order_id', $razorpayOrderId)->first();
                if ($order && !$order->isPaid()) {
                    $this->orderService->markAsPaid(
                        order: $order,
                        paymentId: $paymentId,
                        signature: 'webhook_reconciled',
                        gatewayPayload: $data
                    );
                    Log::info("[CheckoutController] Order {$order->order_number} reconciled via webhook.");
                }
            }
        } elseif ($event === 'payment.failed') {
            $paymentEntity = $data['payload']['payment']['entity'] ?? [];
            $razorpayOrderId = $paymentEntity['order_id'] ?? null;

            if ($razorpayOrderId) {
                $order = Order::where('razorpay_order_id', $razorpayOrderId)->first();
                if ($order && !$order->isPaid()) {
                    $this->orderService->markPaymentFailed($order, $paymentEntity['error_description'] ?? 'Webhook payment failure');
                }
            }
        }

        return response()->json(['status' => 'ok']);
    }

    /**
     * Order Confirmation Presentation.
     */
    public function confirmation(string $orderNumber): View
    {
        $order = Order::where('order_number', $orderNumber)
            ->with(['items.product.primaryImage', 'payments'])
            ->firstOrFail();

        return view('pages.checkout.confirmation', compact('order'));
    }

    /**
     * Real-time Order Tracking Timeline across all 10 states.
     */
    public function track(string $orderNumber): View
    {
        $order = Order::where('order_number', $orderNumber)
            ->with(['items.product.primaryImage', 'payments'])
            ->firstOrFail();

        return view('pages.orders.track', compact('order'));
    }
}
