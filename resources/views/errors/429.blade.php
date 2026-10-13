<x-layouts.app 
    title="Request Limit (429) | Modern Jewellery House"
    description="Too many requests detected. Please pause a moment before requesting further pieces."
    :robots="'noindex, nofollow'">

    <section class="min-h-[70vh] flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 bg-ivory-light" aria-live="assertive">
        <div class="max-w-xl mx-auto text-center">
            
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-amber-500/10 border border-amber-500/30 mb-8 shadow-sm">
                <svg class="w-10 h-10 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>

            <p class="text-xs uppercase tracking-[0.3em] font-sans font-semibold text-gold-dark mb-3">Error 429 &bull; Rate Limit</p>
            
            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-charcoal font-normal tracking-tight mb-4">
                High Atelier Volume
            </h1>

            <p class="font-sans text-sm sm:text-base text-charcoal-muted leading-relaxed mb-10 max-w-md mx-auto">
                A high volume of search and catalog queries was detected from your network. Please pause for a moment to allow our concierge service to restore equilibrium.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <button type="button" onclick="setTimeout(() => window.location.reload(), 1500)" 
                        class="btn-luxury-gold w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 text-xs uppercase tracking-[0.2em] font-sans font-semibold">
                    <span>Retry In A Moment</span>
                </button>
                <a href="{{ route('home') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3.5 text-xs uppercase tracking-[0.2em] font-sans font-semibold text-charcoal border border-charcoal/20 hover:border-charcoal hover:bg-ivory transition-colors">
                    Return to Atelier
                </a>
            </div>
        </div>
    </section>

</x-layouts.app>
