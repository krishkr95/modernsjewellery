<x-layouts.admin title="Edit Coupon | Modern Jewellery House">
    <div class="flex items-center justify-between pb-2 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Coupon: {{ $coupon->code }}</h1>
        </div>
        <a href="{{ route('admin.coupons.index') }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900">&larr; Back</a>
    </div>

    <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST" class="max-w-xl bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4 text-xs">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-semibold text-slate-700 mb-1">Coupon Code *</label>
            <input type="text" name="code" required value="{{ old('code', $coupon->code) }}" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs uppercase font-mono font-bold text-slate-900">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Discount Type</label>
                <select name="type" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs">
                    <option value="percentage" {{ $coupon->type === 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                    <option value="fixed_amount" {{ $coupon->type === 'fixed_amount' ? 'selected' : '' }}>Fixed Amount ($)</option>
                </select>
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Privilege Value</label>
                <input type="number" step="0.01" name="value" required value="{{ old('value', $coupon->value) }}" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs font-mono font-bold">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Minimum Order ($)</label>
                <input type="number" step="0.01" name="min_order_amount" value="{{ old('min_order_amount', $coupon->min_order_amount) }}" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs font-mono">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Max Cap ($)</label>
                <input type="number" step="0.01" name="max_discount_amount" value="{{ old('max_discount_amount', $coupon->max_discount_amount) }}" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs font-mono">
            </div>
        </div>
        <button type="submit" class="w-full py-2.5 bg-slate-900 text-white rounded font-bold uppercase tracking-wider text-xs">
            Update Coupon
        </button>
    </form>
</x-layouts.admin>