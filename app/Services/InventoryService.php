<?php

namespace App\Services;

use App\Models\Inventory;
use App\Models\InventoryMovement;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class InventoryService
{
    /**
     * Adjust inventory with an audit movement entry.
     */
    public function adjustStock(
        ProductVariant $variant,
        int $quantityChange,
        string $type,
        ?string $reason = null,
        ?Model $reference = null,
        ?User $user = null
    ): Inventory {
        return DB::transaction(function () use ($variant, $quantityChange, $type, $reason, $reference, $user) {
            $inventory = Inventory::firstOrCreate(
                ['product_variant_id' => $variant->id],
                ['quantity' => 0, 'reserved_quantity' => 0]
            );

            $previousQuantity = $inventory->quantity;
            $newQuantity = $previousQuantity + $quantityChange;

            if ($newQuantity < 0 && !$inventory->allow_backorder) {
                throw new InvalidArgumentException("Insufficient inventory for SKU: {$variant->sku}");
            }

            $inventory->update(['quantity' => $newQuantity]);

            InventoryMovement::create([
                'inventory_id' => $inventory->id,
                'user_id' => $user?->id ?? auth()->id(),
                'type' => $type,
                'quantity_change' => $quantityChange,
                'previous_quantity' => $previousQuantity,
                'new_quantity' => $newQuantity,
                'reference_type' => $reference ? get_class($reference) : null,
                'reference_id' => $reference?->getKey(),
                'reason' => $reason,
            ]);

            return $inventory;
        });
    }

    /**
     * Reserve inventory for a pending checkout.
     */
    public function reserveStock(ProductVariant $variant, int $quantity): bool
    {
        return DB::transaction(function () use ($variant, $quantity) {
            $inventory = Inventory::where('product_variant_id', $variant->id)->lockForUpdate()->first();

            if (!$inventory || ($inventory->available_quantity < $quantity && !$inventory->allow_backorder)) {
                return false;
            }

            $inventory->increment('reserved_quantity', $quantity);

            InventoryMovement::create([
                'inventory_id' => $inventory->id,
                'user_id' => auth()->id(),
                'type' => 'reservation',
                'quantity_change' => $quantity,
                'previous_quantity' => $inventory->quantity,
                'new_quantity' => $inventory->quantity,
                'reason' => 'Cart or order reservation',
            ]);

            return true;
        });
    }

    /**
     * Release reserved stock (e.g. abandoned cart or cancelled checkout).
     */
    public function releaseStock(ProductVariant $variant, int $quantity): void
    {
        DB::transaction(function () use ($variant, $quantity) {
            $inventory = Inventory::where('product_variant_id', $variant->id)->lockForUpdate()->first();

            if ($inventory) {
                $releaseAmount = min($inventory->reserved_quantity, $quantity);
                $inventory->decrement('reserved_quantity', $releaseAmount);

                InventoryMovement::create([
                    'inventory_id' => $inventory->id,
                    'user_id' => auth()->id(),
                    'type' => 'release',
                    'quantity_change' => -$releaseAmount,
                    'previous_quantity' => $inventory->quantity,
                    'new_quantity' => $inventory->quantity,
                    'reason' => 'Released reserved stock',
                ]);
            }
        });
    }
}
