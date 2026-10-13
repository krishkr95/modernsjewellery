<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContentController extends Controller
{
    public function homepage(): View
    {
        $collections = Collection::orderBy('name')->get();
        $products = Product::where('status', 'published')->orderBy('name')->get();

        $content = [
            'hero_video' => Setting::get('home_hero_video', 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4'),
            'hero_poster' => Setting::get('home_hero_poster', '/assets/images/hero-poster.jpg'),
            'hero_title' => Setting::get('home_hero_title', 'JEWELLERY FOR EVERY CHAPTER.'),
            'hero_subtitle' => Setting::get('home_hero_subtitle', 'Contemporary pieces crafted to become part of your story.'),
            'hero_cta_text' => Setting::get('home_hero_cta_text', 'EXPLORE COLLECTION'),
            'hero_cta_link' => Setting::get('home_hero_cta_link', '/shop'),
            'editorial_title' => Setting::get('home_editorial_title', 'HAUTE ATELIER CRAFTSMANSHIP'),
            'editorial_text' => Setting::get('home_editorial_text', 'Every creation is hand-selected and meticulously set by master artisans in our private salon.'),
            'bridal_title' => Setting::get('home_bridal_title', 'THE BRIDAL SUITE'),
            'bridal_text' => Setting::get('home_bridal_text', 'Solitaire creations and bespoke eternity bands destined for eternity.'),
            'newsletter_title' => Setting::get('home_newsletter_title', 'BECOME A PRIVILEGED PATRON'),
            'newsletter_text' => Setting::get('home_newsletter_text', 'Receive private previews of rare acquisitions, bespoke commissions, and private salon viewings.'),
        ];

        return view('admin.content.homepage', compact('collections', 'products', 'content'));
    }

    public function updateHomepage(Request $request): RedirectResponse
    {
        $fields = [
            'home_hero_video',
            'home_hero_poster',
            'home_hero_title',
            'home_hero_subtitle',
            'home_hero_cta_text',
            'home_hero_cta_link',
            'home_editorial_title',
            'home_editorial_text',
            'home_bridal_title',
            'home_bridal_text',
            'home_newsletter_title',
            'home_newsletter_text',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::set($field, $request->input($field), 'homepage');
            }
        }

        AdminActivityLog::record("Updated Homepage Editorial Content CMS");

        return back()->with('toast', [
            'type' => 'success',
            'message' => 'Homepage CMS content updated.',
        ]);
    }
}
