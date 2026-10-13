<x-layouts.admin title="Edit Page: {{ $page->title }} | Modern Jewellery House">
    <div class="flex items-center justify-between pb-2 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Page: {{ $page->title }}</h1>
        </div>
        <a href="{{ route('admin.pages.index') }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900">&larr; Back</a>
    </div>

    <form action="{{ route('admin.pages.update', $page) }}" method="POST" class="max-w-3xl bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4 text-xs">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-semibold text-slate-700 mb-1">Page Title *</label>
            <input type="text" name="title" required value="{{ old('title', $page->title) }}" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs">
        </div>
        <div>
            <label class="block font-semibold text-slate-700 mb-1">Excerpt</label>
            <textarea name="excerpt" rows="2" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs">{{ old('excerpt', $page->excerpt) }}</textarea>
        </div>
        <div>
            <label class="block font-semibold text-slate-700 mb-1">Body *</label>
            <textarea name="content" rows="10" required class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs font-mono">{{ old('content', $page->content) }}</textarea>
        </div>
        <button type="submit" class="py-2.5 px-5 bg-slate-900 text-white rounded font-bold uppercase tracking-wider text-xs">
            Update Page
        </button>
    </form>
</x-layouts.admin>