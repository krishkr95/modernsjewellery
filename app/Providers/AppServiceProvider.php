<?php

namespace App\Providers;

use App\Contracts\WhatsAppGatewayContract;
use App\Models\Order;
use App\Models\Inventory;
use App\Models\Review;
use App\Models\User;
use App\Services\Notifications\WhatsApp\LogWhatsAppGateway;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(WhatsAppGatewayContract::class, LogWhatsAppGateway::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Role-based Gates
        Gate::define('manage-settings', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-users', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-catalog', function (User $user) {
            return $user->isStaff();
        });

        Gate::define('manage-orders', function (User $user) {
            return $user->isStaff();
        });

        Gate::define('manage-inventory', function (User $user) {
            return $user->isStaff();
        });

        Gate::define('manage-marketing', function (User $user) {
            return $user->isStaff();
        });

        Gate::define('manage-content', function (User $user) {
            return $user->isStaff();
        });

        // Share Admin Badges with Admin layout
        View::composer('layouts.admin', function ($view) {
            try {
                $pendingOrdersCount = Order::whereIn('status', [Order::STATUS_PENDING, Order::STATUS_PAYMENT_PENDING])->count();
                $lowStockCount = Inventory::whereColumn('quantity', '<=', 'low_stock_threshold')->count();
                $pendingReviewsCount = Review::where('is_approved', false)->count();

                $view->with([
                    'badgePendingOrders' => $pendingOrdersCount,
                    'badgeLowStock' => $lowStockCount,
                    'badgePendingReviews' => $pendingReviewsCount,
                ]);
            } catch (\Throwable $e) {
                $view->with([
                    'badgePendingOrders' => 0,
                    'badgeLowStock' => 0,
                    'badgePendingReviews' => 0,
                ]);
            }
        });
    }
}
