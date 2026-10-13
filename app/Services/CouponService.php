<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Order;
use App\Models\User;
use InvalidArgumentException;

class CouponService
{
    /**
     * Validate and apply a coupon to a cart.
     */
    public function applyToCart(Cart $cart, string $code, ?User $user = null): array
    {
        $coupon = Coupon::where('code', trim($code))->first();

        if (!$coupon) {
            return [
                'success' => false,
                'message' => 'The promotional code entered is invalid.',
            ];
        }

        $userId = $user?->id ?? $cart->user_id;
        $subtotal = $cart->subtotal;

        if (!$coupon->isValidFor($subtotal, $userId)) {
            return [
                'success' => false,
                'message' => 'This promotion cannot be applied to your current order.',
            ];
        }

        $discount = $coupon->calculateDiscount($subtotal);

        $cart->update([
            'coupon_code' => $coupon->code,
            'discount_amount' => $discount,
        ]);

        return [
            'success' => true,
            'message' => 'Promotion applied successfully.',
            'discount_amount' => $discount,
            'coupon' => $coupon,
        ];
    }

    /**
     * Record usage of a coupon once order is placed.
     */
    public function recordUsage(Coupon $coupon, Order $order, User $user, float $discountApplied): CouponUsage
    {
        $usage = CouponUsage::create([
            'coupon_id' => $coupon->id,
            'user_id' => $user->id,
            'order_id' => $order->id,
            'discount_applied' => $discountApplied,
            'used_at' => now(),
        ]);

        $coupon->increment('times_used');

        return $usage;
    }
}
