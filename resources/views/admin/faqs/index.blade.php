<x-layouts.admin title="FAQs | Modern Jewellery House">
    <div class="flex items-center justify-between pb-2 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Client Inquiries & FAQs</h1>
            <p class="text-xs text-slate-500 mt-1">Manage public concierge questions regarding hallmarking, diamond grading, and bespoke orders.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Add FAQ Form -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm space-y-4 text-xs">
            <h3 class="font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">Add New FAQ</h3>
            <form action="{{ route('admin.faqs.store') }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Category</label>
                    <input type="text" name="category" required placeholder="e.g. Certification, Shipping, Bespoke" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Question *</label>
                    <input type="text" name="question" required placeholder="e.g. Do all solitaires include GIA grading dossiers?" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Concierge Answer *</label>
                    <textarea name="answer" rows="3" required placeholder="Concierge explanation..." class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs"></textarea>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Display Sort Order</label>
                    <input type="number" name="sort_order" value="0" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs font-mono">
                </div>
                <button type="submit" class="w-full py-2.5 bg-slate-900 text-white rounded font-bold uppercase tracking-wider text-xs">
                    Save FAQ
                </button>
            </form>
        </div>

        <!-- FAQs List -->
        <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="divide-y divide-slate-100 text-xs">
                @forelse($faqs as $faq)
                    <div class="p-4 space-y-1.5 hover:bg-slate-50">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded bg-slate-100 text-slate-600 font-mono">{{ $faq->category }}</span>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline" onsubmit="return confirm('Remove FAQ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 font-semibold hover:underline">Delete</button>
                            </form>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm">{{ $faq->question }}</h4>
                        <p class="text-slate-600 leading-relaxed">{{ $faq->answer }}</p>
                    </div>
                @empty
                    <p class="text-slate-400 text-center py-8">No FAQs registered.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.admin>