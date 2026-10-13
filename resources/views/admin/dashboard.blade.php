<x-layouts.admin title="Dashboard | Modern Jewellery House Haute Joaillerie Management">
<div style="display:flex;flex-direction:column;gap:20px;">

    <!-- ================= ROW 1: 4 KPI CARDS (2x2 Mobile, 4x1 Desktop) ================= -->
    <div class="dash-kpi-grid">
        
        <!-- Card 1: Total Sales -->
        <div class="kpi-card p-3.5 sm:p-5" style="border-left: 4px solid #DFB76C;">
            <div class="flex items-center justify-between gap-1 mb-2">
                <span class="text-[10px] sm:text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider truncate">Total Sales</span>
                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-amber-500/10 dark:bg-amber-500/15 border border-amber-500/20 flex items-center justify-center flex-shrink-0 text-amber-600 dark:text-amber-400">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
            </div>
            <div class="my-0.5">
                <p class="text-lg sm:text-2xl lg:text-[1.65rem] font-extrabold text-slate-900 dark:text-white tracking-tight leading-none whitespace-nowrap overflow-hidden text-ellipsis tnum">
                    <span class="text-xs sm:text-sm font-bold text-amber-600 dark:text-amber-400 mr-1">₹</span>1,134M
                </p>
            </div>
            <div class="flex items-center gap-1.5 mt-2 flex-wrap">
                <span class="text-[11px] sm:text-xs font-bold text-emerald-600 dark:text-emerald-400 flex items-center gap-0.5">
                    +5.55%
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 19L19 5m0 0h-9m9 0v9"/></svg>
                </span>
                <span class="text-[10px] sm:text-[11px] text-slate-400 dark:text-slate-500 truncate">vs 1.2M Target</span>
            </div>
        </div>

        <!-- Card 2: Total Orders -->
        <div class="kpi-card p-3.5 sm:p-5" style="border-left: 4px solid #F59E0B;">
            <div class="flex items-center justify-between gap-1 mb-2">
                <span class="text-[10px] sm:text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider truncate">Total Orders</span>
                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-orange-500/10 dark:bg-orange-500/15 border border-orange-500/20 flex items-center justify-center flex-shrink-0 text-orange-600 dark:text-orange-400">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
            </div>
            <div class="my-0.5">
                <p class="text-lg sm:text-2xl lg:text-[1.65rem] font-extrabold text-slate-900 dark:text-white tracking-tight leading-none whitespace-nowrap overflow-hidden text-ellipsis tnum">
                    25,596
                </p>
            </div>
            <div class="flex items-center gap-1.5 mt-2 flex-wrap">
                <span class="text-[11px] sm:text-xs font-bold text-rose-600 dark:text-rose-400 flex items-center gap-0.5">
                    -3.72%
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 5L5 19m0 0h9m-9 0v-9"/></svg>
                </span>
                <span class="text-[10px] sm:text-[11px] text-slate-400 dark:text-slate-500 truncate">vs last month</span>
            </div>
        </div>

        <!-- Card 3: Order Complete -->
        <div class="kpi-card p-3.5 sm:p-5" style="border-left: 4px solid #10B981;">
            <div class="flex items-center justify-between gap-1 mb-2">
                <span class="text-[10px] sm:text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider truncate">Order Complete</span>
                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-emerald-500/10 dark:bg-emerald-500/15 border border-emerald-500/20 flex items-center justify-center flex-shrink-0 text-emerald-600 dark:text-emerald-400">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="my-0.5">
                <p class="text-lg sm:text-2xl lg:text-[1.65rem] font-extrabold text-slate-900 dark:text-white tracking-tight leading-none whitespace-nowrap overflow-hidden text-ellipsis tnum">
                    18,562
                </p>
            </div>
            <div class="flex items-center gap-1.5 mt-2 flex-wrap">
                <span class="text-[11px] sm:text-xs font-bold text-emerald-600 dark:text-emerald-400 flex items-center gap-0.5">
                    +0.98%
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 19L19 5m0 0h-9m9 0v9"/></svg>
                </span>
                <span class="text-[10px] sm:text-[11px] text-slate-400 dark:text-slate-500 truncate">vs last month</span>
            </div>
        </div>

        <!-- Card 4: Cancel Order -->
        <div class="kpi-card p-3.5 sm:p-5" style="border-left: 4px solid #EF4444;">
            <div class="flex items-center justify-between gap-1 mb-2">
                <span class="text-[10px] sm:text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider truncate">Cancel Order</span>
                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-rose-500/10 dark:bg-rose-500/15 border border-rose-500/20 flex items-center justify-center flex-shrink-0 text-rose-600 dark:text-rose-400">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="my-0.5">
                <p class="text-lg sm:text-2xl lg:text-[1.65rem] font-extrabold text-slate-900 dark:text-white tracking-tight leading-none whitespace-nowrap overflow-hidden text-ellipsis tnum">
                    318
                </p>
            </div>
            <div class="flex items-center gap-1.5 mt-2 flex-wrap">
                <span class="text-[11px] sm:text-xs font-bold text-rose-600 dark:text-rose-400">2%</span>
                <span class="text-[10px] sm:text-[11px] text-slate-400 dark:text-slate-500 truncate">vs last month</span>
            </div>
        </div>

    </div>

    <!-- ================= ROW 2: TARGET GAUGE & STATISTIC CHART ================= -->
    <div class="dash-row-target-stats">
        
        <!-- Left: Target Radial Gauge -->
        <div class="content-card p-5 sm:p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-2 border-b border-slate-100 dark:border-white/5">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white font-serif tracking-tight">Target</h3>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Revenue Target / Today</p>
                    </div>
                    <button class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"/></svg>
                    </button>
                </div>

                <!-- Radial Arc Gauge -->
                <div class="relative py-4 flex flex-col items-center justify-center">
                    <svg viewBox="0 0 200 120" class="w-48 sm:w-56 h-auto overflow-visible">
                        <!-- Track Arc -->
                        <path d="M 20 100 A 80 80 0 0 1 180 100" fill="none" stroke="currentColor" class="text-slate-200 dark:text-slate-800" stroke-width="14" stroke-linecap="round"/>
                        <!-- Filled Gold Arc (54.95%) -->
                        <path d="M 20 100 A 80 80 0 0 1 180 100" fill="none" stroke="url(#luxoraGoldGaugeGrad)" stroke-width="14" stroke-linecap="round"
                              stroke-dasharray="251.2" stroke-dashoffset="113.1"
                              style="filter: drop-shadow(0 2px 6px rgba(212, 175, 55, 0.4));"/>
                        <defs>
                            <linearGradient id="luxoraGoldGaugeGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#ECC274"/>
                                <stop offset="50%" stop-color="#D4AF37"/>
                                <stop offset="100%" stop-color="#BD9226"/>
                            </linearGradient>
                        </defs>
                    </svg>
                    <div class="text-center mt-[-20px]">
                        <span class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight block tnum">54.95%</span>
                        <span class="text-xs font-bold text-rose-500 dark:text-rose-400 block mt-0.5 tnum">-37.72%</span>
                    </div>
                </div>

                <p class="text-xs text-center text-slate-500 dark:text-slate-400 px-2 leading-relaxed">
                    You succeed earn <span class="font-bold text-amber-700 dark:text-amber-400">₹ 0.74M</span> today.<br>
                    Current Sales Revenue is <span class="font-bold text-emerald-600 dark:text-emerald-400">40%</span> of monthly target!
                </p>
            </div>

            <!-- Target Summary 3-Col Bar -->
            <div class="grid grid-cols-3 gap-2 pt-4 mt-4 border-t border-slate-100 dark:border-white/5 text-center text-xs">
                <div class="p-2 rounded-xl bg-slate-100/60 dark:bg-white/[0.03]">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block">Target</span>
                    <span class="font-bold text-slate-800 dark:text-slate-200 mt-1 block tnum">1.02M <span class="text-rose-500">&darr;</span></span>
                </div>
                <div class="p-2 rounded-xl bg-slate-100/60 dark:bg-white/[0.03]">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block">Revenue</span>
                    <span class="font-bold text-slate-800 dark:text-slate-200 mt-1 block tnum">0.29M <span class="text-emerald-500">&uarr;</span></span>
                </div>
                <div class="p-2 rounded-xl bg-slate-100/60 dark:bg-white/[0.03]">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block">Sales</span>
                    <span class="font-bold text-slate-800 dark:text-slate-200 mt-1 block tnum">0.27M <span class="text-emerald-500">&uarr;</span></span>
                </div>
            </div>
        </div>

        <!-- Right: Spline Statistics Chart -->
        <div class="content-card p-5 sm:p-6 flex flex-col justify-between">
            <!-- Header with Title & Legend -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-100 dark:border-white/5">
                <div>
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white font-serif tracking-tight">Statistic</h3>
                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Haute Fine Joaillerie Revenue and Sales (₹ INR)</p>
                </div>
                <!-- Legend Dots -->
                <div class="flex items-center gap-4 text-xs font-semibold">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-500 shadow-sm"></span>
                        <span class="text-slate-600 dark:text-slate-300">Cancel</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500 shadow-sm"></span>
                        <span class="text-slate-600 dark:text-slate-300">Revenue</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500 shadow-sm"></span>
                        <span class="text-slate-600 dark:text-slate-300">Sales</span>
                    </div>
                </div>
            </div>

            <!-- Chart.js Container -->
            <div class="relative w-full h-[260px] sm:h-[300px] mt-4">
                <canvas id="luxoraRevenueChart"></canvas>
            </div>
        </div>

    </div>

    <!-- ================= ROW 3: LATEST ORDERS & WORLD GROWTH ================= -->
    <div class="dash-row-orders-growth">
        
        <!-- Left: Latest Orders -->
        <div class="content-card p-4 sm:p-6">
            <!-- Card Header & Filter Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-100 dark:border-white/5">
                <div class="flex items-center gap-2.5">
                    <h3 class="text-base font-bold text-slate-900 dark:text-white font-serif tracking-tight">Latest Order</h3>
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-500/10 dark:bg-amber-500/20 text-amber-700 dark:text-amber-400 border border-amber-500/20">
                        +5 New
                    </span>
                </div>
                
                <!-- Action Controls (Clean Flex Row) -->
                <div class="flex items-center gap-2 flex-wrap">
                    <button class="sub-btn px-3 py-1.5 text-xs font-semibold flex items-center gap-1.5 text-slate-700 dark:text-slate-300">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Select Date</span>
                    </button>
                    <a href="{{ route('admin.orders.index') }}" class="sub-btn px-3 py-1.5 text-xs font-semibold flex items-center gap-1.5 text-slate-700 dark:text-slate-300">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <span>Filters</span>
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="btn-gold px-4 py-1.5 text-xs font-bold">
                        See All
                    </a>
                </div>
            </div>

            <!-- Orders Table with Smooth Responsive Scroll Container -->
            <div class="table-responsive-container mt-3">
                <table class="admin-table" style="min-width: 650px;">
                    <thead>
                        <tr>
                            <th style="width: 130px;">Source</th>
                            <th>Customer</th>
                            <th style="width: 140px;">Total</th>
                            <th style="width: 110px;">Status</th>
                            <th style="width: 70px; text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestOrders as $order)
                            @php
                                $isShop = ($order->id % 2 === 1);
                                $custName = $order->user->name ?? $order->shipping_address['name'] ?? ('Patron #' . $order->id);
                                $custEmail = $order->user->email ?? $order->customer_email ?? 'patron@modernjewellery.in';
                                $initials = strtoupper(substr(trim($custName), 0, 2));
                            @endphp
                            <tr>
                                <!-- Source -->
                                <td style="white-space: nowrap;">
                                    <div class="flex items-center gap-2">
                                        @if($isShop)
                                            <div class="w-7 h-7 rounded-lg bg-emerald-500/10 dark:bg-emerald-500/20 flex items-center justify-center flex-shrink-0 text-emerald-600 dark:text-emerald-400">
                                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor"><path d="M19.5 6.5h-3.3c-.3-2.6-2.2-4.5-4.7-4.5s-4.4 1.9-4.7 4.5H3.5C2.7 6.5 2 7.2 2 8v12c0 .8.7 1.5 1.5 1.5h16c.8 0 1.5-.7 1.5-1.5V8c0-.8-.7-1.5-1.5-1.5zM11.5 4c1.4 0 2.5 1.1 2.7 2.5H8.8c.2-1.4 1.3-2.5 2.7-2.5zm8 15.5h-15V8.5h3.3v1.5c0 .6.4 1 1 1s1-.4 1-1V8.5h4.4v1.5c0 .6.4 1 1 1s1-.4 1-1V8.5h3.3v11z"/></svg>
                                            </div>
                                            <span class="font-semibold text-xs text-slate-800 dark:text-slate-200">On Shop</span>
                                        @else
                                            <div class="w-7 h-7 rounded-lg bg-slate-200 dark:bg-slate-800 flex items-center justify-center flex-shrink-0 text-slate-700 dark:text-slate-300">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-3-3-3m0 18c-1.657 0-3-4.03-3-9s1.343-3 3-3m-9 9a9 9 0 019-9"/></svg>
                                            </div>
                                            <span class="font-semibold text-xs text-slate-800 dark:text-slate-200">Website</span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Customer Details with Elegant Avatar Initials -->
                                <td>
                                    <div class="flex items-center gap-2.5 min-w-[170px]">
                                        <div class="w-8 h-8 rounded-full bg-amber-500/10 dark:bg-amber-500/20 border border-amber-500/30 flex items-center justify-center text-amber-700 dark:text-amber-400 font-bold text-xs flex-shrink-0">
                                            {{ $initials }}
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <a href="{{ route('admin.orders.show', $order) }}" class="font-bold text-xs text-slate-900 dark:text-white hover:text-amber-700 dark:hover:text-amber-400 block truncate transition-colors">
                                                {{ $custName }}
                                            </a>
                                            <p class="text-[11px] text-slate-400 dark:text-slate-500 truncate mt-0.5">{{ $custEmail }}</p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Total (Luxury Tabular Figure) -->
                                <td style="white-space: nowrap;" class="text-xs font-bold text-slate-900 dark:text-amber-400 tnum">
                                    <span class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 mr-1">₹</span>{{ number_format($order->total_amount, 2) }}
                                </td>

                                <!-- Status Pill -->
                                <td style="white-space: nowrap;">
                                    @if($order->status === 'DELIVERED')
                                        <span class="order-pill pill-delivered">Delivered</span>
                                    @elseif($order->status === 'PROCESSING')
                                        <span class="order-pill pill-processing">Processing</span>
                                    @elseif($order->status === 'CANCELLED')
                                        <span class="order-pill pill-cancel">Cancelled</span>
                                    @elseif($order->status === 'SHIPPED')
                                        <span class="order-pill pill-shipped">Shipped</span>
                                    @else
                                        <span class="order-pill pill-pending">Pending</span>
                                    @endif
                                </td>

                                <!-- Action Buttons -->
                                <td style="text-align: right; white-space: nowrap;">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="sub-btn p-1.5 text-slate-500 hover:text-slate-800 dark:hover:text-white" title="Inspect Order Dossier">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 28px; color: #94A3B8;">No acquisitions recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right: Business Growth by Country with Detailed World Map -->
        <div class="content-card p-5 sm:p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-white/5">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white font-serif tracking-tight">Global Patron Network</h3>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Domestic & International Dispatches</p>
                    </div>
                    <span class="text-[10px] font-bold text-amber-700 dark:text-amber-400 bg-amber-500/10 px-2.5 py-1 rounded-full border border-amber-500/20 flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                        Live World Map
                    </span>
                </div>

                <!-- 3D Shadow Live World Map Stage (Matches Reference Style with Real-Time Trade Arcs) -->
                <div class="relative my-4 rounded-2xl overflow-hidden border border-slate-200/90 dark:border-white/10 bg-[#FFFFFF] dark:bg-[#0B101D] shadow-sm transition-colors group">
                    
                    <!-- Ambient Luxury Glow & Subtle Coordinate Grid -->
                    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_65%_48%,rgba(223,183,108,0.10),transparent_65%)] dark:bg-[radial-gradient(ellipse_at_65%_48%,rgba(223,183,108,0.14),transparent_65%)] pointer-events-none"></div>

                    <!-- 3D Long Shadow World Map (740x423 Exact Aspect Ratio) -->
                    <div class="relative w-full aspect-[740/423] flex items-center justify-center p-1 sm:p-2">
                        <!-- Light Mode: Dark Continent Silhouette with 3D Extruded Cast Drop Shadows -->
                        <img src="{{ asset('assets/images/world-map-transparent.png') }}" 
                             alt="Global Patron Network 3D World Map" 
                             class="w-full h-full object-contain block dark:hidden pointer-events-none select-none transition-transform duration-500 group-hover:scale-[1.01]" />
                        
                        <!-- Dark Mode: Haute Joaillerie Gold Continents with 3D Cast Drop Shadows -->
                        <img src="{{ asset('assets/images/world-map-dark.png') }}" 
                             alt="Global Patron Network 3D World Map Dark" 
                             class="w-full h-full object-contain hidden dark:block pointer-events-none select-none transition-transform duration-500 group-hover:scale-[1.01] drop-shadow-[0_4px_24px_rgba(223,183,108,0.18)]" />

                        <!-- High-Precision SVG Telemetry, Courier Flight Arcs & Interactive Beacons (viewBox="0 0 740 423") -->
                        <svg viewBox="0 0 740 423" class="absolute inset-0 w-full h-full pointer-events-auto select-none" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <!-- Radar Glowing Gradients -->
                                <radialGradient id="hqGoldPulse" cx="50%" cy="50%" r="50%">
                                    <stop offset="0%" stop-color="#DFB76C" stop-opacity="0.95"/>
                                    <stop offset="60%" stop-color="#DFB76C" stop-opacity="0.3"/>
                                    <stop offset="100%" stop-color="#DFB76C" stop-opacity="0"/>
                                </radialGradient>
                                <linearGradient id="tradeArcDubai" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#DFB76C" stop-opacity="0.9"/>
                                    <stop offset="100%" stop-color="#10B981" stop-opacity="0.85"/>
                                </linearGradient>
                                <linearGradient id="tradeArcLondon" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#DFB76C" stop-opacity="0.9"/>
                                    <stop offset="100%" stop-color="#6366F1" stop-opacity="0.85"/>
                                </linearGradient>
                                <linearGradient id="tradeArcNY" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#DFB76C" stop-opacity="0.9"/>
                                    <stop offset="100%" stop-color="#3B82F6" stop-opacity="0.85"/>
                                </linearGradient>
                                <linearGradient id="tradeArcTokyo" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#DFB76C" stop-opacity="0.9"/>
                                    <stop offset="100%" stop-color="#EC4899" stop-opacity="0.85"/>
                                </linearGradient>
                                <linearGradient id="tradeArcSingapore" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#DFB76C" stop-opacity="0.9"/>
                                    <stop offset="100%" stop-color="#06B6D4" stop-opacity="0.85"/>
                                </linearGradient>
                                <linearGradient id="tradeArcSydney" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#DFB76C" stop-opacity="0.9"/>
                                    <stop offset="100%" stop-color="#8B5CF6" stop-opacity="0.85"/>
                                </linearGradient>
                            </defs>

                            <!-- Subtle Navigational Parallels -->
                            <g opacity="0.10" stroke="#94A3B8" stroke-width="0.6" stroke-dasharray="2,4" fill="none">
                                <line x1="30" y1="105" x2="710" y2="105"/>
                                <line x1="30" y1="210" x2="710" y2="210"/>
                                <line x1="30" y1="315" x2="710" y2="315"/>
                            </g>

                            <!-- Connected Trade Courier Arcs (Bezier curves originating from Mumbai HQ 485, 209) -->
                            <!-- 1. Mumbai -> Dubai (432, 195) -->
                            <path d="M 485,209 Q 455,182 432,195" fill="none" stroke="url(#tradeArcDubai)" stroke-width="2" stroke-dasharray="4,4" class="courier-route-anim"/>
                            
                            <!-- 2. Mumbai -> London (364, 132) -->
                            <path d="M 485,209 Q 420,125 364,132" fill="none" stroke="url(#tradeArcLondon)" stroke-width="2" stroke-dasharray="4,4" class="courier-route-anim"/>

                            <!-- 3. Mumbai -> New York (194, 152) -->
                            <path d="M 485,209 Q 330,95 194,152" fill="none" stroke="url(#tradeArcNY)" stroke-width="2" stroke-dasharray="4,4" class="courier-route-anim"/>

                            <!-- 4. Mumbai -> Tokyo (604, 154) -->
                            <path d="M 485,209 Q 550,140 604,154" fill="none" stroke="url(#tradeArcTokyo)" stroke-width="1.8" stroke-dasharray="4,4" class="courier-route-anim"/>

                            <!-- 5. Mumbai -> Singapore (525, 263) -->
                            <path d="M 485,209 Q 510,230 525,263" fill="none" stroke="url(#tradeArcSingapore)" stroke-width="1.8" stroke-dasharray="4,4" class="courier-route-anim"/>

                            <!-- 6. Mumbai -> Sydney (581, 319) -->
                            <path d="M 485,209 Q 545,280 581,319" fill="none" stroke="url(#tradeArcSydney)" stroke-width="1.8" stroke-dasharray="4,4" class="courier-route-anim"/>

                            <!-- ================= HUBS & RADAR BEACONS ================= -->

                            <!-- Dubai Hub (432, 195) -->
                            <g class="cursor-pointer group/pin">
                                <circle cx="432" cy="195" r="11" fill="none" stroke="#10B981" stroke-width="1.2" opacity="0.6">
                                    <animate attributeName="r" values="3;13;3" dur="2.8s" repeatCount="indefinite"/>
                                    <animate attributeName="opacity" values="0.8;0.1;0.8" dur="2.8s" repeatCount="indefinite"/>
                                </circle>
                                <circle cx="432" cy="195" r="4" fill="#10B981" stroke="#FFFFFF" stroke-width="1.2"/>
                                <rect x="410" y="174" width="44" height="13" rx="6.5" fill="#0F172A" fill-opacity="0.85"/>
                                <text x="432" y="183.5" text-anchor="middle" font-size="7" font-weight="700" fill="#34D399" font-family="'Plus Jakarta Sans',sans-serif">DUBAI</text>
                            </g>

                            <!-- London Hub (364, 132) -->
                            <g class="cursor-pointer group/pin">
                                <circle cx="364" cy="132" r="10" fill="none" stroke="#6366F1" stroke-width="1.2" opacity="0.6">
                                    <animate attributeName="r" values="3;12;3" dur="3.1s" repeatCount="indefinite"/>
                                    <animate attributeName="opacity" values="0.8;0.1;0.8" dur="3.1s" repeatCount="indefinite"/>
                                </circle>
                                <circle cx="364" cy="132" r="4" fill="#6366F1" stroke="#FFFFFF" stroke-width="1.2"/>
                                <rect x="339" y="111" width="50" height="13" rx="6.5" fill="#0F172A" fill-opacity="0.85"/>
                                <text x="364" y="120.5" text-anchor="middle" font-size="7" font-weight="700" fill="#A5B4FC" font-family="'Plus Jakarta Sans',sans-serif">LONDON</text>
                            </g>

                            <!-- New York Hub (194, 152) -->
                            <g class="cursor-pointer group/pin">
                                <circle cx="194" cy="152" r="10" fill="none" stroke="#3B82F6" stroke-width="1.2" opacity="0.6">
                                    <animate attributeName="r" values="3;12;3" dur="3.3s" repeatCount="indefinite"/>
                                    <animate attributeName="opacity" values="0.8;0.1;0.8" dur="3.3s" repeatCount="indefinite"/>
                                </circle>
                                <circle cx="194" cy="152" r="4" fill="#3B82F6" stroke="#FFFFFF" stroke-width="1.2"/>
                                <rect x="166" y="131" width="56" height="13" rx="6.5" fill="#0F172A" fill-opacity="0.85"/>
                                <text x="194" y="140.5" text-anchor="middle" font-size="7" font-weight="700" fill="#93C5FD" font-family="'Plus Jakarta Sans',sans-serif">NEW YORK</text>
                            </g>

                            <!-- Tokyo Hub (604, 154) -->
                            <g class="cursor-pointer group/pin">
                                <circle cx="604" cy="154" r="9" fill="none" stroke="#EC4899" stroke-width="1.2" opacity="0.6">
                                    <animate attributeName="r" values="2;10;2" dur="3.5s" repeatCount="indefinite"/>
                                    <animate attributeName="opacity" values="0.7;0.1;0.7" dur="3.5s" repeatCount="indefinite"/>
                                </circle>
                                <circle cx="604" cy="154" r="3.5" fill="#EC4899" stroke="#FFFFFF" stroke-width="1"/>
                                <rect x="582" y="133" width="44" height="13" rx="6.5" fill="#0F172A" fill-opacity="0.85"/>
                                <text x="604" y="142.5" text-anchor="middle" font-size="7" font-weight="700" fill="#F472B6" font-family="'Plus Jakarta Sans',sans-serif">TOKYO</text>
                            </g>

                            <!-- Singapore Hub (525, 263) -->
                            <g class="cursor-pointer group/pin">
                                <circle cx="525" cy="263" r="9" fill="none" stroke="#06B6D4" stroke-width="1.2" opacity="0.6">
                                    <animate attributeName="r" values="2;10;2" dur="2.9s" repeatCount="indefinite"/>
                                    <animate attributeName="opacity" values="0.7;0.1;0.7" dur="2.9s" repeatCount="indefinite"/>
                                </circle>
                                <circle cx="525" cy="263" r="3.5" fill="#06B6D4" stroke="#FFFFFF" stroke-width="1"/>
                                <rect x="498" y="271" width="54" height="13" rx="6.5" fill="#0F172A" fill-opacity="0.85"/>
                                <text x="525" y="280.5" text-anchor="middle" font-size="7" font-weight="700" fill="#67E8F9" font-family="'Plus Jakarta Sans',sans-serif">SINGAPORE</text>
                            </g>

                            <!-- Sydney Hub (581, 319) -->
                            <g class="cursor-pointer group/pin">
                                <circle cx="581" cy="319" r="9" fill="none" stroke="#8B5CF6" stroke-width="1.2" opacity="0.6">
                                    <animate attributeName="r" values="2;10;2" dur="3.2s" repeatCount="indefinite"/>
                                    <animate attributeName="opacity" values="0.7;0.1;0.7" dur="3.2s" repeatCount="indefinite"/>
                                </circle>
                                <circle cx="581" cy="319" r="3.5" fill="#8B5CF6" stroke="#FFFFFF" stroke-width="1"/>
                                <rect x="557" y="327" width="48" height="13" rx="6.5" fill="#0F172A" fill-opacity="0.85"/>
                                <text x="581" y="336.5" text-anchor="middle" font-size="7" font-weight="700" fill="#C4B5FD" font-family="'Plus Jakarta Sans',sans-serif">SYDNEY</text>
                            </g>

                            <!-- HQ Atelier: Mumbai / Delhi (485, 209) -->
                            <g class="cursor-pointer">
                                <circle cx="485" cy="209" r="22" fill="url(#hqGoldPulse)">
                                    <animate attributeName="r" values="6;26;6" dur="2.4s" repeatCount="indefinite"/>
                                    <animate attributeName="opacity" values="0.9;0.1;0.9" dur="2.4s" repeatCount="indefinite"/>
                                </circle>
                                <circle cx="485" cy="209" r="14" fill="none" stroke="#DFB76C" stroke-width="1.6">
                                    <animate attributeName="r" values="4;18;4" dur="2.4s" repeatCount="indefinite"/>
                                </circle>
                                <circle cx="485" cy="209" r="5" fill="#DFB76C" stroke="#FFFFFF" stroke-width="1.5"/>
                                <rect x="444" y="217" width="82" height="15" rx="7.5" fill="#0F172A" opacity="0.9" stroke="#DFB76C" stroke-width="0.8"/>
                                <text x="485" y="227.5" text-anchor="middle" font-size="7" font-weight="800" fill="#DFB76C" font-family="'Plus Jakarta Sans',sans-serif" letter-spacing="0.4">★ HQ MUMBAI</text>
                            </g>
                        </svg>

                    </div>

                    <!-- Clean Live Dispatch Telemetry Bar Below Map -->
                    <div class="px-3.5 py-2 bg-slate-50/90 dark:bg-white/[0.03] border-t border-slate-100 dark:border-white/5 flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2 min-w-0">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse flex-shrink-0"></span>
                            <span class="text-[11px] font-bold text-slate-800 dark:text-slate-200 truncate">
                                <span class="text-amber-600 dark:text-amber-400 font-extrabold mr-1">Active Dispatches (12):</span>
                                Dubai &bull; London &bull; New York &bull; Tokyo
                            </span>
                        </div>
                        <div class="flex items-center gap-1.5 text-[10px] text-slate-500 dark:text-slate-400 font-mono font-semibold flex-shrink-0">
                            <span class="px-1.5 py-0.5 rounded bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-bold">🇦🇪 5</span>
                            <span class="px-1.5 py-0.5 rounded bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-bold">🇬🇧 3</span>
                            <span class="px-1.5 py-0.5 rounded bg-blue-500/10 text-blue-600 dark:text-blue-400 font-bold">🇺🇸 2</span>
                            <span class="px-1.5 py-0.5 rounded bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold">🇯🇵 2</span>
                        </div>
                    </div>

                </div>

                <style>
                    @keyframes courierDash {
                        to {
                            stroke-dashoffset: -24;
                        }
                    }
                    .courier-route-anim {
                        animation: courierDash 1.4s linear infinite;
                    }
                </style>

                <!-- Country Distribution Progress Bars with Indian Rupee (₹) -->
                <div class="space-y-3 mt-3">
                    <!-- India -->
                    <div>
                        <div class="flex items-center justify-between text-xs mb-1">
                            <div class="flex items-center gap-2">
                                <span class="text-sm">🇮🇳</span>
                                <span class="font-bold text-slate-900 dark:text-white">India (Domestic Patrons)</span>
                                <span class="text-[11px] text-slate-400 dark:text-slate-500 tnum">198,240 Collectors</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="text-[11px] font-bold text-amber-700 dark:text-amber-400 tnum">₹3.54M</span>
                                <span class="font-bold text-amber-700 dark:text-amber-400 tnum">64%</span>
                            </div>
                        </div>
                        <div class="w-full h-2 rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-amber-400 to-amber-600" style="width: 64%;"></div>
                        </div>
                    </div>

                    <!-- UAE / GCC -->
                    <div>
                        <div class="flex items-center justify-between text-xs mb-1">
                            <div class="flex items-center gap-2">
                                <span class="text-sm">🇦🇪</span>
                                <span class="font-bold text-slate-900 dark:text-white">UAE &amp; Gulf Concessions</span>
                                <span class="text-[11px] text-slate-400 dark:text-slate-500 tnum">56,120 Collectors</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="text-[11px] font-bold text-emerald-600 dark:text-emerald-400 tnum">₹0.99M</span>
                                <span class="font-bold text-emerald-600 dark:text-emerald-400 tnum">18%</span>
                            </div>
                        </div>
                        <div class="w-full h-2 rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden">
                            <div class="h-full rounded-full bg-emerald-500" style="width: 18%;"></div>
                        </div>
                    </div>

                    <!-- UK & Europe -->
                    <div>
                        <div class="flex items-center justify-between text-xs mb-1">
                            <div class="flex items-center gap-2">
                                <span class="text-sm">🇬🇧</span>
                                <span class="font-bold text-slate-900 dark:text-white">UK &amp; European Union</span>
                                <span class="text-[11px] text-slate-400 dark:text-slate-500 tnum">34,400 Collectors</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="text-[11px] font-bold text-indigo-600 dark:text-indigo-400 tnum">₹0.61M</span>
                                <span class="font-bold text-indigo-600 dark:text-indigo-400 tnum">11%</span>
                            </div>
                        </div>
                        <div class="w-full h-2 rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden">
                            <div class="h-full rounded-full bg-indigo-500" style="width: 11%;"></div>
                        </div>
                    </div>

                    <!-- USA & Americas -->
                    <div>
                        <div class="flex items-center justify-between text-xs mb-1">
                            <div class="flex items-center gap-2">
                                <span class="text-sm">🇺🇸</span>
                                <span class="font-bold text-slate-900 dark:text-white">USA &amp; Global Private Tier</span>
                                <span class="text-[11px] text-slate-400 dark:text-slate-500 tnum">21,800 Collectors</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="text-[11px] font-bold text-blue-600 dark:text-blue-400 tnum">₹0.39M</span>
                                <span class="font-bold text-blue-600 dark:text-blue-400 tnum">7%</span>
                            </div>
                        </div>
                        <div class="w-full h-2 rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden">
                            <div class="h-full rounded-full bg-blue-500" style="width: 7%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Multi-Curve Spline Chart Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('luxoraRevenueChart');
    if (!ctx) return;

    let revenueChartInstance = null;

    function buildChart() {
        const isDark = document.documentElement.classList.contains('dark');
        const months = {!! json_encode($months ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']) !!};
        const salesData = {!! json_encode($salesCurve ?? [380, 420, 390, 680, 590, 720, 780, 810, 890, 840, 780, 820]) !!};
        const revenueData = {!! json_encode($revenueCurve ?? [450, 410, 480, 520, 610, 750, 790, 860, 1140, 880, 790, 850]) !!};
        const cancelData = {!! json_encode($cancelCurve ?? [120, 190, 280, 150, 310, 220, 290, 190, 140, 360, 210, 180]) !!};

        if (revenueChartInstance) {
            revenueChartInstance.destroy();
        }

        revenueChartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [
                    {
                        label: 'Sales',
                        data: salesData,
                        borderColor: '#D4AF37',
                        backgroundColor: isDark ? 'rgba(212, 175, 55, 0.08)' : 'rgba(212, 175, 55, 0.12)',
                        borderWidth: 2.8,
                        tension: 0.45,
                        fill: true,
                        pointRadius: 0,
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: '#D4AF37',
                        pointHoverBorderColor: '#ffffff',
                        pointHoverBorderWidth: 2
                    },
                    {
                        label: 'Revenue',
                        data: revenueData,
                        borderColor: '#3B82F6',
                        backgroundColor: isDark ? 'rgba(59, 130, 246, 0.06)' : 'rgba(59, 130, 246, 0.10)',
                        borderWidth: 2.8,
                        tension: 0.45,
                        fill: true,
                        pointRadius: 0,
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: '#3B82F6',
                        pointHoverBorderColor: '#ffffff',
                        pointHoverBorderWidth: 2
                    },
                    {
                        label: 'Cancel',
                        data: cancelData,
                        borderColor: '#F43F5E',
                        backgroundColor: 'transparent',
                        borderWidth: 2.2,
                        tension: 0.45,
                        fill: false,
                        pointRadius: 0,
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: '#F43F5E',
                        pointHoverBorderColor: '#ffffff',
                        pointHoverBorderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: isDark ? '#141C2B' : '#ffffff',
                        titleColor: isDark ? '#ffffff' : '#0F172A',
                        bodyColor: isDark ? '#CBD5E1' : '#475569',
                        borderColor: isDark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.08)',
                        borderWidth: 1,
                        padding: 10,
                        boxPadding: 4,
                        usePointStyle: true,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ₹ ' + context.parsed.y + 'K';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: {
                            color: isDark ? '#CBD5E1' : '#334155',
                            font: { family: 'Plus Jakarta Sans', size: 11, weight: '600' }
                        }
                    },
                    y: {
                        grid: {
                            color: isDark ? 'rgba(255, 255, 255, 0.08)' : 'rgba(0, 0, 0, 0.06)',
                            drawBorder: false
                        },
                        ticks: {
                            color: isDark ? '#CBD5E1' : '#334155',
                            font: { family: 'Plus Jakarta Sans', size: 11, weight: '600' },
                            callback: function(val) {
                                return '₹ ' + val + 'K';
                            }
                        }
                    }
                }
            }
        });
    }

    buildChart();

    window.addEventListener('theme-changed', function () {
        setTimeout(buildChart, 50);
    });
});
</script>
</x-layouts.admin>
