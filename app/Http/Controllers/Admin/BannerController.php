<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\Banner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BannerController extends Controller
{
    public function index(): View
    {
        $banners = Banner::orderBy('sort_order')->latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'cta_text' => ['nullable', 'string', 'max:100'],
            'cta_link' => ['nullable', 'string', 'max:255'],
            'placement' => ['required', 'in:home_hero,announcement,collection_feature,promo'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
            'image_desktop' => ['nullable', 'image', 'max:6144'],
            'image_mobile' => ['nullable', 'image', 'max:6144'],
            'image_desktop_url' => ['nullable', 'string', 'max:500'],
            'image_mobile_url' => ['nullable', 'string', 'max:500'],
        ]);

        $deskPath = 'assets/images/banner_gold_upgrade.jpg';
        if ($request->hasFile('image_desktop')) {
            $deskPath = $request->file('image_desktop')->store('banners', 'public');
        } elseif ($request->filled('image_desktop_url')) {
            $deskPath = $request->input('image_desktop_url');
        }

        $mobPath = null;
        if ($request->hasFile('image_mobile')) {
            $mobPath = $request->file('image_mobile')->store('banners', 'public');
        } elseif ($request->filled('image_mobile_url')) {
            $mobPath = $request->input('image_mobile_url');
        }

        $banner = Banner::create([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'tagline' => $validated['tagline'] ?? null,
            'cta_text' => $validated['cta_text'] ?? null,
            'cta_link' => $validated['cta_link'] ?? null,
            'placement' => $validated['placement'],
            'image_desktop' => $deskPath,
            'image_mobile' => $mobPath,
            'sort_order' => $request->input('sort_order', 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        AdminActivityLog::record("Created banner '{$banner->title}'", $banner);

        return back()->with('toast', ['type' => 'success', 'message' => "Banner '{$banner->title}' published successfully."]);
    }

    public function update(Request $request, Banner $banner): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'cta_text' => ['nullable', 'string', 'max:100'],
            'cta_link' => ['nullable', 'string', 'max:255'],
            'placement' => ['required', 'in:home_hero,announcement,collection_feature,promo'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
            'image_desktop' => ['nullable', 'image', 'max:6144'],
            'image_mobile' => ['nullable', 'image', 'max:6144'],
            'image_desktop_url' => ['nullable', 'string', 'max:500'],
            'image_mobile_url' => ['nullable', 'string', 'max:500'],
        ]);

        $deskPath = $banner->image_desktop;
        if ($request->hasFile('image_desktop')) {
            $deskPath = $request->file('image_desktop')->store('banners', 'public');
        } elseif ($request->filled('image_desktop_url')) {
            $deskPath = $request->input('image_desktop_url');
        }

        $mobPath = $banner->image_mobile;
        if ($request->hasFile('image_mobile')) {
            $mobPath = $request->file('image_mobile')->store('banners', 'public');
        } elseif ($request->filled('image_mobile_url')) {
            $mobPath = $request->input('image_mobile_url');
        }

        $banner->update([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'tagline' => $validated['tagline'] ?? null,
            'cta_text' => $validated['cta_text'] ?? null,
            'cta_link' => $validated['cta_link'] ?? null,
            'placement' => $validated['placement'],
            'image_desktop' => $deskPath,
            'image_mobile' => $mobPath,
            'sort_order' => $request->input('sort_order', $banner->sort_order),
            'is_active' => $request->boolean('is_active', true),
        ]);

        AdminActivityLog::record("Updated banner '{$banner->title}'", $banner);

        return back()->with('toast', ['type' => 'success', 'message' => "Banner '{$banner->title}' updated successfully."]);
    }

    public function toggleActive(Banner $banner): RedirectResponse
    {
        $banner->update(['is_active' => !$banner->is_active]);
        $status = $banner->is_active ? 'activated' : 'hidden';
        AdminActivityLog::record("Toggled banner '{$banner->title}' to {$status}", $banner);

        return back()->with('toast', ['type' => 'success', 'message' => "Banner '{$banner->title}' is now {$status}."]);
    }

    public function destroy(Banner $banner): RedirectResponse
    {
        $title = $banner->title;
        $banner->delete();

        AdminActivityLog::record("Deleted banner '{$title}'");

        return back()->with('toast', ['type' => 'success', 'message' => "Banner '{$title}' deleted successfully."]);
    }
}
