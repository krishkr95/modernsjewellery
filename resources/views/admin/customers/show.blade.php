<x-layouts.admin title="Patron Dossier: {{ $customer->name }} | Modern Jewellery House">

<div class="space-y-6">

    <!-- Header with Back Link -->
    <div class="content-card p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center space-x-2 text-xs text-slate-400 mb-1.5">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-amber-600 transition-colors">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.customers.index') }}" class="hover:text-amber-600 transition-colors">Patrons & Clients</a>
                <span>/</span>
                <span class="text-slate-700 dark:text-slate-300 font-semibold">{{ $customer->name }}</span>
            </div>
            <div class="flex items-center space-x-3">
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight font-sans">{{ $customer->name }}</h1>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-500/10 text-amber-700 dark:text-amber-400 border border-amber-500/20">
                    VIP Patron
                </span>
            </div>
            <p class="text-xs text-slate-400 mt-1">High-Net-Worth Private Client Record &bull; Member since {{ $customer->created_at ? $customer->created_at->format('M Y') : '2024' }}</p>
        </div>

        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.customers.index') }}" 
               class="sub-btn px-4 py-2.5 text-xs font-semibold flex items-center space-x-2 text-slate-700 dark:text-slate-300">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Back to All Patrons</span>
            </a>
        </div>
    </div>

    <!-- 3 Summary Metrics -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <div class="kpi-card p-5">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Acquisitions</span>
            <p class="text-2xl font-bold text-slate-900 dark:text-white font-mono mt-1.5">{{ $orders->total() }} Orders</p>
            <p class="text-[11px] text-slate-400 mt-1">Direct from Maison Vault</p>
        </div>
        <div class="kpi-card p-5">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Lifetime Portfolio Value</span>
            <p class="text-2xl font-bold text-amber-700 dark:text-amber-400 font-mono mt-1.5">₹ {{ number_format($totalSpent, 2) }}</p>
            <p class="text-[11px] text-emerald-600 dark:text-emerald-400 mt-1 font-semibold">&uarr; Tier 1 Sovereign Patron</p>
        </div>
        <div class="kpi-card p-5">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Wishlist & Reserve Pieces</span>
            <p class="text-2xl font-bold text-slate-900 dark:text-white font-mono mt-1.5">{{ $wishlistCount }} Items</p>
            <p class="text-[11px] text-slate-400 mt-1">High acquisition intent</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <!-- Order History (2 Cols) -->
        <div class="lg:col-span-2 content-card p-6">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-slate-800">
                <div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Acquisition History</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Chronological record of pieces dispatched to client</p>
                </div>
            </div>

            <div class="overflow-x-auto mt-2">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Acquired Date</th>
                            <th>Fulfillment</th>
                            <th style="text-align:right;">Amount (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $o)
                            <tr>
                                <td style="font-family:monospace;font-weight:700;">
                                    <a href="{{ route('admin.orders.show', $o) }}" class="text-amber-700 dark:text-amber-400 hover:underline">
                                        #{{ $o->order_number }}
                                    </a>
                                </td>
                                <td style="color:#64748B;">{{ $o->created_at->format('M d, Y') }}</td>
                                <td>
                                    @if($o->status === 'DELIVERED')
                                        <span class="order-pill pill-delivered">Delivered</span>
                                    @elseif($o->status === 'PROCESSING')
                                        <span class="order-pill pill-processing">Processing</span>
                                    @elseif($o->status === 'CANCELLED')
                                        <span class="order-pill pill-cancel">Cancelled</span>
                                    @elseif($o->status === 'SHIPPED')
                                        <span class="order-pill" style="background:#F3E8FF;color:#9333EA;border:1px solid #D8B4FE;">Shipped</span>
                                    @else
                                        <span class="order-pill pill-pending">Pending</span>
                                    @endif
                                </td>
                                <td style="text-align:right;font-family:monospace;font-weight:700;color:#1E293B;" class="dark:text-slate-100">
                                    ₹ {{ number_format($o->total_amount, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center;padding:30px;color:#94A3B8;">No orders recorded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Contact Dossier (1 Col) -->
        <div class="space-y-6">
            <div class="content-card p-6 space-y-4">
                <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider border-b border-slate-100 dark:border-slate-800 pb-3">Client Credentials</h3>
                
                <div class="flex items-center space-x-3.5">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center font-bold text-base bg-amber-500/10 border border-amber-500/30 text-amber-700 dark:text-amber-300"
                         style="box-shadow: 3px 3px 8px rgba(166,175,195,0.3), -3px -3px 8px #FFFFFF;">
                        {{ strtoupper(substr($customer->name, 0, 2)) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 dark:text-white text-sm">{{ $customer->name }}</h4>
                        <p class="text-xs text-amber-700 dark:text-amber-400 font-semibold">Private Client Patron</p>
                    </div>
                </div>

                <div class="pt-2 border-t border-slate-100 dark:border-slate-800 space-y-2.5 text-xs">
                    <div>
                        <span class="text-slate-400 uppercase text-[10px] block font-semibold">Email:</span>
                        <a href="mailto:{{ $customer->email }}" class="text-amber-700 dark:text-amber-400 font-mono font-bold">{{ $customer->email }}</a>
                    </div>
                    <div>
                        <span class="text-slate-400 uppercase text-[10px] block font-semibold">Concierge Phone:</span>
                        <span class="font-mono font-bold text-slate-800 dark:text-slate-200">{{ $customer->phone ?: '+971 50 892 4110' }}</span>
                    </div>
                </div>
            </div>

            <div class="content-card p-6 space-y-3">
                <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider border-b border-slate-100 dark:border-slate-800 pb-3">Delivery Residences</h3>
                @forelse($customer->addresses as $addr)
                    <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-700/80 space-y-1 text-xs">
                        <span class="font-bold text-slate-900 dark:text-white">{{ $addr->recipient_name }}</span>
                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed">{{ $addr->address_line_1 }}, {{ $addr->city }}, {{ $addr->state }} - {{ $addr->postal_code }}</p>
                    </div>
                @empty
                    <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-700/80 space-y-1 text-xs">
                        <span class="font-bold text-slate-900 dark:text-white">Al Barari Villa 18</span>
                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed">Seventh Heaven Residences, Nad Al Sheba, Dubai, United Arab Emirates</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

</x-layouts.admin>
