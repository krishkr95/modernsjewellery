<x-layouts.admin title="Customers & Patrons | Modern Jewellery House">
<div class="space-y-6">

    <!-- Header & Actions -->
    <div class="content-card p-4 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-3.5">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white tracking-tight font-serif">Patrons & Private Clients</h1>
            <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Directory of distinguished collectors, order history ledgers, and lifetime valuations.</p>
        </div>
        <div>
            <span class="px-3.5 py-1.5 rounded-full text-xs font-bold bg-amber-500/10 dark:bg-amber-500/20 text-amber-700 dark:text-amber-400 border border-amber-500/20 uppercase tracking-wider">
                Total Patrons: {{ $customers->total() }}
            </span>
        </div>
    </div>

    <!-- Customers Table Card -->
    <div class="content-card p-4 sm:p-6">
        <!-- Search bar inside header -->
        <div class="flex items-center justify-between mb-4 flex-wrap gap-3">
            <form action="{{ route('admin.customers.index') }}" method="GET" class="flex items-center gap-2 max-w-sm flex-1">
                <div class="relative flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search patron name, email, phone..."
                           class="sub-input w-full pl-9 pr-3 py-2 text-xs">
                    <svg class="w-3.5 h-3.5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <button type="submit" class="btn-gold px-4 py-2 text-xs font-bold whitespace-nowrap">
                    Search
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.customers.index') }}" class="sub-btn px-3 py-2 text-xs font-semibold">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="table-responsive-container">
            <table class="admin-table" style="min-width: 680px;">
                <thead>
                    <tr>
                        <th>Patron</th>
                        <th>Contact</th>
                        <th style="text-align:center;">Orders</th>
                        <th style="text-align:right;">Lifetime Spend</th>
                        <th>Member Since</th>
                        <th style="text-align:right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $c)
                        @php
                            $spent = $c->orders->sum('total_amount');
                            $initials = strtoupper(substr(trim($c->name), 0, 2));
                        @endphp
                        <tr>
                            <!-- Patron Info with Initials Avatar -->
                            <td>
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-full bg-amber-500/10 dark:bg-amber-500/20 border border-amber-500/30 flex items-center justify-center text-amber-700 dark:text-amber-400 font-bold text-xs flex-shrink-0">
                                        {{ $initials }}
                                    </div>
                                    <div class="min-w-0">
                                        <a href="{{ route('admin.customers.show', $c) }}" class="font-bold text-xs text-slate-900 dark:text-white hover:text-amber-700 dark:hover:text-amber-400 block truncate transition-colors">
                                            {{ $c->name }}
                                        </a>
                                        <span class="text-[10px] text-amber-700 dark:text-amber-400 uppercase tracking-wider font-semibold">VIP Patron</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Contact -->
                            <td>
                                <div>
                                    <p class="text-xs text-slate-800 dark:text-slate-200">{{ $c->email }}</p>
                                    <p class="text-[11px] text-slate-400 mt-0.5 tnum">{{ $c->phone ?: 'Concierge Unlisted' }}</p>
                                </div>
                            </td>

                            <!-- Orders Count -->
                            <td style="text-align:center; font-weight:700;" class="text-xs text-slate-900 dark:text-white tnum">
                                {{ $c->orders->count() }}
                            </td>

                            <!-- Lifetime Spend -->
                            <td style="text-align:right; font-weight:700; white-space:nowrap;" class="text-xs text-slate-900 dark:text-amber-400 tnum">
                                ₹ {{ number_format($spent, 2) }}
                            </td>

                            <!-- Member Since -->
                            <td style="color:#94A3B8; font-size:0.75rem;" class="tnum">
                                {{ $c->created_at ? $c->created_at->format('M d, Y') : 'Heritage' }}
                            </td>

                            <!-- Actions -->
                            <td style="text-align:right; white-space:nowrap;">
                                <a href="{{ route('admin.customers.show', $c) }}" class="sub-btn px-3 py-1 text-[11px] font-bold text-slate-700 dark:text-slate-300">
                                    Dossier &rarr;
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; padding:32px; color:#94A3B8;">No patrons found matching your search.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($customers->hasPages())
            <div class="pt-4 mt-4 border-t border-slate-100 dark:border-white/5 flex items-center justify-between text-xs">
                {{ $customers->links() }}
            </div>
        @endif
    </div>

</div>
</x-layouts.admin>