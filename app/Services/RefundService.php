<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Refund;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class RefundService
{
    public function __construct(
        protected InventoryService $inventoryService
    ) {}

    /**
     * Process an order refund and optionally restock items.
     */
    public function processRefund(
        Order $order,
        float $amount,
        string $reason,
        bool $restock = true,
        ?User $adminUser = null
    ): Refund {
        if ($amount > (float) $order->total_amount) {
            throw new InvalidArgumentException("Refund amount cannot exceed order total.");
        }

        return DB::transaction(function () use ($order, $amount, $reason, $restock, $adminUser) {
            $payment = $order->latestPayment;

            $refund = Refund::create([
                'order_id' => $order->id,
                'payment_id' => $payment?->id,
                'refund_number' => Refund::generateRefundNumber(),
                'amount' => $amount,
                'reason' => $reason,
                'status' => Refund::STATUS_PROCESSED,
                'processed_by' => $adminUser?->id ?? auth()->id(),
                'processed_at' => now(),
            ]);

            if ($restock) {
                foreach ($order->items as $item) {
                    if ($item->variant) {
                        $this->inventoryService->adjustStock(
                            variant: $item->variant,
                            quantityChange: $item->quantity,
                            type: 'refund_restock',
                            reason: "Restock for refund {$refund->refund_number}",
                            reference: $refund,
                            user: $adminUser
                        );
                    }
                }
            }

            $isFullRefund = $amount >= (float) $order->total_amount;
            $order->update([
                'status' => $isFullRefund ? Order::STATUS_REFUNDED : $order->status,
                'payment_status' => $isFullRefund ? Order::PAYMENT_REFUNDED : Order::PAYMENT_PARTIALLY_REFUNDED,
            ]);

            if ($payment && $isFullRefund) {
                $payment->update(['status' => Payment::STATUS_REFUNDED]);
            }

            return $refund;
        });
    }
}
