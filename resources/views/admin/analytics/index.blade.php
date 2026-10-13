<x-layouts.admin title="Financial & Sales Analytics | Modern Jewellery House">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Commercial Analytics & Intelligence</h1>
            <p class="text-xs text-slate-500 mt-1">Useful revenue velocity, patron repeat rates, and product sales distributions.</p>
        </div>
        <div class="flex space-x-2 text-xs font-semibold">
            @foreach([7 => '7 Days', 14 => '14 Days', 30 => '30 Days'] as $d => $label)
                <a href="{{ route('admin.analytics.index', ['days' => $d]) }}" 
                   class="px-3 py-1.5 rounded-lg {{ $days === $d ? 'bg-slate-900 text-white' : 'bg-white border text-slate-700 hover:bg-slate-50' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- 4 Main KPIs -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
            <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-500">Gross Period Revenue</span>
            <p class="text-2xl font-bold text-slate-900 font-mono mt-2">&#36;{{ number_format($totalRevenue, 2) }}</p>
            <p class="text-[10px] text-slate-400 mt-1">Across {{ $days }} days</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
            <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-500">Period Orders</span>
            <p class="text-2xl font-bold text-slate-900 font-mono mt-2">{{ $ordersCount }}</p>
            <p class="text-[10px] text-slate-400 mt-1">Paid acquisitions</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
            <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-500">Average Order Value (AOV)</span>
            <p class="text-2xl font-bold text-emerald-700 font-mono mt-2">&#36;{{ number_format($averageOrderValue, 2) }}</p>
            <p class="text-[10px] text-slate-400 mt-1">Per transaction size</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
            <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-500">Patron Repeat Rate</span>
            <p class="text-2xl font-bold text-indigo-700 font-mono mt-2">{{ $repeatRate }}%</p>
            <p class="text-[10px] text-slate-400 mt-1">{{ $repeatCustomersCount }} repeat buyers</p>
        </div>
    </div>

    <!-- Daily Revenue Graph -->
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wide border-b border-slate-100 pb-3">Daily Settled Revenue Timeline</h3>
        <div class="mt-6 h-56 flex items-end justify-between gap-1.5 pt-4">
            @php $maxRev = max($chartRevenues->max(), 1); @endphp
            @foreach($chartRevenues as $idx => $val)
                @php $pct = max(6, round(($val / $maxRev) * 100)); @endphp
                <div class="flex-1 flex flex-col items-center group relative">
                    <div class="absolute -top-8 bg-slate-900 text-white text-[9px] font-mono py-1 px-1.5 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-10 shadow">
                        &#36;{{ number_format($val, 2) }}
                    </div>
                    <div class="w-full bg-slate-100 rounded-t h-40 flex items-end overflow-hidden">
                        <div class="w-full bg-gradient-to-t from-slate-900 to-amber-600 rounded-t transition-all group-hover:brightness-110" style="height: {{ $pct }}%;"></div>
                    </div>
                    @if($idx % 2 === 0)
                        <span class="text-[9px] text-slate-400 mt-1 font-mono">{{ $chartDates[$idx] }}</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Top Products & Top Categories -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm space-y-3">
            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">Highest Performing Pieces</h3>
            <div class="divide-y divide-slate-100 text-xs">
                @foreach($topProducts as $tp)
                    <div class="py-2.5 flex items-center justify-between">
                        <span class="font-bold text-slate-900">{{ $tp->name }}</span>
                        <div class="text-right">
                            <span class="font-mono font-bold text-slate-900">&#36;{{ number_format($tp->base_price, 2) }}</span>
                            <span class="text-[10px] text-emerald-600 block font-semibold">{{ $tp->sold_count ?? 0 }} pieces acquired</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm space-y-3">
            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">Category Volume Distribution</h3>
            <div class="divide-y divide-slate-100 text-xs">
                @foreach($topCategories as $tc)
                    <div class="py-2.5 flex items-center justify-between">
                        <span class="font-bold text-slate-900">{{ $tc->name }}</span>
                        <span class="font-mono text-slate-500">{{ $tc->products_count }} active pieces</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.admin>