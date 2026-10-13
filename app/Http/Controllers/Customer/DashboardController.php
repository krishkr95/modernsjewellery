<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $orders = $user->orders()->with('items')->latest()->take(5)->get();
        $wishlist = $user->wishlists()->first()?->items()->with('product.primaryImage')->take(4)->get() ?? collect();
        $defaultAddress = $user->defaultAddress;

        return view('pages.customer.dashboard', compact('user', 'orders', 'wishlist', 'defaultAddress'));
    }
}
