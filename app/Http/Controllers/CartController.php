<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddToCartRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\CouponService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(
        protected CouponService $couponService
    ) {}

    public static function getActiveCart(Request $request): Cart
    {
        if (!$request->hasSession()) {
            $dummyCart = new Cart();
            $dummyCart->setRelation('items', collect());
            return $dummyCart;
        }

        $userId = Auth::id();
        $sessionId = $request->session()->getId();

        if ($userId) {
            $cart = Cart::firstOrCreate(
                ['user_id' => $userId, 'status' => 'active'],
                ['session_id' => $sessionId]
            );
        } else {
            $cart = Cart::firstOrCreate(
                ['session_id' => $sessionId, 'status' => 'active'],
                ['user_id' => null]
            );
        }

        return $cart->load(['items.product.primaryImage', 'items.variant.inventory']);
    }

    
    public function drawer(Request $request): JsonResponse
    {
        $cart = self::getActiveCart($request);
        return response()->json([
            'html' => view('components.cart-drawer-content', ['drawerCart' => $cart])->render(),
            'cart_count' => $cart->total_items_count,
            'subtotal' => number_format($cart->subtotal, 2),
            'total' => number_format($cart->subtotal - (float) $cart->discount_amount, 2),
        ]);
    }

    public function index(Request $request): View
    {
        $cart = self::getActiveCart($request);
        return view('pages.cart.index', compact('cart'));
    }

    public function store(AddToCartRequest $request): JsonResponse|RedirectResponse
    {
        $cart = self::getActiveCart($request);
        $product = Product::findOrFail($request->integer('product_id'));

        $variantId = $request->integer('variant_id');
        $size = $request->string('size');

        $variant = null;
        if ($variantId) {
            $variant = ProductVariant::where('product_id', $product->id)->find($variantId);
        }
        if (!$variant && $size->isNotEmpty()) {
            $variant = ProductVariant::where('product_id', $product->id)->where('size', $size)->first();
        }
        if (!$variant) {
            $variant = $product->defaultVariant ?? $product->variants()->first();
        }
        if (!$variant) {
            $variant = ProductVariant::create([
                'product_id' => $product->id,
                'sku' => $product->sku . '-STD',
                'title' => 'Standard Atelier Edition',
                'price' => $product->base_price,
                'is_default' => true,
                'is_active' => true,
            ]);
        }

        $unitPrice = (float) ($variant->price ?: $product->base_price);
        $quantity = $request->integer('quantity', 1);

        // Stock Validation
        $inventory = Inventory::where('product_variant_id', $variant->id)->first();
        $existingItem = CartItem::where('cart_id', $cart->id)
            ->where('product_variant_id', $variant->id)
            ->first();

        $targetQuantity = ($existingItem ? $existingItem->quantity : 0) + $quantity;

        if ($inventory && $inventory->available_quantity < $targetQuantity) {
            $msg = "Atelier reservation limit reached: Only {$inventory->available_quantity} available in our vault.";
            return $request->wantsJson()
                ? response()->json(['success' => false, 'message' => $msg], 422)
                : back()->withErrors($msg);
        }

        if ($existingItem) {
            $existingItem->update([
                'quantity' => $targetQuantity,
                'total_price' => $unitPrice * $targetQuantity,
                'custom_engraving' => $request->string('custom_engraving') ?: $existingItem->custom_engraving,
            ]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'product_variant_id' => $variant->id,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'total_price' => $unitPrice * $quantity,
                'custom_engraving' => $request->string('custom_engraving'),
            ]);
        }

        $cart->refresh();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "“{$product->name}” was placed in your shopping bag.",
                'cart_count' => $cart->total_items_count,
                'subtotal' => number_format($cart->subtotal, 2),
                'total' => number_format($cart->subtotal - (float) $cart->discount_amount, 2),
            ]);
        }

        return back()->with('toast', [
            'type' => 'success',
            'message' => "“{$product->name}” was placed in your shopping bag.",
        ]);
    }

    public function update(Request $request, CartItem $item): JsonResponse|RedirectResponse
    {
        $request->validate(['quantity' => ['required', 'integer', 'min:1', 'max:10']]);
        $newQty = $request->integer('quantity');

        // Stock Validation
        $inventory = Inventory::where('product_variant_id', $item->product_variant_id)->first();
        if ($inventory && $inventory->available_quantity < $newQty) {
            $msg = "Vault limit reached: Only {$inventory->available_quantity} pieces available.";
            return $request->wantsJson()
                ? response()->json(['success' => false, 'message' => $msg], 422)
                : back()->withErrors($msg);
        }

        $item->update([
            'quantity' => $newQty,
            'total_price' => $item->unit_price * $newQty,
        ]);

        $cart = $item->cart->refresh();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'item_total' => number_format($item->total_price, 2),
                'subtotal' => number_format($cart->subtotal, 2),
                'discount' => number_format((float) $cart->discount_amount, 2),
                'total' => number_format($cart->subtotal - (float) $cart->discount_amount, 2),
                'total_count' => $cart->total_items_count,
            ]);
        }

        return back()->with('toast', ['type' => 'info', 'message' => 'Shopping bag updated.']);
    }

    public function destroy(CartItem $item): JsonResponse|RedirectResponse
    {
        $cart = $item->cart;
        $item->delete();
        $cart->refresh();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Piece removed from your bag.',
                'cart_count' => $cart->total_items_count,
                'subtotal' => number_format($cart->subtotal, 2),
                'total' => number_format($cart->subtotal - (float) $cart->discount_amount, 2),
            ]);
        }

        return back()->with('toast', ['type' => 'info', 'message' => 'Piece removed from your shopping bag.']);
    }

    public function applyCoupon(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate(['code' => ['required', 'string']]);
        $cart = self::getActiveCart($request);

        $result = $this->couponService->applyToCart($cart, $request->string('code'), Auth::user());

        if ($request->wantsJson()) {
            return response()->json($result);
        }

        return back()->with('toast', [
            'type' => $result['success'] ? 'success' : 'error',
            'message' => $result['message'],
        ]);
    }

    public function removeCoupon(Request $request): JsonResponse|RedirectResponse
    {
        $cart = self::getActiveCart($request);
        $cart->update([
            'coupon_code' => null,
            'discount_amount' => 0.00,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Promotion removed.',
                'subtotal' => number_format($cart->subtotal, 2),
                'total' => number_format($cart->subtotal, 2),
            ]);
        }

        return back()->with('toast', ['type' => 'info', 'message' => 'Promotion removed from shopping bag.']);
    }
}
