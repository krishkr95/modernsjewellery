<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\Role;
use App\Models\User;

class OrderPolicy
{
    /**
     * Determine whether the user can view any orders.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole([Role::SUPER_ADMIN, Role::ADMIN, Role::MANAGER, Role::STAFF]);
    }

    /**
     * Determine whether the user can view the order.
     */
    public function view(User $user, Order $order): bool
    {
        if ($user->hasRole([Role::SUPER_ADMIN, Role::ADMIN, Role::MANAGER, Role::STAFF])) {
            return true;
        }

        return $order->user_id === $user->id;
    }

    /**
     * Determine whether the user can update the order status.
     */
    public function updateStatus(User $user, Order $order): bool
    {
        return $user->hasRole([Role::SUPER_ADMIN, Role::ADMIN, Role::MANAGER, Role::STAFF]);
    }

    /**
     * Determine whether the user can process a refund.
     */
    public function refund(User $user, Order $order): bool
    {
        return $user->hasRole([Role::SUPER_ADMIN, Role::ADMIN, Role::MANAGER]);
    }
}
