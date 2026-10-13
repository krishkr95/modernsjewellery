<?php

namespace App\Http\Controllers;

use App\Services\SEO\SeoService;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use App\Models\RecentlyViewedProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::published()
            ->with(['primaryImage', 'images', 'category', 'collection', 'defaultVariant']);

        // 1. Search Query
        if ($request->filled('search') || $request->filled('q')) {
            $term = (string) ($request->input('search') ?: $request->input('q'));
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                  ->orWhere('tagline', 'like', "%{$term}%")
                  ->orWhere('short_description', 'like', "%{$term}%")
                  ->orWhere('description', 'like', "%{$term}%")
                  ->orWhere('sku', 'like', "%{$term}%")
                  ->orWhere('metal_type', 'like', "%{$term}%")
                  ->orWhere('gemstone_type', 'like', "%{$term}%");
            });
        }

        // 2. Category filtering
        if ($request->filled('category')) {
            $catSlug = $request->string('category');
            $query->whereHas('category', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
        }

        // 3. Collection filtering
        if ($request->filled('collection')) {
            $colSlug = $request->string('collection');
            $query->whereHas('collection', function ($q) use ($colSlug) {
                $q->where('slug', $colSlug);
            });
        }

        // 4. Material / Metal filtering
        if ($request->filled('material')) {
            $material = $request->string('material');
            $query->where('metal_type', 'like', "%{$material}%");
        }

        // 5. Gemstone filtering
        if ($request->filled('gemstone')) {
            $gemstone = $request->string('gemstone');
            $query->where(function ($q) use ($gemstone) {
                $q->where('gemstone_type', 'like', "%{$gemstone}%")
                  ->orWhere('stone', 'like', "%{$gemstone}%");
            });
        }

        // 6. Occasion filtering
        if ($request->filled('occasion')) {
            $occasion = $request->string('occasion');
            $query->where('occasion', $occasion);
        }

        // 7. Price filtering
        if ($request->filled('min_price')) {
            $query->where('base_price', '>=', (float) $request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('base_price', '<=', (float) $request->input('max_price'));
        }

        // 8. Availability filtering
        if ($request->input('availability') === 'in_stock') {
            // Filter products that are in stock
            $query->where(function ($q) {
                $q->whereHas('variants.inventory', function ($inv) {
                    $inv->where('quantity', '>', 0);
                })->orWhereDoesntHave('variants');
            });
        }

        if ($request->boolean('has_3d')) {
            $query->where('3d_model_enabled', true)->whereNotNull('3d_model_url')->where('3d_model_url', '!=', '');
        }

        // 9. Sorting
        $sort = $request->input('sort', 'featured');
        match ($sort) {
            'newest' => $query->latest('published_at')->latest('id'),
            'price_asc' => $query->orderBy('base_price', 'asc'),
            'price_desc' => $query->orderBy('base_price', 'desc'),
            'best_selling', 'bestselling' => $query->orderByDesc('is_bestseller')->orderByDesc('reviews_count'),
            'top_rated' => $query->orderByDesc('rating')->orderByDesc('reviews_count'),
            default => $query->orderByDesc('is_featured')->latest('id'),
        };

        $products = $query->paginate(12)->withQueryString();

        // Facets data
        $categories = Category::active()->whereNull('parent_id')->withCount(['products' => function ($q) {
            $q->published();
        }])->orderBy('sort_order')->get();

        $collections = Collection::active()->withCount(['products' => function ($q) {
            $q->published();
        }])->orderBy('sort_order')->get();

        // Curated distinct filter options
        $materials = [
            '18k Yellow Gold' => '18K Yellow Gold',
            'Platinum' => 'Platinum 950',
            '18k White Gold' => '18K White Gold',
            '18k Rose Gold' => '18K Rose Gold',
        ];

        $gemstones = [
            'Diamond' => 'Natural Diamond',
            'Emerald' => 'Colombian Emerald',
            'Sapphire' => 'Ceylon Sapphire',
            'Pearl' => 'South Sea Pearl',
            'Ruby' => 'Burmese Ruby',
        ];

        $occasions = [
            'Bridal' => 'Bridal & Ceremony',
            'Everyday Luxury' => 'Everyday Luxury',
            'Gala & Evening' => 'Gala & Evening',
            'Anniversary' => 'Anniversary Milestone',
            'Cocktail & Soirée' => 'Cocktail & Soirée',
        ];

        // Active filters count for UI badge
        $activeFiltersCount = collect([
            $request->input('category'),
            $request->input('collection'),
            $request->input('material'),
            $request->input('gemstone'),
            $request->input('occasion'),
            $request->input('min_price'),
            $request->input('max_price'),
            $request->input('availability'),
            $request->input('search'),
        ])->filter()->count();

        $schemaJsonLd = [
            SeoService::getBreadcrumbSchema([
                ['name' => 'Catalogue', 'url' => route('shop')],
            ])
        ];

        return view('pages.products.index', compact(
            'schemaJsonLd',
            'products',
            'categories',
            'collections',
            'materials',
            'gemstones',
            'occasions',
            'sort',
            'activeFiltersCount'
        ));
    }

    public function show(string $slug): View
    {
        $product = Product::published()
            ->where('slug', $slug)
            ->with([
                'category',
                'collection',
                'images',
                'variants.inventory',
                'videos',
                'reviews.user',
                'reviews.images',
            ])
            ->firstOrFail();

        // Record recently viewed for authenticated user
        if (Auth::check()) {
            RecentlyViewedProduct::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                ],
                [
                    'viewed_at' => now(),
                ]
            );
        }

        // Section 1: "You may also like" (same category or collection)
        $relatedProducts = Product::published()
            ->where('id', '!=', $product->id)
            ->where(function ($q) use ($product) {
                $q->where('category_id', $product->category_id)
                  ->orWhere('collection_id', $product->collection_id);
            })
            ->with(['primaryImage', 'images', 'category'])
            ->take(4)
            ->get();

        // Section 2: "Complete the look" (complementary items from different categories or matching collection)
        $completeTheLook = Product::published()
            ->where('id', '!=', $product->id)
            ->where('category_id', '!=', $product->category_id)
            ->where(function ($q) use ($product) {
                if ($product->collection_id) {
                    $q->where('collection_id', $product->collection_id);
                } else {
                    $q->where('metal_type', 'like', '%' . explode(' ', $product->metal_type ?? '')[0] . '%');
                }
            })
            ->with(['primaryImage', 'images', 'category'])
            ->take(4)
            ->get();

        // Section 3: "Recently viewed" for authenticated user
        $recentlyViewedAuth = collect();
        if (Auth::check()) {
            $recentlyViewedAuth = RecentlyViewedProduct::where('user_id', Auth::id())
                ->where('product_id', '!=', $product->id)
                ->latest('viewed_at')
                ->take(6)
                ->with(['product.primaryImage', 'product.images', 'product.category'])
                ->get()
                ->pluck('product')
                ->filter();
        }

        // Generate JSON-LD Schema.org Structured Data
        $primaryImgUrl = $product->primaryImage ? asset($product->primaryImage->image_path) : asset('assets/images/hero-luxury.jpg');
        $allImgUrls = $product->images->map(fn($img) => asset($img->image_path))->toArray();
        if (empty($allImgUrls)) {
            $allImgUrls = [$primaryImgUrl];
        }

        $schemaJsonLd = [
            '@context' => 'https://schema.org/',
            '@type' => 'Product',
            'name' => $product->name,
            'image' => $allImgUrls,
            'description' => $product->short_description ?: $product->tagline ?: 'High jewellery creation by Modern Jewellery House.',
            'sku' => $product->sku,
            'mpn' => $product->sku,
            'brand' => [
                '@type' => 'Brand',
                'name' => 'Modern Jewellery House',
            ],
            'offers' => [
                '@type' => 'Offer',
                'url' => url()->current(),
                'priceCurrency' => 'USD',
                'price' => (string) $product->base_price,
                'itemCondition' => 'https://schema.org/NewCondition',
                'availability' => 'https://schema.org/InStock',
                'priceValidUntil' => now()->addYear()->format('Y-m-d'),
                'hasMerchantReturnPolicy' => [
                    '@type' => 'MerchantReturnPolicy',
                    'applicableCountry' => 'US',
                    'returnPolicyCategory' => 'https://schema.org/MerchantReturnFiniteReturnWindow',
                    'merchantReturnDays' => 30,
                    'returnMethod' => 'https://schema.org/ReturnByMail',
                    'returnFees' => 'https://schema.org/FreeReturn',
                ],
                'shippingDetails' => [
                    '@type' => 'OfferShippingDetails',
                    'shippingRate' => [
                        '@type' => 'MonetaryAmount',
                        'value' => '0.00',
                        'currency' => 'USD',
                    ],
                    'shippingDestination' => [
                        '@type' => 'DefinedRegion',
                        'addressCountry' => 'US',
                    ],
                    'deliveryTime' => [
                        '@type' => 'ShippingDeliveryTime',
                        'handlingTime' => [
                            '@type' => 'QuantitativeValue',
                            'minValue' => 1,
                            'maxValue' => 2,
                            'unitCode' => 'DAY',
                        ],
                        'transitTime' => [
                            '@type' => 'QuantitativeValue',
                            'minValue' => 1,
                            'maxValue' => 3,
                            'unitCode' => 'DAY',
                        ],
                    ],
                ],
            ],
            'aggregateRating' => [
                '@type' => 'AggregateRating',
                'ratingValue' => (string) ($product->rating ?: 4.9),
                'reviewCount' => (int) ($product->reviews_count ?: 12),
                'bestRating' => '5',
                'worstRating' => '1',
            ],
        ];

        return view('pages.products.show', compact(
            'product',
            'relatedProducts',
            'completeTheLook',
            'recentlyViewedAuth',
            'schemaJsonLd'
        ));
    }

    public function recordRecentlyViewed(Request $request): JsonResponse
    {
        $productId = $request->integer('product_id');
        if (!$productId || !Product::where('id', $productId)->exists()) {
            return response()->json(['error' => 'Invalid product'], 400);
        }

        if (Auth::check()) {
            RecentlyViewedProduct::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                ],
                [
                    'viewed_at' => now(),
                ]
            );
        }

        return response()->json(['success' => true]);
    }

    public function fetchRecentlyViewed(Request $request): JsonResponse
    {
        $ids = $request->input('ids', []);
        if (empty($ids) || !is_array($ids)) {
            return response()->json(['products' => []]);
        }

        $products = Product::published()
            ->whereIn('id', $ids)
            ->with(['primaryImage', 'images', 'category'])
            ->take(8)
            ->get()
            ->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'slug' => $p->slug,
                    'url' => route('products.show', $p->slug),
                    'price' => $p->formatted_price,
                    'compare_price' => $p->formatted_compare_price,
                    'category' => $p->category->name ?? 'Fine Jewellery',
                    'metal' => $p->metal_type,
                    'image' => $p->primaryImage ? asset($p->primaryImage->image_path) : asset('assets/images/hero-luxury.jpg'),
                    'badge' => $p->effective_badge,
                ];
            });

        return response()->json(['products' => $products]);
    }
}
