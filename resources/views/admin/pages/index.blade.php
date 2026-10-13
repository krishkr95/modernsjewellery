<x-layouts.admin title="Pages CMS | Modern Jewellery House">
    <div class="flex items-center justify-between pb-2 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Editorial & Static Pages</h1>
            <p class="text-xs text-slate-500 mt-1">Manage brand manifesto, hallmark assurances, terms of service, and privacy policies.</p>
        </div>
        <a href="{{ route('admin.pages.create') }}" class="px-3.5 py-2 bg-slate-900 text-white rounded-lg text-xs font-semibold hover:bg-slate-800">
            + Create Page
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full text-left text-xs">
            <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-semibold border-b border-slate-200">
                <tr>
                    <th class="py-3 px-4">Page Title</th>
                    <th class="py-3 px-4">URL Slug</th>
                    <th class="py-3 px-4">Published</th>
                    <th class="py-3 px-4">Updated</th>
                    <th class="py-3 px-4 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-medium">
                @forelse($pages as $page)
                    <tr class="hover:bg-slate-50/70">
                        <td class="py-3 px-4 font-bold text-slate-900">{{ $page->title }}</td>
                        <td class="py-3 px-4 font-mono text-slate-500">/pages/{{ $page->slug }}</td>
                        <td class="py-3 px-4 font-bold text-[10px] uppercase {{ $page->is_published ? 'text-emerald-700' : 'text-slate-400' }}">
                            {{ $page->is_published ? 'Live' : 'Draft' }}
                        </td>
                        <td class="py-3 px-4 text-slate-500 text-[11px]">{{ $page->updated_at->format('M d, Y') }}</td>
                        <td class="py-3 px-4 text-right space-x-2">
                            <a href="{{ route('admin.pages.edit', $page) }}" class="text-blue-600 font-semibold hover:underline">Edit</a>
                            <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="inline" onsubmit="return confirm('Delete page?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 font-semibold hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="py-8 text-center text-slate-400">No custom pages added yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.admin>