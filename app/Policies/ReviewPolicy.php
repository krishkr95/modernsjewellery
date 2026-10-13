<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\Role;
use App\Models\User;

class ReviewPolicy
{
    /**
     * Determine whether the user can approve reviews.
     */
    public function moderate(User $user): bool
    {
        return $user->hasRole([Role::SUPER_ADMIN, Role::ADMIN, Role::MANAGER, Role::STAFF]);
    }

    /**
     * Determine whether the user can delete a review.
     */
    public function delete(User $user, Review $review): bool
    {
        if ($user->hasRole([Role::SUPER_ADMIN, Role::ADMIN])) {
            return true;
        }

        return $review->user_id === $user->id;
    }
}
