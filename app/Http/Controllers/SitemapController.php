<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    /**
     * Generate dynamic, highly optimized XML sitemap with Google Image extensions.
     */
    public function index(): Response
    {
        $xml = Cache::remember('mjh_sitemap_xml', 43200, function () {
            return $this->buildSitemapXml();
        });

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'X-Robots-Tag' => 'noindex, follow',
            'Cache-Control' => 'public, max-age=43200',
        ]);
    }

    private function buildSitemapXml(): string
    {
        $baseUrl = rtrim(url('/'), '/');
        $now = now()->toAtomString();

        $urls = [];

        // 1. Primary Landing & Catalog Pages
        $urls[] = [
            'loc' => "{$baseUrl}/",
            'lastmod' => $now,
            'changefreq' => 'daily',
            'priority' => '1.0',
            'image' => [
                'loc' => asset('assets/images/hero-luxury.jpg'),
                'title' => 'Modern Jewellery House Haute Joaillerie Atelier',
            ],
        ];

        $urls[] = [
            'loc' => "{$baseUrl}/shop",
            'lastmod' => $now,
            'changefreq' => 'daily',
            'priority' => '0.9',
            'image' => [
                'loc' => asset('assets/images/brand-story.jpg'),
                'title' => 'Fine Jewellery Catalog & Collections',
            ],
        ];

        // 2. Active Department Categories
        $categories = Category::active()->whereNull('parent_id')->get();
        foreach ($categories as $category) {
            $urls[] = [
                'loc' => "{$baseUrl}/shop?category={$category->slug}",
                'lastmod' => ($category->updated_at ?? now())->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
                'image' => !empty($category->image_path) ? [
                    'loc' => asset($category->image_path),
                    'title' => $category->name,
                ] : null,
            ];
        }

        // 3. Active Curated Collections
        $collections = Collection::active()->get();
        foreach ($collections as $collection) {
            $urls[] = [
                'loc' => "{$baseUrl}/shop?collection={$collection->slug}",
                'lastmod' => ($collection->updated_at ?? now())->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
                'image' => !empty($collection->image_path) ? [
                    'loc' => asset($collection->image_path),
                    'title' => $collection->name,
                ] : null,
            ];
        }

        // 4. All Published Products
        $products = Product::published()
            ->with(['primaryImage', 'images'])
            ->latest('updated_at')
            ->get();

        foreach ($products as $product) {
            $primaryImg = $product->primaryImage?->image_path;
            $urls[] = [
                'loc' => route('products.show', $product->slug),
                'lastmod' => ($product->updated_at ?? now())->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.9',
                'image' => !empty($primaryImg) ? [
                    'loc' => asset($primaryImg),
                    'title' => $product->name,
                ] : null,
            ];
        }

        // Build XML String
        $output = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
        $output .= '        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

        foreach ($urls as $u) {
            $output .= "  <url>\n";
            $output .= "    <loc>" . htmlspecialchars($u['loc'], ENT_XML1, 'UTF-8') . "</loc>\n";
            $output .= "    <lastmod>{$u['lastmod']}</lastmod>\n";
            $output .= "    <changefreq>{$u['changefreq']}</changefreq>\n";
            $output .= "    <priority>{$u['priority']}</priority>\n";

            if (!empty($u['image']) && !empty($u['image']['loc'])) {
                $output .= "    <image:image>\n";
                $output .= "      <image:loc>" . htmlspecialchars($u['image']['loc'], ENT_XML1, 'UTF-8') . "</image:loc>\n";
                if (!empty($u['image']['title'])) {
                    $output .= "      <image:title>" . htmlspecialchars($u['image']['title'], ENT_XML1, 'UTF-8') . "</image:title>\n";
                }
                $output .= "    </image:image>\n";
            }

            $output .= "  </url>\n";
        }

        $output .= '</urlset>';

        return $output;
    }
}
