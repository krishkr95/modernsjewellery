<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AnalyticsController extends Controller
{
    public function index(Request $request): View
    {
        $days = $request->integer('days', 30);
        $startDate = Carbon::today()->subDays($days);

        // Core Aggregates
        $paidOrders = Order::where('payment_status', Order::PAYMENT_PAID)
            ->where('created_at', '>=', $startDate);

        $totalRevenue = (clone $paidOrders)->sum('total_amount');
        $ordersCount = (clone $paidOrders)->count();
        $averageOrderValue = $ordersCount > 0 ? $totalRevenue / $ordersCount : 0;

        // Customer Metrics
        $totalCustomers = User::whereHas('role', fn($q) => $q->where('name', 'CUSTOMER'))->count();
        
        $repeatCustomersCount = DB::table('orders')
            ->select('user_id')
            ->whereNotNull('user_id')
            ->where('payment_status', Order::PAYMENT_PAID)
            ->groupBy('user_id')
            ->havingRaw('COUNT(id) > 1')
            ->get()
            ->count();

        $repeatRate = $totalCustomers > 0 ? round(($repeatCustomersCount / $totalCustomers) * 100, 1) : 0;

        // Daily Sales Chart Data
        $chartDates = collect();
        $chartRevenues = collect();
        $chartOrders = collect();

        for ($i = min($days, 30); $i >= 0; $i--) {
            $curDate = Carbon::today()->subDays($i);
            $chartDates->push($curDate->format('M d'));

            $rev = Order::where('payment_status', Order::PAYMENT_PAID)
                ->whereDate('created_at', $curDate)
                ->sum('total_amount');
            $chartRevenues->push((float) $rev);

            $ord = Order::whereDate('created_at', $curDate)->count();
            $chartOrders->push((int) $ord);
        }

        // Top 6 Products
        $topProducts = Product::with(['primaryImage', 'category'])
            ->withCount(['variants as sold_count' => function ($q) {
                $q->join('order_items', 'product_variants.id', '=', 'order_items.product_variant_id');
            }])
            ->orderByDesc('sold_count')
            ->take(6)
            ->get();

        // Top Categories by Order Revenue
        $topCategories = Category::withCount('products')->take(6)->get();

        return view('admin.analytics.index', compact(
            'totalRevenue',
            'ordersCount',
            'averageOrderValue',
            'totalCustomers',
            'repeatCustomersCount',
            'repeatRate',
            'chartDates',
            'chartRevenues',
            'chartOrders',
            'topProducts',
            'topCategories',
            'days'
        ));
    }
}
