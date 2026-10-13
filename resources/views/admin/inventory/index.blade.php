<x-layouts.admin title="Vault Inventory | Modern Jewellery House">
<div class="space-y-6" x-data="{ adjustModal: false, selectedItem: null }">

    <!-- Header & Summary Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-5">
        <!-- Metric 1: Tracked Pieces -->
        <div class="kpi-card p-4 sm:p-5" style="border-left: 4px solid #DFB76C;">
            <p class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Tracked Pieces</p>
            <p class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white tnum">{{ $inventories->total() }}</p>
            <p class="text-[10px] sm:text-[11px] text-slate-400 mt-1">Fine joaillerie pieces</p>
        </div>

        <!-- Metric 2: Total Units In Vault -->
        <div class="kpi-card p-4 sm:p-5" style="border-left: 4px solid #10B981;">
            <p class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Vault Inventory</p>
            <p class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white tnum">{{ $inventories->sum('quantity') }}</p>
            <p class="text-[10px] sm:text-[11px] text-emerald-600 dark:text-emerald-400 font-semibold mt-1">Secured in high vault</p>
        </div>

        <!-- Metric 3: Low Stock Warning -->
        <div class="kpi-card p-4 sm:p-5" style="border-left: 4px solid #F59E0B;">
            <p class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Low Stock Pieces</p>
            <p class="text-xl sm:text-2xl font-extrabold text-amber-700 dark:text-amber-400 tnum">{{ $lowStockCount ?? 2 }}</p>
            <p class="text-[10px] sm:text-[11px] text-amber-700 dark:text-amber-400 font-semibold mt-1">Requires master restocking</p>
        </div>

        <!-- Metric 4: Vault Valuation -->
        <div class="kpi-card p-4 sm:p-5" style="border-left: 4px solid #3B82F6;">
            <p class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Vault Valuation</p>
            <p class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white tnum">₹ 14.8M</p>
            <p class="text-[10px] sm:text-[11px] text-blue-600 dark:text-blue-400 font-semibold mt-1">Insured by Lloyds</p>
        </div>
    </div>

    <!-- Inventory Table Card -->
    <div class="content-card p-4 sm:p-6">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-white/5 flex-wrap gap-3">
            <div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white font-serif">Vault Stock Ledger</h3>
                <p class="text-xs text-slate-400 mt-0.5">Real-time allocation and reservation ledger</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="btn-gold px-4 py-2 text-xs font-bold">
                + Add Piece to Vault
            </a>
        </div>

        <div class="table-responsive-container mt-3">
            <table class="admin-table" style="min-width: 680px;">
                <thead>
                    <tr>
                        <th>Piece & Master SKU</th>
                        <th style="text-align:center;">Vault Quantity</th>
                        <th style="text-align:center;">Reserved</th>
                        <th style="text-align:center;">Available</th>
                        <th>Status</th>
                        <th style="text-align:right;">Quick Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inventories as $inv)
                        @php
                            $prod = $inv->product;
                            $available = max(0, $inv->quantity - $inv->reserved_quantity);
                        @endphp
                        <tr>
                            <td>
                                <div>
                                    <span class="font-bold text-xs text-slate-900 dark:text-white block">{{ $prod ? $prod->name : 'Fine Jewellery Piece' }}</span>
                                    <span class="text-[11px] text-slate-400 tnum">{{ $prod ? $prod->sku : ('SKU-MJH-' . $inv->id) }}</span>
                                </div>
                            </td>
                            <td style="text-align:center; font-weight:700;" class="text-xs text-slate-900 dark:text-white tnum">
                                {{ $inv->quantity }}
                            </td>
                            <td style="text-align:center; color:#94A3B8;" class="text-xs tnum">
                                {{ $inv->reserved_quantity }}
                            </td>
                            <td style="text-align:center; font-weight:700;" class="text-xs text-emerald-600 dark:text-emerald-400 tnum">
                                {{ $available }}
                            </td>
                            <td>
                                @if($available <= 2)
                                    <span class="order-pill pill-processing">Low Stock</span>
                                @elseif($available == 0)
                                    <span class="order-pill pill-cancel">Restock Needed</span>
                                @else
                                    <span class="order-pill pill-delivered">Optimal</span>
                                @endif
                            </td>
                            <td style="text-align:right; white-space:nowrap;">
                                <form action="{{ route('admin.inventory.adjust', $inv) }}" method="POST" class="inline-flex items-center gap-1.5">
                                    @csrf
                                    <input type="number" name="adjustment" value="1" style="width:48px;" class="sub-input py-1 px-1.5 text-center text-xs tnum">
                                    <button type="submit" name="type" value="add" class="sub-btn px-2 py-1 text-xs font-bold text-emerald-600" title="Add 1 Unit">+</button>
                                    <button type="submit" name="type" value="subtract" class="sub-btn px-2 py-1 text-xs font-bold text-rose-600" title="Deduct 1 Unit">&minus;</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; padding:32px; color:#94A3B8;">No vault inventory records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($inventories->hasPages())
            <div class="pt-4 mt-4 border-t border-slate-100 dark:border-white/5 flex items-center justify-between text-xs">
                {{ $inventories->links() }}
            </div>
        @endif
    </div>

</div>
</x-layouts.admin>