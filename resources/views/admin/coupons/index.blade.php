<x-layouts.admin title="Privileges & Coupons | Modern Jewellery House">
<div class="space-y-6">
    <div class="content-card p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight font-sans">Patron Privilege Codes & Private Passes</h1>
            <p class="text-xs text-slate-400 mt-1">Manage private client VIP concessions, invitation passcodes, and minimum acquisition thresholds.</p>
        </div>
        <a href="{{ route('admin.coupons.create') }}" class="btn-gold px-5 py-2.5 text-xs font-bold uppercase tracking-wider">
            + Issue Privilege Pass
        </a>
    </div>

    <div class="content-card p-6">
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Passcode</th>
                        <th>Concession Value</th>
                        <th>Min Portfolio Spend</th>
                        <th style="text-align:center;">Redemptions</th>
                        <th>Expiry</th>
                        <th>Status</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($coupons as $coup)
                        <tr>
                            <td style="font-family:monospace;font-weight:700;font-size:0.88rem;color:#1E293B;" class="dark:text-white">
                                {{ $coup->code }}
                            </td>
                            <td style="font-weight:700;color:#10B981;font-family:monospace;">
                                {{ $coup->type === 'percentage' ? $coup->value . '%' : '₹ ' . number_format($coup->value, 2) }}
                            </td>
                            <td style="font-family:monospace;color:#64748B;">
                                {{ $coup->min_order_amount ? '₹ ' . number_format($coup->min_order_amount, 2) : 'No Minimum' }}
                            </td>
                            <td style="text-align:center;font-family:monospace;font-weight:700;">
                                {{ $coup->usages_count }} / {{ $coup->usage_limit ?: 'âˆž' }}
                            </td>
                            <td style="color:#64748B;font-size:0.75rem;">
                                {{ $coup->expires_at ? $coup->expires_at->format('M d, Y') : 'Indefinite' }}
                            </td>
                            <td>
                                @if($coup->is_active)
                                    <span class="order-pill pill-delivered">Active Pass</span>
                                @else
                                    <span class="order-pill pill-cancel">Archived</span>
                                @endif
                            </td>
                            <td style="text-align:right;">
                                <div style="display:inline-flex;gap:6px;">
                                    <a href="{{ route('admin.coupons.edit', $coup) }}" class="sub-btn px-3 py-1 text-[11px] font-bold text-slate-700 dark:text-slate-300">Edit</a>
                                    <form action="{{ route('admin.coupons.destroy', $coup) }}" method="POST" class="inline" onsubmit="return confirm('Revoke coupon pass?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="sub-btn px-3 py-1 text-[11px] font-bold text-rose-600 hover:text-rose-700">Revoke</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center;padding:30px;color:#94A3B8;">No privilege codes configured.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-layouts.admin>