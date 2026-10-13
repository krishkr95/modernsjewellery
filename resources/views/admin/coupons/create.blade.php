<x-layouts.admin title="Create Coupon | Modern Jewellery House">
    <div class="flex items-center justify-between pb-2 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Create Promotional Coupon</h1>
            <p class="text-xs text-slate-500 mt-1">Configure discount rules, threshold limits, and validity dates.</p>
        </div>
        <a href="{{ route('admin.coupons.index') }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900">&larr; Back</a>
    </div>

    <form action="{{ route('admin.coupons.store') }}" method="POST" class="max-w-xl bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4 text-xs">
        @csrf
        <div>
            <label class="block font-semibold text-slate-700 mb-1">Coupon Code (Uppercase) *</label>
            <input type="text" name="code" required placeholder="e.g. MAISON10" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs uppercase font-mono font-bold text-slate-900">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Discount Type *</label>
                <select name="type" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs">
                    <option value="percentage">Percentage (%)</option>
                    <option value="fixed_amount">Fixed Amount ($)</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Privilege Value *</label>
                <input type="number" step="0.01" name="value" required placeholder="10.00" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs font-mono font-bold">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Minimum Order ($)</label>
                <input type="number" step="0.01" name="min_order_amount" placeholder="0.00" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs font-mono">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Maximum Discount Cap ($)</label>
                <input type="number" step="0.01" name="max_discount_amount" placeholder="e.g. 500.00" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs font-mono">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Total Usage Limit</label>
                <input type="number" name="usage_limit" placeholder="Unlimited if blank" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs font-mono">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Per-User Limit</label>
                <input type="number" name="usage_limit_per_user" value="1" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs font-mono">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Starts At</label>
                <input type="datetime-local" name="starts_at" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Expires At</label>
                <input type="datetime-local" name="expires_at" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs">
            </div>
        </div>
        <button type="submit" class="w-full py-2.5 bg-slate-900 text-white rounded font-bold uppercase tracking-wider text-xs">
            Save Coupon
        </button>
    </form>
</x-layouts.admin>