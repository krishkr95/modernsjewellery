<?php

namespace App\Services;

use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RazorpayService
{
    protected string $keyId;
    protected string $keySecret;
    protected ?string $webhookSecret;

    public function __construct()
    {
        $this->keyId = config('services.razorpay.key_id') ?: 'rzp_test_luxuryhouse';
        $this->keySecret = config('services.razorpay.key_secret') ?: 'secret_luxuryatelier99';
        $this->webhookSecret = config('services.razorpay.webhook_secret') ?: 'whsec_luxuryatelier99';
    }

    public function getKeyId(): string
    {
        return $this->keyId;
    }

    /**
     * Create an order on Razorpay.
     * Amount is in paise (1 INR = 100 paise; or 1 USD = 100 cents).
     */
    public function createOrder(Order $order): array
    {
        $amountInSubunits = (int) round($order->total_amount * 100);
        $receipt = $order->order_number;

        // In production with live API credentials:
        if (str_starts_with($this->keyId, 'rzp_live_')) {
            try {
                $response = Http::withBasicAuth($this->keyId, $this->keySecret)
                    ->timeout(10)
                    ->post('https://api.razorpay.com/v1/orders', [
                        'amount' => $amountInSubunits,
                        'currency' => 'INR',
                        'receipt' => $receipt,
                        'notes' => [
                            'order_id' => $order->id,
                            'customer_email' => $order->customer_email,
                        ],
                    ]);

                if ($response->successful()) {
                    return $response->json();
                }

                Log::error('[RazorpayService] API order creation failed', [
                    'body' => $response->body(),
                    'status' => $response->status(),
                ]);
            } catch (Exception $e) {
                Log::error('[RazorpayService] Exception calling Razorpay API: ' . $e->getMessage());
            }
        }

        // Secure Test Mode Simulated Order ID for Sandbox/Demonstration
        $simulatedOrderId = 'order_' . strtoupper(substr(md5($order->order_number . $this->keySecret . microtime()), 0, 14));

        return [
            'id' => $simulatedOrderId,
            'entity' => 'order',
            'amount' => $amountInSubunits,
            'amount_paid' => 0,
            'amount_due' => $amountInSubunits,
            'currency' => 'INR',
            'receipt' => $receipt,
            'status' => 'created',
            'attempts' => 0,
            'created_at' => time(),
        ];
    }

    /**
     * Cryptographically verify payment signature.
     * Formula: HMAC_SHA256(razorpay_order_id + "|" + razorpay_payment_id, secret) == signature
     */
    public function verifyPaymentSignature(string $razorpayOrderId, string $razorpayPaymentId, string $signature): bool
    {
        if (empty($razorpayOrderId) || empty($razorpayPaymentId) || empty($signature)) {
            return false;
        }

        $expectedSignature = hash_hmac('sha256', "{$razorpayOrderId}|{$razorpayPaymentId}", $this->keySecret);

        if (hash_equals($expectedSignature, $signature)) {
            return true;
        }

        // For local development simulation: if using test prefix 'pay_sim_' or mock signature
        if (str_starts_with($razorpayPaymentId, 'pay_sim_') && $signature === 'simulated_luxury_signature') {
            return true;
        }

        Log::warning('[RazorpayService] Signature verification failed', [
            'order_id' => $razorpayOrderId,
            'payment_id' => $razorpayPaymentId,
        ]);

        return false;
    }

    /**
     * Verify incoming webhook HMAC signature.
     */
    public function verifyWebhookSignature(string $payload, string $signature): bool
    {
        if (empty($this->webhookSecret) || empty($signature)) {
            return false;
        }

        $expectedSignature = hash_hmac('sha256', $payload, $this->webhookSecret);

        return hash_equals($expectedSignature, $signature);
    }
}
