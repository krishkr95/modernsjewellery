<?php

namespace App\Services\Notifications;

use App\Contracts\WhatsAppGatewayContract;
use App\Mail\DeliveryNotificationMail;
use App\Mail\OrderCancellationMail;
use App\Mail\OrderConfirmationMail;
use App\Mail\PaymentConfirmationMail;
use App\Mail\RefundProcessedMail;
use App\Mail\ShippingNotificationMail;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Refund;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function __construct(
        protected WhatsAppGatewayContract $whatsAppGateway
    ) {}

    /**
     * Send order confirmation via Email & WhatsApp.
     */
    public function sendOrderConfirmation(Order $order): void
    {
        try {
            Mail::to($order->customer_email)->send(new OrderConfirmationMail($order));
        } catch (\Throwable $e) {
            Log::warning("[NotificationService] Order confirmation email failed: " . $e->getMessage());
        }

        $this->whatsAppGateway->sendOrderStatus(
            $order,
            "Your bespoke order {$order->order_number} has been received and confirmed by Modern Jewellery House."
        );
    }

    /**
     * Send payment confirmation via Email & WhatsApp.
     */
    public function sendPaymentConfirmation(Order $order, Payment $payment): void
    {
        try {
            Mail::to($order->customer_email)->send(new PaymentConfirmationMail($order, $payment));
        } catch (\Throwable $e) {
            Log::warning("[NotificationService] Payment confirmation email failed: " . $e->getMessage());
        }

        $this->whatsAppGateway->sendOrderStatus(
            $order,
            "Payment for order {$order->order_number} ({$order->formatted_total}) has been securely verified by Razorpay."
        );
    }

    /**
     * Send shipping notification via Email & WhatsApp.
     */
    public function sendShippingNotification(Order $order): void
    {
        try {
            Mail::to($order->customer_email)->send(new ShippingNotificationMail($order));
        } catch (\Throwable $e) {
            Log::warning("[NotificationService] Shipping email failed: " . $e->getMessage());
        }

        $this->whatsAppGateway->sendOrderStatus(
            $order,
            "Your creation {$order->order_number} has shipped via armored white-glove courier. Tracking: {$order->tracking_number}."
        );
    }

    /**
     * Send delivery notification.
     */
    public function sendDeliveryNotification(Order $order): void
    {
        try {
            Mail::to($order->customer_email)->send(new DeliveryNotificationMail($order));
        } catch (\Throwable $e) {
            Log::warning("[NotificationService] Delivery email failed: " . $e->getMessage());
        }

        $this->whatsAppGateway->sendOrderStatus(
            $order,
            "Your order {$order->order_number} has arrived safely and was signed for."
        );
    }

    /**
     * Send order cancellation notification.
     */
    public function sendCancellationNotification(Order $order): void
    {
        try {
            Mail::to($order->customer_email)->send(new OrderCancellationMail($order));
        } catch (\Throwable $e) {
            Log::warning("[NotificationService] Cancellation email failed: " . $e->getMessage());
        }

        $this->whatsAppGateway->sendOrderStatus(
            $order,
            "Your order {$order->order_number} has been cancelled per your request."
        );
    }

    /**
     * Send refund notification.
     */
    public function sendRefundNotification(Order $order, Refund $refund): void
    {
        try {
            Mail::to($order->customer_email)->send(new RefundProcessedMail($order, $refund));
        } catch (\Throwable $e) {
            Log::warning("[NotificationService] Refund email failed: " . $e->getMessage());
        }

        $this->whatsAppGateway->sendOrderStatus(
            $order,
            "A refund of \${$refund->amount} has been processed back to your original payment method for order {$order->order_number}."
        );
    }
}
