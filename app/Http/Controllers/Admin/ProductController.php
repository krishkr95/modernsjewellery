<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Inventory;
use App\Models\InventoryMovement;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with(['category', 'collection', 'primaryImage', 'variants.inventory'])
            ->latest();

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->integer('category'));
        }

        if ($request->filled('collection')) {
            $query->where('collection_id', $request->integer('collection'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        $products = $query->paginate(15)->withQueryString();
        $categories = Category::orderBy('name')->get();
        $collections = Collection::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories', 'collections'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        $collections = Collection::orderBy('name')->get();
        return view('admin.products.create', compact('categories', 'collections'));
    }

    public function show(Product $product): RedirectResponse
    {
        return redirect()->route('admin.products.edit', $product);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:100', 'unique:products,sku'],
            'category_id' => ['required', 'exists:categories,id'],
            'collection_id' => ['nullable', 'exists:collections,id'],
            'base_price' => ['required', 'numeric', 'min:0'],
            'compare_at_price' => ['nullable', 'numeric', 'min:0'],
            'cost_price' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'metal_type' => ['nullable', 'string', 'max:100'],
            'purity' => ['nullable', 'string', 'max:100'],
            'weight' => ['nullable', 'string', 'max:100'],
            'stone' => ['nullable', 'string', 'max:255'],
            'gemstone_type' => ['nullable', 'string', 'max:100'],
            'certification' => ['nullable', 'string', 'max:100'],
            'certificate_number' => ['nullable', 'string', 'max:100'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            '3d_model_enabled' => ['nullable', 'boolean'],
            '3d_model_url' => ['nullable', 'string', 'max:2000'],
            '3d_model_file' => ['nullable', 'file', 'max:102400'],
            '3d_model_provider' => ['nullable', 'string', 'max:100'],
            'viewer_type' => ['nullable', 'string', 'max:100'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'badge' => ['nullable', 'string', 'max:50'],
            'status' => ['required', 'in:draft,published,archived'],
            'enable_sizes' => ['nullable'],
            'available_sizes' => ['nullable'],
        ]);

        DB::transaction(function () use ($request, $validated) {
            $slug = Str::slug($validated['name']);
            $count = Product::where('slug', 'like', "{$slug}%")->count();
            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }

            // Process Available Sizes (Rings sizing)
            $availableSizes = null;
            if ($request->boolean('enable_sizes')) {
                $rawSizes = $request->input('available_sizes');
                if (is_string($rawSizes)) {
                    $rawSizes = explode(',', $rawSizes);
                }
                if (is_array($rawSizes)) {
                    $availableSizes = array_values(array_unique(array_filter(array_map('trim', $rawSizes))));
                }
                if (empty($availableSizes)) {
                    $availableSizes = ['10', '12', '14', '16', '18', '20'];
                }
            }

            // Parse and clean 3D Model URL and embed code
            $modelUrl = $request->input('3d_model_url');
            if ($modelUrl) {
                if (preg_match('/src=[\"\']([^\"\']+)[\"\']/i', $modelUrl, $matches)) {
                    $modelUrl = $matches[1];
                }
                $modelUrl = trim($modelUrl);
                if (str_contains(strtolower($modelUrl), 'rendermyjewelry')) {
                    $queryJoin = str_contains($modelUrl, '?') ? '&' : '?';
                    if (!str_contains($modelUrl, 'loader=')) {
                        $modelUrl .= $queryJoin . 'loader=0&loading=0&progressbar=0&hide_loader=1&brand=0';
                    }
                }
            }

            // Handle Direct 3D Model File Upload (.glb, .gltf, etc.)
            if ($request->hasFile('3d_model_file')) {
                $file = $request->file('3d_model_file');
                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('models_3d', $filename, 'public');
                $modelUrl = asset('storage/' . $path);
            }

            $modelSettings = [
                'autorotate' => $request->boolean('3d_autorotate', true),
                'speed' => $request->input('3d_speed', 'slow'),
                'show_colors' => $request->boolean('3d_show_colors', true),
                'default_color' => $request->input('3d_default_color', 'yellow'),
                'bg_color' => $request->input('3d_bg_color', '#0d0d0f'),
                'smoothness' => $request->input('3d_smoothness', 'ultra'),
            ];

            $provider = 'rendermyjewelry';
            if ($modelUrl && (str_ends_with(strtolower(parse_url($modelUrl, PHP_URL_PATH) ?? ''), '.glb') || str_ends_with(strtolower(parse_url($modelUrl, PHP_URL_PATH) ?? ''), '.gltf'))) {
                $provider = 'model-viewer';
            }

            $isEnabled = $request->has('3d_model_enabled') 
                ? $request->boolean('3d_model_enabled') 
                : !empty($modelUrl);

            // Strip 3d_model_file and size controls from validated array before passing to Product::create
            $productData = collect($validated)->except(['3d_model_file', 'enable_sizes', 'available_sizes'])->toArray();

            $product = Product::create([
                ...$productData,
                'slug' => $slug,
                'available_sizes' => $availableSizes,
                '3d_model_url' => $modelUrl,
                '3d_model_provider' => $provider,
                '3d_model_settings' => $modelSettings,
                '3d_model_enabled' => $isEnabled,
                'is_active' => $validated['status'] === 'published',
                'published_at' => $validated['status'] === 'published' ? now() : null,
            ]);

            // Create Default Variant
            $variant = ProductVariant::create([
                'product_id' => $product->id,
                'sku' => $product->sku . '-STD',
                'title' => 'Standard Piece',
                'price' => $product->base_price,
                'cost_price' => $product->cost_price,
                'is_default' => true,
                'is_active' => true,
            ]);

            // Create Inventory Record
            $stock = (int) $request->input('stock', 0);
            $inventory = Inventory::create([
                'product_variant_id' => $variant->id,
                'quantity' => $stock,
                'reserved_quantity' => 0,
                'low_stock_threshold' => 3,
                'allow_backorder' => false,
            ]);

            // Log Initial Inventory Movement
            if ($stock > 0) {
                InventoryMovement::create([
                    'inventory_id' => $inventory->id,
                    'user_id' => auth()->id(),
                    'type' => 'adjustment',
                    'quantity_change' => $stock,
                    'previous_quantity' => 0,
                    'new_quantity' => $stock,
                    'reason' => 'Initial product catalog creation',
                ]);
            }

            // Handle Image Uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $idx => $imgFile) {
                    $path = $imgFile->store('products', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                        'sort_order' => $idx,
                        'is_primary' => $idx === 0,
                    ]);
                }
            }

            AdminActivityLog::record("Created product '{$product->name}' [SKU: {$product->sku}]", $product);
        });

        return redirect()->route('admin.products.index')->with('toast', [
            'type' => 'success',
            'message' => 'Product piece added successfully.',
        ]);
    }

    public function edit(Product $product): View
    {
        $product->load(['category', 'collection', 'images', 'variants.inventory']);
        $categories = Category::orderBy('name')->get();
        $collections = Collection::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories', 'collections'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:100', 'unique:products,sku,' . $product->id],
            'category_id' => ['required', 'exists:categories,id'],
            'collection_id' => ['nullable', 'exists:collections,id'],
            'base_price' => ['required', 'numeric', 'min:0'],
            'compare_at_price' => ['nullable', 'numeric', 'min:0'],
            'cost_price' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['nullable', 'integer', 'min:0'],
            'metal_type' => ['nullable', 'string', 'max:100'],
            'purity' => ['nullable', 'string', 'max:100'],
            'weight' => ['nullable', 'string', 'max:100'],
            'stone' => ['nullable', 'string', 'max:255'],
            'gemstone_type' => ['nullable', 'string', 'max:100'],
            'certification' => ['nullable', 'string', 'max:100'],
            'certificate_number' => ['nullable', 'string', 'max:100'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            '3d_model_enabled' => ['nullable', 'boolean'],
            '3d_model_url' => ['nullable', 'string', 'max:2000'],
            '3d_model_file' => ['nullable', 'file', 'max:102400'],
            '3d_model_provider' => ['nullable', 'string', 'max:100'],
            'viewer_type' => ['nullable', 'string', 'max:100'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'badge' => ['nullable', 'string', 'max:50'],
            'status' => ['required', 'in:draft,published,archived'],
            'enable_sizes' => ['nullable'],
            'available_sizes' => ['nullable'],
        ]);

        DB::transaction(function () use ($request, $product, $validated) {
            // Process Available Sizes (Rings sizing)
            $availableSizes = null;
            if ($request->boolean('enable_sizes')) {
                $rawSizes = $request->input('available_sizes');
                if (is_string($rawSizes)) {
                    $rawSizes = explode(',', $rawSizes);
                }
                if (is_array($rawSizes)) {
                    $availableSizes = array_values(array_unique(array_filter(array_map('trim', $rawSizes))));
                }
                if (empty($availableSizes)) {
                    $availableSizes = ['10', '12', '14', '16', '18', '20'];
                }
            }

            // Parse and clean 3D Model URL and embed code
            $modelUrl = $request->input('3d_model_url');
            if ($modelUrl) {
                if (preg_match('/src=[\"\']([^\"\']+)[\"\']/i', $modelUrl, $matches)) {
                    $modelUrl = $matches[1];
                }
                $modelUrl = trim($modelUrl);
                if (str_contains(strtolower($modelUrl), 'rendermyjewelry')) {
                    $queryJoin = str_contains($modelUrl, '?') ? '&' : '?';
                    if (!str_contains($modelUrl, 'loader=')) {
                        $modelUrl .= $queryJoin . 'loader=0&loading=0&progressbar=0&hide_loader=1&brand=0';
                    }
                }
            }

            // Handle Direct 3D Model File Upload (.glb, .gltf, etc.)
            if ($request->hasFile('3d_model_file')) {
                $file = $request->file('3d_model_file');
                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('models_3d', $filename, 'public');
                $modelUrl = asset('storage/' . $path);
            }

            $modelSettings = [
                'autorotate' => $request->boolean('3d_autorotate', true),
                'speed' => $request->input('3d_speed', 'slow'),
                'show_colors' => $request->boolean('3d_show_colors', true),
                'default_color' => $request->input('3d_default_color', 'yellow'),
                'bg_color' => $request->input('3d_bg_color', '#0d0d0f'),
                'smoothness' => $request->input('3d_smoothness', 'ultra'),
            ];

            $provider = 'rendermyjewelry';
            if ($modelUrl && (str_ends_with(strtolower(parse_url($modelUrl, PHP_URL_PATH) ?? ''), '.glb') || str_ends_with(strtolower(parse_url($modelUrl, PHP_URL_PATH) ?? ''), '.gltf'))) {
                $provider = 'model-viewer';
            }

            $isEnabled = $request->has('3d_model_enabled') 
                ? $request->boolean('3d_model_enabled') 
                : !empty($modelUrl);

            // Strip 3d_model_file and size controls from validated array before passing to Product::update
            $productData = collect($validated)->except(['3d_model_file', 'enable_sizes', 'available_sizes'])->toArray();

            $product->update([
                ...$productData,
                'available_sizes' => $availableSizes,
                '3d_model_url' => $modelUrl,
                '3d_model_provider' => $provider,
                '3d_model_settings' => $modelSettings,
                '3d_model_enabled' => $isEnabled,
                'is_active' => $validated['status'] === 'published',
                'published_at' => $validated['status'] === 'published' ? ($product->published_at ?? now()) : null,
            ]);

            // Stock adjustment if provided
            if ($request->has('stock')) {
                $variant = $product->defaultVariant ?? $product->variants()->first();
                if ($variant) {
                    $inventory = Inventory::firstOrCreate(
                        ['product_variant_id' => $variant->id],
                        ['quantity' => 0, 'reserved_quantity' => 0, 'low_stock_threshold' => 3]
                    );

                    $newStock = (int) $request->input('stock');
                    if ($inventory->quantity !== $newStock) {
                        $diff = $newStock - $inventory->quantity;
                        $prev = $inventory->quantity;
                        $inventory->update(['quantity' => $newStock]);

                        InventoryMovement::create([
                            'inventory_id' => $inventory->id,
                            'user_id' => auth()->id(),
                            'type' => 'adjustment',
                            'quantity_change' => $diff,
                            'previous_quantity' => $prev,
                            'new_quantity' => $newStock,
                            'reason' => 'Stock updated via Product Editor',
                        ]);
                    }
                }
            }

            // Handle Additional Images
            if ($request->hasFile('images')) {
                $currentCount = $product->images()->count();
                foreach ($request->file('images') as $idx => $imgFile) {
                    $path = $imgFile->store('products', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                        'sort_order' => $currentCount + $idx,
                        'is_primary' => $currentCount === 0 && $idx === 0,
                    ]);
                }
            }

            AdminActivityLog::record("Updated product '{$product->name}' [ID: {$product->id}]", $product);
        });

        return redirect()->route('admin.products.index')->with('toast', [
            'type' => 'success',
            'message' => 'Product updated successfully.',
        ]);
    }

    public function duplicate(Product $product): RedirectResponse
    {
        DB::transaction(function () use ($product) {
            $product->load(['variants.inventory', 'images']);
            $newProduct = $product->replicate();
            $newProduct->name = $product->name . ' (Copy)';
            $newProduct->sku = $product->sku . '-CPY-' . strtoupper(Str::random(4));
            $newProduct->slug = Str::slug($newProduct->name) . '-' . strtolower(Str::random(4));
            $newProduct->status = 'draft';
            $newProduct->is_active = false;
            $newProduct->save();

            // Duplicate images
            foreach ($product->images as $img) {
                $newImg = $img->replicate();
                $newImg->product_id = $newProduct->id;
                $newImg->save();
            }

            // Duplicate variants
            foreach ($product->variants as $index => $variant) {
                $newVariant = $variant->replicate();
                $newVariant->product_id = $newProduct->id;
                $newVariant->sku = $newProduct->sku . '-V' . ($index + 1) . '-' . strtoupper(Str::random(3));
                $newVariant->save();

                if ($variant->inventory) {
                    Inventory::create([
                        'product_variant_id' => $newVariant->id,
                        'quantity' => $variant->inventory->quantity,
                        'reserved_quantity' => 0,
                        'low_stock_threshold' => 3,
                    ]);
                }
            }

            AdminActivityLog::record("Duplicated product from '{$product->name}' to '{$newProduct->name}'", $newProduct);
        });

        return back()->with('toast', [
            'type' => 'success',
            'message' => 'Product duplicated successfully as draft.',
        ]);
    }

    public function togglePublish(Product $product): RedirectResponse
    {
        $newStatus = $product->status === 'published' ? 'draft' : 'published';
        $product->update([
            'status' => $newStatus,
            'is_active' => $newStatus === 'published',
            'published_at' => $newStatus === 'published' ? ($product->published_at ?? now()) : null,
        ]);

        AdminActivityLog::record("Changed status of '{$product->name}' to {$newStatus}", $product);

        return back()->with('toast', [
            'type' => 'success',
            'message' => "Product status updated to {$newStatus}.",
        ]);
    }

    public function archive(Product $product): RedirectResponse
    {
        $product->update([
            'status' => 'archived',
            'is_active' => false,
        ]);

        AdminActivityLog::record("Archived product '{$product->name}'", $product);

        return back()->with('toast', [
            'type' => 'success',
            'message' => 'Product archived.',
        ]);
    }

    public function destroy(Product $product): RedirectResponse
    {
        $name = $product->name;

        DB::transaction(function () use ($product) {
            // Delete all physical uploaded images from storage
            foreach ($product->images as $img) {
                if ($img->image_path && Storage::disk('public')->exists($img->image_path)) {
                    Storage::disk('public')->delete($img->image_path);
                }
                $img->delete();
            }

            // Delete associated variants and inventories
            foreach ($product->variants as $variant) {
                $variant->inventory?->delete();
                $variant->delete();
            }

            // Permanently delete product so SKU can be reused cleanly
            $product->forceDelete();
        });

        AdminActivityLog::record("Deleted product '{$name}'");

        return redirect()->route('admin.products.index')->with('toast', [
            'type' => 'success',
            'message' => 'Product removed successfully.',
        ]);
    }


    public function setPrimaryImage(Product $product, ProductImage $image): RedirectResponse
    {
        $product->images()->update(['is_primary' => false]);
        $image->update(['is_primary' => true]);

        return back()->with('toast', ['type' => 'success', 'message' => 'Primary image set.']);
    }

    public function deleteImage(Product $product, ProductImage $image): RedirectResponse
    {
        if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
        $wasPrimary = $image->is_primary;
        $image->delete();

        // If the primary image was removed, automatically promote the next image to primary
        if ($wasPrimary) {
            $next = $product->images()->first();
            if ($next) {
                $next->update(['is_primary' => true]);
            }
        }

        return back()->with('toast', ['type' => 'success', 'message' => 'Image removed.']);
    }

}
