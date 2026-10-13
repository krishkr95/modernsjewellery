<?php

namespace App\Http\Controllers;

use App\Services\SEO\SeoService;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Faq;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $heroBanners = Banner::active()
            ->where('placement', 'home_hero')
            ->orderBy('sort_order')
            ->get();

        $offerBanners = Banner::active()->where('placement', 'promo')->orderBy('sort_order')->get();
        $announcement = Banner::active()->where('placement', 'announcement')->first();

        $featuredCollections = Collection::active()->featured()->orderBy('sort_order')->take(3)->get();

        $featuredProducts = Product::published()
            ->with(['primaryImage', 'images', 'category', 'defaultVariant'])
            ->orderBy('id', 'asc')
            ->take(24)
            ->get();

        $newArrivals = Product::published()
            ->where('is_new_arrival', true)
            ->with(['primaryImage', 'images', 'category', 'defaultVariant'])
            ->take(4)
            ->get();

        $categories = Category::active()->whereNull('parent_id')->orderBy('sort_order')->get();

        $faqs = Faq::active()->take(4)->get();

        // Technical SEO & Structured Data JSON-LD
        $organizationSchema = SeoService::getOrganizationSchema();
        $websiteSchema = SeoService::getWebSiteSchema();
        $faqSchema = $faqs->isNotEmpty() ? SeoService::getFaqSchema($faqs) : null;
        $schemaJsonLd = array_values(array_filter([$organizationSchema, $websiteSchema, $faqSchema]));

        return view('pages.home', compact(
            'schemaJsonLd',
            'offerBanners',
            'heroBanners',
            'announcement',
            'featuredCollections',
            'featuredProducts',
            'newArrivals',
            'categories',
            'faqs'
        ));
    }
}
