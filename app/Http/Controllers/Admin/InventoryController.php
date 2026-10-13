<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\Inventory;
use App\Models\InventoryMovement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InventoryController extends Controller
{
    public function index(Request $request): View
    {
        $query = Inventory::with(['variant.product.primaryImage'])->latest();

        if ($request->filled('status')) {
            if ($request->string('status') === 'low_stock') {
                $query->whereColumn('quantity', '<=', 'low_stock_threshold')
                      ->where('quantity', '>', 0);
            } elseif ($request->string('status') === 'out_of_stock') {
                $query->where('quantity', '<=', 0);
            } elseif ($request->string('status') === 'in_stock') {
                $query->whereColumn('quantity', '>', 'low_stock_threshold');
            }
        }

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->whereHas('variant', function ($v) use ($search) {
                $v->where('sku', 'like', "%{$search}%")
                  ->orWhereHas('product', function ($p) use ($search) {
                      $p->where('name', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%");
                  });
            });
        }

        $inventories = $query->paginate(20)->withQueryString();

        $stats = [
            'total_items' => Inventory::sum('quantity'),
            'low_stock' => Inventory::whereColumn('quantity', '<=', 'low_stock_threshold')->where('quantity', '>', 0)->count(),
            'out_of_stock' => Inventory::where('quantity', '<=', 0)->count(),
            'reserved' => Inventory::sum('reserved_quantity'),
        ];

        $recentMovements = InventoryMovement::with(['inventory.variant.product', 'user'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.inventory.index', compact('inventories', 'stats', 'recentMovements'));
    }

    public function adjust(Request $request, Inventory $inventory): RedirectResponse
    {
        $type = $request->input('type');
        if ($type === 'subtract' || $type === 'deduct') {
            $type = 'remove';
        } elseif (strtolower($type) === 'restock') {
            $type = 'add';
        }

        $amount = (int) $request->input('amount', $request->input('adjustment', $request->input('quantity_change', 1)));
        $reason = (string) $request->input('reason', 'Manual Vault Adjustment by Staff');

        $request->merge([
            'type' => $type,
            'amount' => $amount,
            'reason' => $reason,
        ]);

        $request->validate([
            'type' => ['required', 'in:set,add,remove'],
            'amount' => ['required', 'integer', 'min:1'],
            'reason' => ['nullable', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($inventory, $type, $amount, $reason) {
            $prev = $inventory->quantity;
            $new = match ($type) {
                'add' => $prev + $amount,
                'remove' => max(0, $prev - $amount),
                'set' => $amount,
            };

            $diff = $new - $prev;

            $inventory->update(['quantity' => $new]);

            InventoryMovement::create([
                'inventory_id' => $inventory->id,
                'user_id' => auth()->id(),
                'type' => 'adjustment',
                'quantity_change' => $diff,
                'previous_quantity' => $prev,
                'new_quantity' => $new,
                'reason' => $reason,
            ]);

            $productName = $inventory->variant?->product?->name ?? 'Item';
            AdminActivityLog::record("Manual stock adjustment for '{$productName}' from {$prev} to {$new}", $inventory);
        });

        return back()->with('toast', [
            'type' => 'success',
            'message' => 'Vault stock successfully adjusted.',
        ]);
    }
}
