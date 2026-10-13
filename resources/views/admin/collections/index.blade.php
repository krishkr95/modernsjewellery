<x-layouts.admin title="Collections Manager | Modern Jewellery House">
<div class="space-y-6">
    <div class="content-card p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight font-sans">Curated High Joaillerie Series & Campaigns</h1>
            <p class="text-xs text-slate-400 mt-1">Manage seasonal campaigns, bespoke bridal suites, and high fine jewellery series.</p>
        </div>
        <span class="px-3.5 py-1.5 bg-amber-500/10 border border-amber-500/20 text-amber-700 dark:text-amber-400 rounded-full text-xs font-bold uppercase tracking-wider">
            Total Series: {{ $collections->count() }}
        </span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <!-- Create Form -->
        <div class="content-card p-6 space-y-4">
            <h3 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider border-b border-slate-100 dark:border-slate-800 pb-2">Launch Curated Series</h3>
            <form action="{{ route('admin.collections.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3.5 text-xs">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Collection Title *</label>
                    <input type="text" name="name" required placeholder="e.g. Royal Heritage Solitaires" class="sub-input w-full px-3 py-2 text-xs">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Editorial Subtitle</label>
                    <input type="text" name="subtitle" placeholder="e.g. Handcrafted for timeless vows" class="sub-input w-full px-3 py-2 text-xs">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Maison Note</label>
                    <textarea name="description" rows="2" class="sub-input w-full px-3 py-2 text-xs"></textarea>
                </div>
                <label class="flex items-center space-x-2.5 cursor-pointer pt-1">
                    <input type="checkbox" name="is_featured" value="1" class="rounded border-slate-300 text-amber-600 focus:ring-amber-500">
                    <span class="font-semibold text-slate-700 dark:text-slate-300">Feature on Homepage Hero</span>
                </label>
                <div>
                    <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Editorial Cover Artwork</label>
                    <input type="file" name="cover_image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-500/10 file:text-amber-700 hover:file:bg-amber-500/20">
                </div>
                <button type="submit" class="btn-gold w-full py-2.5 text-xs font-bold uppercase tracking-wider">
                    Publish Series
                </button>
            </form>
        </div>

        <!-- Collections Table -->
        <div class="lg:col-span-2 content-card p-6">
            <div class="pb-3 border-b border-slate-100 dark:border-slate-800 mb-2">
                <h3 class="text-sm font-bold text-slate-900 dark:text-white">Active Series</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Series</th>
                            <th>Status</th>
                            <th style="text-align:center;">Featured</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($collections as $col)
                            <tr>
                                <td>
                                    <div style="font-weight:700;color:#1E293B;" class="dark:text-white">{{ $col->name }}</div>
                                    <div style="font-size:0.75rem;color:#64748B;">{{ $col->subtitle }}</div>
                                </td>
                                <td>
                                    <span class="order-pill pill-delivered">Published</span>
                                </td>
                                <td style="text-align:center;">
                                    @if($col->is_featured)
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-700 border border-amber-500/20">Featured</span>
                                    @else
                                        <span style="color:#94A3B8;">Standard</span>
                                    @endif
                                </td>
                                <td style="text-align:right;">
                                    <form action="{{ route('admin.collections.destroy', $col) }}" method="POST" class="inline" onsubmit="return confirm('Archive collection?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="sub-btn px-3 py-1 text-[11px] font-bold text-rose-600 hover:text-rose-700">Archive</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center;padding:30px;color:#94A3B8;">No curated collections yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</x-layouts.admin>