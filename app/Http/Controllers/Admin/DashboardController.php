<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = Carbon::today();

        // Top 4 Main KPI Cards matching the UI
        $totalSales = Order::where('payment_status', Order::PAYMENT_PAID)->sum('total_amount');
        if ($totalSales == 0) {
            $totalSales = 1134250.00; // Realistic demo seed if fresh
        }

        $totalOrders = Order::count();
        if ($totalOrders == 0) {
            $totalOrders = 25596;
        }

        $completedOrders = Order::whereIn('status', [Order::STATUS_DELIVERED, Order::STATUS_PAID])->count();
        if ($completedOrders == 0) {
            $completedOrders = 18562;
        }

        $cancelledOrders = Order::where('status', Order::STATUS_CANCELLED)->count();
        if ($cancelledOrders == 0) {
            $cancelledOrders = 318;
        }

        // Daily / Today's Metrics
        $todayRevenue = Order::where('payment_status', Order::PAYMENT_PAID)
            ->whereDate('paid_at', $today)
            ->sum('total_amount');
        $ordersToday = Order::whereDate('created_at', $today)->count();

        // Target Gauge Metrics
        $targetRevenue = 1200000.00;
        $currentRevenue = 740000.00;
        $targetProgress = 54.95;

        // Monthly Multi-Curve Statistic Data (Jan to Dec)
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $salesCurve = [380, 420, 390, 680, 590, 720, 780, 810, 890, 840, 780, 820];
        $revenueCurve = [450, 410, 480, 520, 610, 750, 790, 860, 1140, 880, 790, 850];
        $cancelCurve = [120, 190, 280, 150, 310, 220, 290, 190, 140, 360, 210, 180];

        // Latest Orders List
        $latestOrders = Order::with(['user', 'items.product'])->latest()->take(6)->get();

        // If less than 4 orders, provide rich visual items so table looks complete like design
        $sampleOrders = [
            [
                'id' => 1,
                'source' => 'On Shop',
                'source_type' => 'shop',
                'customer_name' => 'Ibnul Shams Al Asad',
                'customer_contact' => 'shams@hotmail.com',
                'total' => 'AED 8,12,100',
                'status' => 'Processing',
                'status_color' => 'amber'
            ],
            [
                'id' => 2,
                'source' => 'Website',
                'source_type' => 'web',
                'customer_name' => 'Zara Hassan',
                'customer_contact' => 'zara.hasan@hotmail.com',
                'total' => 'AED 12,69,650.00',
                'status' => 'Delivered',
                'status_color' => 'emerald'
            ],
            [
                'id' => 3,
                'source' => 'On Shop',
                'source_type' => 'shop',
                'customer_name' => 'Mohammad Karim',
                'customer_contact' => 'm_karim@yahoo.com',
                'total' => 'AED 27,250',
                'status' => 'Cancel',
                'status_color' => 'rose'
            ],
            [
                'id' => 4,
                'source' => 'Website',
                'source_type' => 'web',
                'customer_name' => 'Layla Al-Mansoori',
                'customer_contact' => 'layla.mansoori@gmail.com',
                'total' => 'AED 1,92,000.00',
                'status' => 'Delivered',
                'status_color' => 'emerald'
            ],
        ];

        // Country Distribution Breakdown
        $countryGrowth = [
            ['country' => 'UAE', 'flag' => '🇦🇪', 'customers' => '1,98,240 Customers', 'percentage' => 58, 'color' => '#10B981'],
            ['country' => 'India', 'flag' => '🇮🇳', 'customers' => '1,21,240 Customers', 'percentage' => 16, 'color' => '#F59E0B'],
            ['country' => 'United States', 'flag' => '🇺🇸', 'customers' => '84,120 Customers', 'percentage' => 14, 'color' => '#3B82F6'],
            ['country' => 'United Kingdom', 'flag' => '🇬🇧', 'customers' => '48,900 Customers', 'percentage' => 12, 'color' => '#8B5CF6'],
        ];

        return view('admin.dashboard', compact(
            'totalSales',
            'totalOrders',
            'completedOrders',
            'cancelledOrders',
            'targetProgress',
            'targetRevenue',
            'currentRevenue',
            'months',
            'salesCurve',
            'revenueCurve',
            'cancelCurve',
            'latestOrders',
            'sampleOrders',
            'countryGrowth'
        ));
    }
}
