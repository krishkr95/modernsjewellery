<x-layouts.admin title="Dashboard | Luxora Haute Joaillerie Management">
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
                    <span class="text-xs sm:text-sm font-bold text-amber-600 dark:text-amber-400 mr-1">AED</span>1,134M
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
                    You succeed earn <span class="font-bold text-amber-700 dark:text-amber-400">AED 0.74M</span> today.<br>
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
                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Haute Fine Joaillerie Revenue and Sales (AED)</p>
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
                                $custEmail = $order->user->email ?? $order->customer_email ?? 'patron@luxora.ae';
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
                                    <span class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 mr-1">AED</span>{{ number_format($order->total_amount, 2) }}
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

        <!-- Right: Business Growth by Country -->
        <div class="content-card p-5 sm:p-6 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-white/5">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white font-serif tracking-tight">Business Growth</h3>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Based on Country</p>
                    </div>
                    <button class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 p-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"/></svg>
                    </button>
                </div>

                <!-- Vector World Illustration with Radar Pins -->
                <div class="relative my-4 flex items-center justify-center p-3 sm:p-4 rounded-xl bg-slate-100/50 dark:bg-white/[0.02] border border-slate-200/50 dark:border-white/5 overflow-hidden">
                    <svg viewBox="0 0 360 160" class="w-full h-auto opacity-75">
                        <!-- Simplified Luxury World Map Curves -->
                        <path d="M30,40 Q55,20 85,35 Q95,60 75,85 Q45,100 28,75 Z" fill="#CBD5E1" class="dark:fill-slate-700"/>
                        <path d="M50,105 Q65,90 75,105 Q85,135 65,145 Q50,140 50,105 Z" fill="#CBD5E1" class="dark:fill-slate-700"/>
                        <path d="M140,30 Q170,15 190,35 Q180,60 155,60 Q135,50 140,30 Z" fill="#CBD5E1" class="dark:fill-slate-700"/>
                        <path d="M150,70 Q180,65 195,95 Q185,135 155,140 Q135,110 150,70 Z" fill="#CBD5E1" class="dark:fill-slate-700"/>
                        <path d="M210,25 Q275,20 310,50 Q305,95 260,95 Q220,80 210,25 Z" fill="#CBD5E1" class="dark:fill-slate-700"/>
                        <path d="M265,110 Q295,105 315,120 Q305,145 275,145 Q260,130 265,110 Z" fill="#CBD5E1" class="dark:fill-slate-700"/>
                        
                        <!-- Pulse Radar Ring 1: UAE / Dubai -->
                        <circle cx="215" cy="65" r="7" fill="none" stroke="#D4AF37" stroke-width="1.5" opacity="0.8">
                            <animate attributeName="r" values="3;10;3" dur="2.5s" repeatCount="indefinite"/>
                            <animate attributeName="opacity" values="0.9;0.1;0.9" dur="2.5s" repeatCount="indefinite"/>
                        </circle>
                        <circle cx="215" cy="65" r="3.5" fill="#D4AF37"/>

                        <!-- Pulse Radar Ring 2: India / Mumbai -->
                        <circle cx="245" cy="75" r="6" fill="none" stroke="#3B82F6" stroke-width="1.5" opacity="0.8">
                            <animate attributeName="r" values="3;9;3" dur="2.8s" repeatCount="indefinite"/>
                            <animate attributeName="opacity" values="0.9;0.1;0.9" dur="2.8s" repeatCount="indefinite"/>
                        </circle>
                        <circle cx="245" cy="75" r="3" fill="#3B82F6"/>

                        <!-- Pulse Radar Ring 3: Saudi Arabia / Riyadh -->
                        <circle cx="205" cy="72" r="5" fill="none" stroke="#10B981" stroke-width="1.5" opacity="0.8">
                            <animate attributeName="r" values="2;8;2" dur="3s" repeatCount="indefinite"/>
                            <animate attributeName="opacity" values="0.9;0.1;0.9" dur="3s" repeatCount="indefinite"/>
                        </circle>
                        <circle cx="205" cy="72" r="2.5" fill="#10B981"/>
                    </svg>
                </div>

                <!-- Country Distribution Progress Bars -->
                <div class="space-y-3.5 mt-2">
                    <!-- UAE -->
                    <div>
                        <div class="flex items-center justify-between text-xs mb-1">
                            <div class="flex items-center gap-2">
                                <span class="text-sm">🇦🇪</span>
                                <span class="font-bold text-slate-900 dark:text-white">UAE</span>
                                <span class="text-[11px] text-slate-400 dark:text-slate-500 tnum">198,240 Customers</span>
                            </div>
                            <span class="font-bold text-emerald-600 dark:text-emerald-400 tnum">58%</span>
                        </div>
                        <div class="w-full h-2 rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden">
                            <div class="h-full rounded-full bg-emerald-500" style="width: 58%;"></div>
                        </div>
                    </div>

                    <!-- India -->
                    <div>
                        <div class="flex items-center justify-between text-xs mb-1">
                            <div class="flex items-center gap-2">
                                <span class="text-sm">🇮🇳</span>
                                <span class="font-bold text-slate-900 dark:text-white">India</span>
                                <span class="text-[11px] text-slate-400 dark:text-slate-500 tnum">121,240 Customers</span>
                            </div>
                            <span class="font-bold text-amber-600 dark:text-amber-400 tnum">16%</span>
                        </div>
                        <div class="w-full h-2 rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden">
                            <div class="h-full rounded-full bg-amber-500" style="width: 16%;"></div>
                        </div>
                    </div>

                    <!-- Saudi Arabia -->
                    <div>
                        <div class="flex items-center justify-between text-xs mb-1">
                            <div class="flex items-center gap-2">
                                <span class="text-sm">🇸🇦</span>
                                <span class="font-bold text-slate-900 dark:text-white">Saudi Arabia</span>
                                <span class="text-[11px] text-slate-400 dark:text-slate-500 tnum">84,500 Customers</span>
                            </div>
                            <span class="font-bold text-purple-600 dark:text-purple-400 tnum">14%</span>
                        </div>
                        <div class="w-full h-2 rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden">
                            <div class="h-full rounded-full bg-purple-500" style="width: 14%;"></div>
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
                                return context.dataset.label + ': AED ' + context.parsed.y + 'K';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: {
                            color: isDark ? '#64748B' : '#94A3B8',
                            font: { family: 'Plus Jakarta Sans', size: 11, weight: '500' }
                        }
                    },
                    y: {
                        grid: {
                            color: isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.04)',
                            drawBorder: false
                        },
                        ticks: {
                            color: isDark ? '#64748B' : '#94A3B8',
                            font: { family: 'Plus Jakarta Sans', size: 11, weight: '500' },
                            callback: function(val) {
                                return 'AED ' + val + 'K';
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
