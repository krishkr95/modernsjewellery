<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\Role;
use App\Models\User;

class ProductPolicy
{
    /**
     * Determine whether the user can view any products in management.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the product.
     */
    public function view(?User $user, Product $product): bool
    {
        if ($product->is_active && $product->status === 'published') {
            return true;
        }

        return $user?->hasRole([Role::SUPER_ADMIN, Role::ADMIN, Role::MANAGER, Role::STAFF]) ?? false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole([Role::SUPER_ADMIN, Role::ADMIN, Role::MANAGER]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        return $user->hasRole([Role::SUPER_ADMIN, Role::ADMIN, Role::MANAGER]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        return $user->hasRole([Role::SUPER_ADMIN, Role::ADMIN]);
    }
}
