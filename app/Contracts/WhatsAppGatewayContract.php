<?php

namespace App\Contracts;

use App\Models\Order;

interface WhatsAppGatewayContract
{
    /**
     * Send a transactional WhatsApp notification.
     */
    public function sendMessage(string $phoneNumber, string $templateName, array $parameters = []): bool;

    /**
     * Send Order Status Update via WhatsApp.
     */
    public function sendOrderStatus(Order $order, string $statusMessage): bool;
}
