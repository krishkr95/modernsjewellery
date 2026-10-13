<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CouponController extends Controller
{
    public function index(): View
    {
        $coupons = Coupon::withCount('usages')->latest()->paginate(15);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create(): View
    {
        return view('admin.coupons.create');
    }

    public function show(Coupon $coupon): RedirectResponse
    {
        return redirect()->route('admin.coupons.edit', $coupon);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:coupons,code'],
            'type' => ['required', 'in:percentage,fixed_amount'],
            'value' => ['required', 'numeric', 'min:0.01'],
            'min_order_amount' => ['nullable', 'numeric', 'min:0'],
            'max_discount_amount' => ['nullable', 'numeric', 'min:0'],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'usage_limit_per_user' => ['nullable', 'integer', 'min:1'],
            'starts_at' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $coupon = Coupon::create([
            ...$validated,
            'code' => strtoupper(trim($validated['code'])),
            'is_active' => $request->boolean('is_active', true),
        ]);

        AdminActivityLog::record("Created coupon privilege code '{$coupon->code}'", $coupon);

        return redirect()->route('admin.coupons.index')->with('toast', [
            'type' => 'success',
            'message' => "Coupon '{$coupon->code}' created successfully.",
        ]);
    }

    public function edit(Coupon $coupon): View
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon): RedirectResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:coupons,code,' . $coupon->id],
            'type' => ['required', 'in:percentage,fixed_amount'],
            'value' => ['required', 'numeric', 'min:0.01'],
            'min_order_amount' => ['nullable', 'numeric', 'min:0'],
            'max_discount_amount' => ['nullable', 'numeric', 'min:0'],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'usage_limit_per_user' => ['nullable', 'integer', 'min:1'],
            'starts_at' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $coupon->update([
            ...$validated,
            'code' => strtoupper(trim($validated['code'])),
            'is_active' => $request->boolean('is_active', true),
        ]);

        AdminActivityLog::record("Updated coupon '{$coupon->code}'", $coupon);

        return redirect()->route('admin.coupons.index')->with('toast', [
            'type' => 'success',
            'message' => 'Coupon updated successfully.',
        ]);
    }

    public function toggleActive(Coupon $coupon): RedirectResponse
    {
        $coupon->update(['is_active' => !$coupon->is_active]);
        $status = $coupon->is_active ? 'activated' : 'deactivated';
        
        AdminActivityLog::record("Toggled coupon '{$coupon->code}' to {$status}", $coupon);

        return back()->with('toast', ['type' => 'success', 'message' => "Coupon {$status}."]);
    }

    public function destroy(Coupon $coupon): RedirectResponse
    {
        $code = $coupon->code;
        $coupon->delete();

        AdminActivityLog::record("Deleted coupon '{$code}'");

        return back()->with('toast', ['type' => 'success', 'message' => 'Coupon removed.']);
    }
}
