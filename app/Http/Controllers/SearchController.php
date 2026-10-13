<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        $query = $request->string('q')->trim();

        if ($query->isEmpty()) {
            if ($request->wantsJson()) {
                return response()->json(['results' => []]);
            }
            return view('pages.search', ['query' => '', 'products' => collect()]);
        }

        $products = Product::published()
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('sku', 'like', "%{$query}%")
                  ->orWhere('short_description', 'like', "%{$query}%")
                  ->orWhere('metal_type', 'like', "%{$query}%")
                  ->orWhere('gemstone_type', 'like', "%{$query}%")
                  ->orWhereHas('category', function ($sub) use ($query) {
                      $sub->where('name', 'like', "%{$query}%");
                  });
            })
            ->with(['primaryImage', 'category', 'defaultVariant'])
            ->take(12)
            ->get();

        if ($request->wantsJson()) {
            $formatted = $products->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'category' => $p->category->name ?? 'Fine Jewellery',
                    'price' => '$' . number_format($p->base_price, 2),
                    'image' => $p->primaryImage ? asset($p->primaryImage->image_path) : null,
                    'url' => route('products.show', $p->slug),
                ];
            });

            return response()->json(['results' => $formatted]);
        }

        return view('pages.search', compact('products', 'query'));
    }
}
