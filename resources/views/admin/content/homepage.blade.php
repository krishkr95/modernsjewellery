<x-layouts.admin title="Homepage Editorial CMS | Modern Jewellery House">
    <div class="flex items-center justify-between pb-2 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Homepage Editorial CMS</h1>
            <p class="text-xs text-slate-500 mt-1">Manage cinematic hero video, copywriting, editorial spotlight, and bridal suite storytelling.</p>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="text-xs font-semibold text-blue-600 hover:text-blue-800 flex items-center space-x-1">
            <span>Preview Live Homepage ↗</span>
        </a>
    </div>

    <form action="{{ route('admin.content.homepage.update') }}" method="POST" class="space-y-6">
        @csrf

        <!-- CINEMATIC HERO SECTION -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4">
            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">Hero Section Configuration</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Cinematic Hero Video URL (MP4 / WebM / CDN)</label>
                    <input type="url" name="home_hero_video" value="{{ $content['hero_video'] }}" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs font-mono">
                    <p class="text-[10px] text-slate-400 mt-0.5">High efficiency, muted autoplay video.</p>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Fallback Poster Image URL</label>
                    <input type="text" name="home_hero_poster" value="{{ $content['hero_poster'] }}" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs">
                </div>
            </div>

            <div>
                <label class="block font-semibold text-slate-700 mb-1 text-xs">Hero Headline Title</label>
                <input type="text" name="home_hero_title" value="{{ $content['hero_title'] }}" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs uppercase font-serif tracking-wider font-bold text-slate-900">
            </div>

            <div>
                <label class="block font-semibold text-slate-700 mb-1 text-xs">Supporting Subtitle</label>
                <input type="text" name="home_hero_subtitle" value="{{ $content['hero_subtitle'] }}" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Primary Call to Action Text</label>
                    <input type="text" name="home_hero_cta_text" value="{{ $content['hero_cta_text'] }}" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs font-bold">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Call to Action Link Destination</label>
                    <input type="text" name="home_hero_cta_link" value="{{ $content['hero_cta_link'] }}" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs font-mono">
                </div>
            </div>
        </div>

        <!-- EDITORIAL CRAFTSMANSHIP -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4 text-xs">
            <h3 class="font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">Editorial Section</h3>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Editorial Heading</label>
                <input type="text" name="home_editorial_title" value="{{ $content['editorial_title'] }}" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Editorial Narrative Copy</label>
                <textarea name="home_editorial_text" rows="3" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs">{{ $content['editorial_text'] }}</textarea>
            </div>
        </div>

        <!-- BRIDAL SUITE -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4 text-xs">
            <h3 class="font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">Bridal Suite Spotlight</h3>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Bridal Suite Heading</label>
                <input type="text" name="home_bridal_title" value="{{ $content['bridal_title'] }}" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Bridal Narrative Copy</label>
                <textarea name="home_bridal_text" rows="3" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs">{{ $content['bridal_text'] }}</textarea>
            </div>
        </div>

        <!-- NEWSLETTER PATRON PRIVILEGE -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4 text-xs">
            <h3 class="font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">Newsletter Privilege Section</h3>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Newsletter Title</label>
                <input type="text" name="home_newsletter_title" value="{{ $content['newsletter_title'] }}" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Newsletter Narrative Text</label>
                <textarea name="home_newsletter_text" rows="2" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs">{{ $content['newsletter_text'] }}</textarea>
            </div>
        </div>

        <button type="submit" class="py-3 px-6 bg-slate-900 text-white rounded-lg font-bold text-xs uppercase tracking-wider hover:bg-slate-800 shadow">
            Save Homepage CMS Changes
        </button>
    </form>
</x-layouts.admin>