<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    /**
     * Process or record an order payment.
     */
    public function capturePayment(
        Order $order,
        string $paymentMethod = 'card',
        ?string $transactionId = null,
        ?array $gatewayPayload = null
    ): Payment {
        return DB::transaction(function () use ($order, $paymentMethod, $transactionId, $gatewayPayload) {
            $payment = Payment::create([
                'order_id' => $order->id,
                'payment_reference' => Payment::generatePaymentReference(),
                'payment_method' => $paymentMethod,
                'amount' => $order->total_amount,
                'currency' => $order->currency,
                'status' => Payment::STATUS_CAPTURED,
                'gateway_transaction_id' => $transactionId ?? 'txn_' . bin2hex(random_bytes(8)),
                'gateway_payload' => $gatewayPayload ?? ['status' => 'succeeded', 'mode' => 'simulated_luxury_gateway'],
                'paid_at' => now(),
            ]);

            $order->update([
                'status' => Order::STATUS_PROCESSING,
                'payment_status' => Order::PAYMENT_PAID,
                'paid_at' => now(),
            ]);

            return $payment;
        });
    }
}
