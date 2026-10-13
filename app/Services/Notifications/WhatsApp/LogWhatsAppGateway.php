<?php

namespace App\Services\Notifications\WhatsApp;

use App\Contracts\WhatsAppGatewayContract;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class LogWhatsAppGateway implements WhatsAppGatewayContract
{
    public function sendMessage(string $phoneNumber, string $templateName, array $parameters = []): bool
    {
        Log::channel('single')->info("[WhatsApp Notification Service] Template: {$templateName} to {$phoneNumber}", [
            'parameters' => $parameters,
            'sent_at' => now()->toIso8601String(),
        ]);

        return true;
    }

    public function sendOrderStatus(Order $order, string $statusMessage): bool
    {
        if (empty($order->customer_phone)) {
            return false;
        }

        return $this->sendMessage(
            phoneNumber: $order->customer_phone,
            templateName: 'order_status_update',
            parameters: [
                'order_number' => $order->order_number,
                'status' => $order->status,
                'message' => $statusMessage,
                'total' => $order->formatted_total,
                'expected_delivery' => $order->expected_delivery_at?->format('M d, Y') ?? '3-5 business days',
            ]
        );
    }
}
