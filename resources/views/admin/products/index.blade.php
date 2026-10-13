<x-layouts.admin title="Products Catalogue | Modern Jewellery House">
<div style="display:flex;flex-direction:column;gap:20px;">

    <!-- ================= HEADER & ACTIONS ================= -->
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
        <div>
            <h1 style="font-size:1.4rem;font-weight:800;letter-spacing:-0.02em;" class="card-title text-slate-900 dark:text-white">Products Catalogue</h1>
            <p style="font-size:0.75rem;margin:0;" class="text-slate-500 dark:text-slate-400">Manage fine jewellery pieces, precious gem specifications, pricing in ₹, and vault assets.</p>
        </div>
        <div style="display:flex;align-items:center;gap:10px;">
            <a href="{{ route('admin.products.create') }}" class="btn-gold px-4 py-2 text-xs font-bold flex items-center gap-2 shadow-md">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v16m8-8H4"/></svg>
                <span>Add New Creation</span>
            </a>
        </div>
    </div>

    <!-- ================= FILTERS BAR ================= -->
    <div class="content-card" style="padding:16px 20px;">
        <form action="{{ route('admin.products.index') }}" method="GET" style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)) 140px;gap:12px;align-items:center;">
            <!-- Search -->
            <div style="position:relative;">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search piece name, SKU, gem..."
                       style="width:100%;border-radius:12px;padding:9px 12px 9px 36px;font-size:0.78rem;outline:none;" class="sub-input">
                <svg width="15" height="15" fill="none" stroke="#94A3B8" viewBox="0 0 24 24" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>

            <!-- Category -->
            <div>
                <select name="category" style="width:100%;border-radius:12px;padding:9px 12px;font-size:0.78rem;outline:none;" class="sub-input font-medium">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div>
                <select name="status" style="width:100%;border-radius:12px;padding:9px 12px;font-size:0.78rem;outline:none;" class="sub-input font-medium">
                    <option value="">All Statuses</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published (Active)</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>

            <!-- Filter & Reset Buttons -->
            <div style="display:flex;align-items:center;gap:6px;">
                <button type="submit" class="btn-gold" style="flex:1;padding:9px 14px;font-size:0.75rem;font-weight:700;border-radius:10px;">
                    Filter
                </button>
                @if(request()->anyFilled(['search', 'category', 'status']))
                    <a href="{{ route('admin.products.index') }}" class="sub-btn" style="padding:9px 12px;font-size:0.75rem;font-weight:600;text-decoration:none;border-radius:10px;">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- ================= PRODUCTS TABLE CARD ================= -->
    <div class="content-card" style="padding: 12px 16px;">
        <div style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width:54px;">Thumbnail</th>
                        <th>Fine Jewellery Piece</th>
                        <th>Classification</th>
                        <th>Base Price (₹)</th>
                        <th>Vault Stock</th>
                        <th>Status</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <!-- Image -->
                            <td>
                                <div style="width:44px;height:44px;border-radius:12px;overflow:hidden;display:flex;align-items:center;justify-content:center;box-shadow: 2px 2px 6px rgba(0,0,0,0.1);"
                                     class="bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-white/10">
                                    <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}" 
                                         onerror="this.onerror=null;this.src='{{ asset('assets/images/aurelia-solitaire-diamond-ring-1.jpg') }}'"
                                         style="width:100%;height:100%;object-fit:cover;">
                                </div>
                            </td>

                            <!-- Name & SKU -->
                            <td>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.products.edit', $product) }}" style="font-weight:700;font-size:0.84rem;text-decoration:none;" class="text-slate-900 dark:text-white hover:text-amber-600 transition-colors">
                                            {{ $product->name }}
                                        </a>
                                        @if($product->badge)
                                            <span style="font-size:0.62rem;padding:1px 6px;border-radius:999px;font-weight:800;background:rgba(217,119,6,0.15);color:#D97706;letter-spacing:0.04em;">
                                                {{ $product->badge }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-2 text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">
                                        <span class="font-mono text-slate-600 dark:text-slate-300">SKU: {{ $product->sku ?: '—' }}</span>
                                        @if($product->metal_type)
                                            <span>&bull;</span>
                                            <span>{{ $product->metal_type }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Category -->
                            <td>
                                <span style="font-size:0.75rem;font-weight:600;" class="text-slate-700 dark:text-slate-300">
                                    {{ $product->category->name ?? 'Uncategorized' }}
                                </span>
                                @if($product->collection)
                                    <p class="text-[10px] text-amber-700 dark:text-amber-400 font-serif italic mt-0.5">{{ $product->collection->name }}</p>
                                @endif
                            </td>

                            <!-- Price in Rupee -->
                            <td>
                                <div class="flex flex-col">
                                    <span style="font-weight:700;font-size:0.86rem;" class="text-slate-900 dark:text-amber-400 tnum">
                                        ₹ {{ number_format($product->base_price, 2) }}
                                    </span>
                                    @if($product->compare_at_price && $product->compare_at_price > $product->base_price)
                                        <span class="text-[10px] text-slate-400 line-through tnum">
                                            ₹ {{ number_format($product->compare_at_price, 2) }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <!-- Stock -->
                            <td>
                                @php
                                    $totalStock = $product->variants->sum(fn($v) => $v->inventory?->quantity_on_hand ?? 0);
                                @endphp
                                @if($totalStock > 5)
                                    <span style="background:rgba(16, 185, 129, 0.15);color:#059669;padding:3px 9px;border-radius:999px;font-size:0.7rem;font-weight:700;" class="dark:text-emerald-400">
                                        {{ $totalStock }} In Vault
                                    </span>
                                @elseif($totalStock > 0)
                                    <span style="background:rgba(245, 158, 11, 0.15);color:#D97706;padding:3px 9px;border-radius:999px;font-size:0.7rem;font-weight:700;" class="dark:text-amber-400">
                                        {{ $totalStock }} Low Stock
                                    </span>
                                @else
                                    <span style="background:rgba(239, 68, 68, 0.15);color:#E11D48;padding:3px 9px;border-radius:999px;font-size:0.7rem;font-weight:700;" class="dark:text-rose-400">
                                        Depleted
                                    </span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td>
                                @if($product->status === 'published')
                                    <span class="pill-delivered">Published</span>
                                @elseif($product->status === 'draft')
                                    <span class="pill-processing">Draft</span>
                                @else
                                    <span style="background:#F1F5F9;color:#64748B;padding:3px 10px;border-radius:999px;font-size:0.7rem;font-weight:600;" class="dark:bg-slate-800 dark:text-slate-400">Archived</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td style="text-align:right;">
                                <div style="display:inline-flex;align-items:center;gap:6px;">
                                    <!-- Storefront preview link -->
                                    <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="sub-btn p-1.5 text-slate-500 hover:text-slate-900 dark:hover:text-white" title="View in Storefront">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('admin.products.edit', $product) }}" class="sub-btn p-1.5 text-slate-600 hover:text-amber-600 dark:text-slate-300" title="Edit Piece Specifications">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>

                                    <!-- Duplicate Piece -->
                                    <form action="{{ route('admin.products.duplicate', $product) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="sub-btn p-1.5 text-slate-500 hover:text-amber-600 dark:text-slate-400" title="Duplicate Piece as Draft">
                                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                        </button>
                                    </form>

                                    <!-- Delete Product -->
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to permanently delete \'{{ addslashes($product->name) }}\'? This cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="sub-btn p-1.5 text-rose-500 hover:text-rose-700" title="Delete Piece">
                                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center;padding:48px 16px;">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <svg width="36" height="36" fill="none" stroke="#94A3B8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    <p class="text-sm font-bold text-slate-800 dark:text-slate-200">No Fine Jewellery Pieces Found</p>
                                    <p class="text-xs text-slate-400">Try adjusting your filters or click "Add New Creation" above.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(method_exists($products, 'links') && $products->hasPages())
            <div style="margin-top:16px;padding-top:14px;border-top:1px solid rgba(226,232,240,0.6);" class="dark:border-white/5 flex items-center justify-between text-xs">
                {{ $products->links() }}
            </div>
        @endif
    </div>

</div>
</x-layouts.admin>
