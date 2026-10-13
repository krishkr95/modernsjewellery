<x-layouts.admin title="All Orders & Client Acquisitions | Modern Jewellery House">
<div style="display:flex;flex-direction:column;gap:20px;" x-data="{ showFilters: false }">

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
                    <span class="text-xs sm:text-sm font-bold text-amber-600 dark:text-amber-400 mr-1">₹</span>5.53M
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
                    {{ $kpi['total_orders'] ?? $counts['all'] ?? 9 }}
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
                    {{ $kpi['completed_orders'] ?? $counts['delivered'] ?? 3 }}
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
                    {{ $kpi['cancelled_orders'] ?? $counts['cancelled'] ?? 1 }}
                </p>
            </div>
            <div class="flex items-center gap-1.5 mt-2 flex-wrap">
                <span class="text-[11px] sm:text-xs font-bold text-rose-600 dark:text-rose-400">2%</span>
                <span class="text-[10px] sm:text-[11px] text-slate-400 dark:text-slate-500 truncate">vs last month</span>
            </div>
        </div>

    </div>

    <!-- ================= ROW 2: STATUS FILTER TABS (Smooth Touch Scroll) ================= -->
    <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-none" style="-webkit-overflow-scrolling: touch;">
        @php
            $currentStatus = request('status', 'all');
            $tabs = [
                'all' => ['label' => 'All Orders', 'count' => $counts['all'] ?? 9],
                'pending' => ['label' => 'Pending', 'count' => $counts['pending'] ?? 1],
                'processing' => ['label' => 'Processing', 'count' => $counts['processing'] ?? 2],
                'shipped' => ['label' => 'Shipped', 'count' => $counts['shipped'] ?? 1],
                'delivered' => ['label' => 'Delivered', 'count' => $counts['delivered'] ?? 3],
                'cancelled' => ['label' => 'Cancelled', 'count' => $counts['cancelled'] ?? 1],
                'refunds' => ['label' => 'Refunds', 'count' => $counts['refunds'] ?? 0],
            ];
        @endphp

        @foreach($tabs as $key => $tab)
            @php $isActive = ($currentStatus === $key); @endphp
            <a href="{{ route('admin.orders.index', array_merge(request()->query(), ['status' => $key])) }}" 
               class="px-3.5 py-1.5 sm:px-4 sm:py-2 rounded-full text-xs font-bold transition-all flex items-center gap-2 whitespace-nowrap {{ $isActive ? 'gold-active-pill text-white shadow-sm' : 'sub-btn text-slate-600 dark:text-slate-300' }}">
                <span>{{ $tab['label'] }}</span>
                <span class="text-[10px] px-2 py-0.5 rounded-full font-bold tnum {{ $isActive ? 'bg-white/25 text-white' : 'bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400' }}">
                    {{ $tab['count'] }}
                </span>
            </a>
        @endforeach
    </div>

    <!-- ================= ROW 3: ORDERS CONTENT CARD ================= -->
    <div class="content-card p-4 sm:p-6">
        
        <!-- Controls Bar: Title & Actions Organized for Mobile & Desktop -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3.5 pb-4 border-b border-slate-100 dark:border-white/5">
            <!-- Left: Title & Live Count Badge -->
            <div class="flex items-center justify-between sm:justify-start gap-2.5">
                <div class="flex items-center gap-2.5">
                    <h3 class="text-base font-bold text-slate-900 dark:text-white font-serif tracking-tight">Latest Order</h3>
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-500/10 dark:bg-amber-500/20 text-amber-700 dark:text-amber-400 border border-amber-500/20">
                        +{{ $orders->total() }} Orders
                    </span>
                </div>
                <!-- Mobile only 'See All' right aligned next to title -->
                <div class="sm:hidden">
                    <a href="{{ route('admin.orders.index', ['status' => 'all']) }}" 
                       class="btn-gold px-3 py-1.5 text-xs font-bold whitespace-nowrap">
                        See All
                    </a>
                </div>
            </div>

            <!-- Right: Search, Date, Filters & See All -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                <!-- Search Input Inset -->
                <form action="{{ route('admin.orders.index') }}" method="GET" class="relative flex-1 sm:w-60">
                    <input type="hidden" name="status" value="{{ request('status', 'all') }}">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search customer, order..."
                           class="sub-input w-full pl-8 pr-3 py-1.5 text-xs">
                    <svg class="w-3.5 h-3.5 text-slate-400 absolute left-2.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </form>

                <!-- Action Button Group -->
                <div class="flex items-center gap-2">
                    <button type="button" @click="showFilters = !showFilters"
                            class="sub-btn flex-1 sm:flex-initial px-3 py-1.5 text-xs font-semibold flex items-center justify-center gap-1.5 text-slate-700 dark:text-slate-300">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Select Date</span>
                    </button>

                    <button type="button" @click="showFilters = !showFilters"
                            class="sub-btn flex-1 sm:flex-initial px-3 py-1.5 text-xs font-semibold flex items-center justify-center gap-1.5 text-slate-700 dark:text-slate-300">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <span>Filters</span>
                    </button>

                    <!-- Desktop 'See All' -->
                    <div class="hidden sm:block">
                        <a href="{{ route('admin.orders.index', ['status' => 'all']) }}" 
                           class="btn-gold px-3.5 py-1.5 text-xs font-bold whitespace-nowrap">
                            See All
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Collapsible Filter Drawer -->
        <div x-show="showFilters" x-collapse x-cloak class="mt-4 p-4 rounded-xl bg-slate-100/60 dark:bg-white/[0.02] border border-slate-200/60 dark:border-white/5 text-xs">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-3 items-end">
                <input type="hidden" name="status" value="{{ request('status', 'all') }}">
                <div>
                    <label class="block font-semibold text-slate-600 dark:text-slate-400 mb-1">Search Term</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Order number, patron..." class="sub-input w-full px-3 py-2 text-xs">
                </div>
                <div>
                    <label class="block font-semibold text-slate-600 dark:text-slate-400 mb-1">Acquisition Date</label>
                    <input type="date" name="date" value="{{ request('date') }}" class="sub-input w-full px-3 py-2 text-xs">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="btn-gold flex-1 py-2 text-xs font-bold uppercase tracking-wider">
                        Apply Filter
                    </button>
                    <a href="{{ route('admin.orders.index') }}" class="sub-btn px-4 py-2 text-xs font-semibold flex items-center justify-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Orders Table with Smooth Responsive Horizontal Scroll -->
        <div class="table-responsive-container mt-3">
            <table class="admin-table" style="min-width: 780px;">
                <thead>
                    <tr>
                        <th style="width: 120px;">Order #</th>
                        <th style="width: 100px;">Channel</th>
                        <th>Client Dossier</th>
                        <th style="width: 90px;">Pieces</th>
                        <th style="width: 140px;">Total Settled (₹)</th>
                        <th style="width: 120px;">Stage</th>
                        <th style="width: 90px; text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        @php
                            $isShop = ($order->id % 2 === 1);
                            $custName = $order->user->name ?? $order->shipping_address['name'] ?? ('Patron #' . $order->id);
                            $custEmail = $order->user->email ?? $order->customer_email ?? 'patron@modernjewellery.in';
                            $initials = strtoupper(substr(trim($custName), 0, 2));
                            $itemCount = $order->items ? $order->items->count() : 1;
                        @endphp
                        <tr>
                            <!-- Order Number & Date -->
                            <td style="white-space: nowrap;">
                                <div>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="font-bold text-xs text-amber-700 dark:text-amber-400 hover:underline font-mono">
                                        #{{ $order->order_number }}
                                    </a>
                                    <p class="text-[10px] text-slate-500 dark:text-slate-400 mt-0.5">{{ $order->created_at->format('d M Y') }}</p>
                                </div>
                            </td>

                            <!-- Channel / Source -->
                            <td style="white-space: nowrap;">
                                <div class="flex items-center gap-1.5">
                                    @if($isShop)
                                        <div class="w-6 h-6 rounded-lg bg-emerald-500/10 dark:bg-emerald-500/20 flex items-center justify-center flex-shrink-0 text-emerald-600 dark:text-emerald-400">
                                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M19.5 6.5h-3.3c-.3-2.6-2.2-4.5-4.7-4.5s-4.4 1.9-4.7 4.5H3.5C2.7 6.5 2 7.2 2 8v12c0 .8.7 1.5 1.5 1.5h16c.8 0 1.5-.7 1.5-1.5V8c0-.8-.7-1.5-1.5-1.5zM11.5 4c1.4 0 2.5 1.1 2.7 2.5H8.8c.2-1.4 1.3-2.5 2.7-2.5zm8 15.5h-15V8.5h3.3v1.5c0 .6.4 1 1 1s1-.4 1-1V8.5h4.4v1.5c0 .6.4 1 1 1s1-.4 1-1V8.5h3.3v11z"/></svg>
                                        </div>
                                        <span class="font-semibold text-[11px] text-slate-800 dark:text-slate-200">Boutique</span>
                                    @else
                                        <div class="w-6 h-6 rounded-lg bg-slate-200 dark:bg-slate-800 flex items-center justify-center flex-shrink-0 text-slate-700 dark:text-slate-300">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-3-3-3m0 18c-1.657 0-3-4.03-3-9s1.343-3 3-3m-9 9a9 9 0 019-9"/></svg>
                                        </div>
                                        <span class="font-semibold text-[11px] text-slate-800 dark:text-slate-200">Online Store</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Customer (Initials Avatar) -->
                            <td>
                                <div class="flex items-center gap-2.5 min-w-[170px]">
                                    <div class="w-8 h-8 rounded-full bg-amber-500/10 dark:bg-amber-500/20 border border-amber-500/30 flex items-center justify-center text-amber-700 dark:text-amber-400 font-bold text-xs flex-shrink-0">
                                        {{ $initials }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="font-bold text-xs text-slate-900 dark:text-white hover:text-amber-700 dark:hover:text-amber-400 block truncate transition-colors">
                                            {{ $custName }}
                                        </a>
                                        <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate mt-0.5">{{ $custEmail }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Pieces Count -->
                            <td style="white-space: nowrap;">
                                <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-slate-300">
                                    {{ $itemCount }} {{ Str::plural('piece', $itemCount) }}
                                </span>
                            </td>

                            <!-- Total (Rupee Tabular Figure) -->
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
                                @elseif($order->status === 'REFUNDED')
                                    <span class="order-pill" style="background:#F1F5F9;color:#64748B;border:1px solid #CBD5E1;">Refunded</span>
                                @else
                                    <span class="order-pill pill-pending">Pending</span>
                                @endif
                            </td>

                            <!-- Action Icons -->
                            <td style="text-align: right; white-space: nowrap;">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="sub-btn p-1.5 text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white" title="Inspect Order & Print Bill Receipt">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 32px; color: #94A3B8;">No customer orders found matching this filter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="pt-4 mt-4 border-t border-slate-100 dark:border-white/5 flex items-center justify-between text-xs">
                {{ $orders->links() }}
            </div>
        @endif

    </div>

</div>
</x-layouts.admin>
