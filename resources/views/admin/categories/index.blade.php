<x-layouts.admin title="Categories Manager | Modern Jewellery House">
<div class="space-y-6">
    <div class="content-card p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight font-sans">Haute Joaillerie Departments & Taxonomies</h1>
            <p class="text-xs text-slate-400 mt-1">Organize luxury categories, catalog collections, and boutique display orders.</p>
        </div>
        <span class="px-3.5 py-1.5 bg-amber-500/10 border border-amber-500/20 text-amber-700 dark:text-amber-400 rounded-full text-xs font-bold uppercase tracking-wider">
            Active Catalog: {{ $categories->count() }} Departments
        </span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <!-- Add Category Form (1 Col) -->
        <div class="content-card p-6 space-y-4">
            <h3 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider border-b border-slate-100 dark:border-slate-800 pb-2">Create New Department</h3>
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3.5 text-xs">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Department Name *</label>
                    <input type="text" name="name" required placeholder="e.g. Royal Solitaire Rings" class="sub-input w-full px-3 py-2 text-xs">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Editorial Description</label>
                    <textarea name="description" rows="2" placeholder="Curated atelier blurb..." class="sub-input w-full px-3 py-2 text-xs"></textarea>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Catalog Display Order</label>
                    <input type="number" name="sort_order" value="0" class="sub-input w-full px-3 py-2 text-xs font-mono">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Department Showcase Imagery</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-500/10 file:text-amber-700 hover:file:bg-amber-500/20">
                </div>
                <button type="submit" class="btn-gold w-full py-2.5 text-xs font-bold uppercase tracking-wider">
                    Register Department
                </button>
            </form>
        </div>

        <!-- Categories Table (2 Cols) -->
        <div class="lg:col-span-2 content-card p-6">
            <div class="pb-3 border-b border-slate-100 dark:border-slate-800 mb-2">
                <h3 class="text-sm font-bold text-slate-900 dark:text-white">Active Departments</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Department Name</th>
                            <th>Slug</th>
                            <th style="text-align:center;">Pieces Count</th>
                            <th style="text-align:center;">Sort</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $cat)
                            <tr>
                                <td style="font-weight:700;color:#1E293B;" class="dark:text-white">{{ $cat->name }}</td>
                                <td style="font-family:monospace;color:#64748B;">{{ $cat->slug }}</td>
                                <td style="text-align:center;font-family:monospace;font-weight:700;">{{ $cat->products_count }}</td>
                                <td style="text-align:center;font-family:monospace;color:#94A3B8;">{{ $cat->sort_order }}</td>
                                <td style="text-align:right;">
                                    <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="inline" onsubmit="return confirm('Remove category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="sub-btn px-3 py-1 text-[11px] font-bold text-rose-600 hover:text-rose-700">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align:center;padding:30px;color:#94A3B8;">No categories registered.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</x-layouts.admin>