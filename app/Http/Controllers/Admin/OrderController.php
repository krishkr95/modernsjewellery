<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\Inventory;
use App\Models\InventoryMovement;
use App\Models\Order;
use App\Models\Refund;
use App\Services\Notifications\NotificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(
        protected NotificationService $notificationService
    ) {}

    public function index(Request $request): View
    {
        $query = Order::with(['user', 'items.product'])->latest();

        if ($request->filled('status') && $request->string('status') !== 'all') {
            $status = strtoupper($request->string('status'));
            $query->where('status', $status);
        }

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%")
                  ->orWhere('shipping_address', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(15)->withQueryString();

        $statusCounts = [
            'all' => Order::count(),
            'pending' => Order::where('status', Order::STATUS_PENDING)->count(),
            'processing' => Order::where('status', Order::STATUS_PROCESSING)->count(),
            'shipped' => Order::where('status', Order::STATUS_SHIPPED)->count(),
            'delivered' => Order::where('status', Order::STATUS_DELIVERED)->count(),
            'cancelled' => Order::where('status', Order::STATUS_CANCELLED)->count(),
            'refunded' => Order::where('status', Order::STATUS_REFUNDED)->count(),
        ];

        $totalSales = (float) Order::where('status', '!=', Order::STATUS_CANCELLED)->sum('total_amount');
        $totalOrdersCount = $statusCounts['all'];
        $completedOrdersCount = $statusCounts['delivered'];
        $cancelledOrdersCount = $statusCounts['cancelled'];

        return view('admin.orders.index', compact(
            'orders',
            'statusCounts',
            'totalSales',
            'totalOrdersCount',
            'completedOrdersCount',
            'cancelledOrdersCount'
        ));
    }

    public function show(Order $order): View
    {
        $order->load(['user', 'items.product.primaryImage', 'items.variant', 'payment', 'refunds']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'string'],
            'tracking_number' => ['nullable', 'string', 'max:100'],
            'admin_notes' => ['nullable', 'string', 'max:500'],
        ]);

        $newStatus = strtoupper($request->string('status'));
        $oldStatus = $order->status;

        $updateData = ['status' => $newStatus];

        if ($request->filled('tracking_number')) {
            $updateData['tracking_number'] = $request->string('tracking_number');
        }

        if ($request->filled('admin_notes')) {
            $updateData['admin_notes'] = $request->string('admin_notes');
        }

        if ($newStatus === Order::STATUS_PROCESSING && !$order->paid_at) {
            $updateData['paid_at'] = now();
            $updateData['payment_status'] = Order::PAYMENT_PAID;
        }

        if ($newStatus === Order::STATUS_SHIPPED) {
            $updateData['shipped_at'] = now();
        }

        if ($newStatus === Order::STATUS_DELIVERED) {
            $updateData['delivered_at'] = now();
        }

        if ($newStatus === Order::STATUS_CANCELLED) {
            $updateData['cancelled_at'] = now();
        }

        $order->update($updateData);

        // Notify client based on status
        try {
            if ($newStatus === Order::STATUS_SHIPPED) {
                $this->notificationService->sendShippingNotification($order);
            } elseif ($newStatus === Order::STATUS_DELIVERED) {
                $this->notificationService->sendDeliveryNotification($order);
            } elseif ($newStatus === Order::STATUS_CANCELLED) {
                $this->notificationService->sendOrderCancellation($order);
            }
        } catch (\Throwable $e) {
            // Logged inside NotificationService
        }

        AdminActivityLog::record("Updated order #{$order->order_number} status from {$oldStatus} to {$newStatus}", $order);

        return back()->with('toast', [
            'type' => 'success',
            'message' => "Order #{$order->order_number} marked as {$newStatus}.",
        ]);
    }

    public function refund(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:1', "max:{$order->total_amount}"],
            'reason' => ['required', 'string', 'max:255'],
            'restock' => ['nullable', 'boolean'],
        ]);

        $amount = (float) $request->input('amount');
        $reason = $request->string('reason');
        $shouldRestock = $request->boolean('restock');

        DB::transaction(function () use ($order, $amount, $reason, $shouldRestock) {
            $refund = Refund::create([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'refund_number' => 'REF-' . date('ymd') . '-' . strtoupper(Str::random(5)),
                'amount' => $amount,
                'currency' => $order->currency ?: 'INR',
                'status' => 'processed',
                'reason' => $reason,
                'processed_at' => now(),
            ]);

            $isFull = $amount >= (float) $order->total_amount;
            $order->update([
                'status' => $isFull ? Order::STATUS_REFUNDED : $order->status,
                'payment_status' => $isFull ? Order::PAYMENT_REFUNDED : Order::PAYMENT_PARTIALLY_REFUNDED,
            ]);

            // Restock items if requested
            if ($shouldRestock) {
                foreach ($order->items as $item) {
                    $inventory = Inventory::where('product_variant_id', $item->product_variant_id)->first();
                    if ($inventory) {
                        $prev = $inventory->quantity;
                        $inventory->increment('quantity', $item->quantity);

                        InventoryMovement::create([
                            'inventory_id' => $inventory->id,
                            'user_id' => auth()->id(),
                            'type' => 'refund_restock',
                            'quantity_change' => $item->quantity,
                            'previous_quantity' => $prev,
                            'new_quantity' => $prev + $item->quantity,
                            'reason' => "Refund #{$refund->refund_number} restock for order #{$order->order_number}",
                        ]);
                    }
                }
            }

            try {
                $this->notificationService->sendRefundNotification($order, $refund);
            } catch (\Throwable $e) {}

            AdminActivityLog::record("Issued refund of ₹{$amount} for order #{$order->order_number}", $order, ['reason' => $reason]);
        });

        return back()->with('toast', [
            'type' => 'success',
            'message' => "Refund of ₹{$amount} recorded successfully.",
        ]);
    }
}
