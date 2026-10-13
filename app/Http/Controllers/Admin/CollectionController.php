<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CollectionController extends Controller
{
    public function index(): View
    {
        $collections = Collection::withCount('products')->orderBy('sort_order')->get();
        return view('admin.collections.index', compact('collections'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:collections,name'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
        ]);

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('collections', 'public');
        }

        $col = Collection::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'subtitle' => $validated['subtitle'] ?? null,
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
            'cover_image' => $coverPath,
        ]);

        AdminActivityLog::record("Created collection '{$col->name}'", $col);

        return back()->with('toast', ['type' => 'success', 'message' => 'Collection created.']);
    }

    public function update(Request $request, Collection $collection): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:collections,name,' . $collection->id],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
        ]);

        $coverPath = $collection->cover_image;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('collections', 'public');
        }

        $collection->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'subtitle' => $validated['subtitle'] ?? null,
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
            'cover_image' => $coverPath,
        ]);

        AdminActivityLog::record("Updated collection '{$collection->name}'", $collection);

        return back()->with('toast', ['type' => 'success', 'message' => 'Collection updated.']);
    }

    public function destroy(Collection $collection): RedirectResponse
    {
        $name = $collection->name;
        $collection->delete();

        AdminActivityLog::record("Deleted collection '{$name}'");

        return back()->with('toast', ['type' => 'success', 'message' => 'Collection removed.']);
    }
}
