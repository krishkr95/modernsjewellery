<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::whereHas('role', fn($q) => $q->where('name', 'CUSTOMER'))
            ->withCount('orders')
            ->withSum(['orders as total_spent' => function ($q) {
                $q->where('payment_status', Order::PAYMENT_PAID);
            }], 'total_amount')
            ->latest();

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $customers = $query->paginate(15)->withQueryString();

        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $customer): View
    {
        $customer->load(['addresses', 'wishlists.items.product', 'reviews.product']);
        
        $orders = Order::where('user_id', $customer->id)
            ->with(['items.product.primaryImage'])
            ->latest()
            ->paginate(10);

        $totalSpent = Order::where('user_id', $customer->id)
            ->where('payment_status', Order::PAYMENT_PAID)
            ->sum('total_amount');

        $wishlistCount = $customer->wishlists->sum(fn($w) => $w->items->count());

        return view('admin.customers.show', compact('customer', 'orders', 'totalSpent', 'wishlistCount'));
    }
}
