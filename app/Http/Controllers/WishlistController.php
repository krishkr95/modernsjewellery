<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WishlistController extends Controller
{
    public function index(): View
    {
        $wishlist = Wishlist::firstOrCreate(
            ['user_id' => Auth::id()],
            ['name' => 'Curated Wishlist']
        )->load(['items.product.primaryImage', 'items.product.images', 'items.product.category', 'items.variant']);

        return view('pages.wishlist.index', compact('wishlist'));
    }

    public function toggle(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate(['product_id' => ['required', 'exists:products,id']]);

        $user = Auth::user();
        if (!$user) {
            if ($request->wantsJson()) {
                return response()->json([
                    'guest' => true,
                    'message' => 'Guest mode - save to local storage',
                ], 200);
            }
            return redirect()->route('login');
        }

        $wishlist = Wishlist::firstOrCreate(['user_id' => $user->id], ['name' => 'Curated Wishlist']);
        $productId = $request->integer('product_id');

        $existing = WishlistItem::where('wishlist_id', $wishlist->id)
            ->where('product_id', $productId)
            ->first();

        if ($existing) {
            $existing->delete();
            $added = false;
            $msg = 'Piece removed from your wishlist.';
        } else {
            WishlistItem::create([
                'wishlist_id' => $wishlist->id,
                'product_id' => $productId,
            ]);
            $added = true;
            $msg = 'Piece saved to your personal wishlist.';
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'added' => $added,
                'message' => $msg,
                'count' => $wishlist->items()->count(),
            ]);
        }

        return back()->with('toast', ['type' => 'info', 'message' => $msg]);
    }

    public function syncGuestWishlist(Request $request): JsonResponse
    {
        $request->validate([
            'product_ids' => ['required', 'array'],
            'product_ids.*' => ['integer', 'exists:products,id'],
        ]);

        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $wishlist = Wishlist::firstOrCreate(['user_id' => Auth::id()], ['name' => 'Curated Wishlist']);
        $ids = $request->input('product_ids', []);

        foreach ($ids as $id) {
            WishlistItem::firstOrCreate([
                'wishlist_id' => $wishlist->id,
                'product_id' => $id,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Guest wishlist successfully merged with your maison account.',
            'count' => $wishlist->items()->count(),
        ]);
    }
}
