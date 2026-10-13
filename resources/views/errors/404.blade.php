<x-layouts.app 
    title="Creation Not Found (404) | Modern Jewellery House"
    description="The piece or salon you requested cannot be located in the current collection."
    :robots="'noindex, nofollow'">

    <section class="min-h-[70vh] flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 bg-ivory-light" aria-live="assertive">
        <div class="max-w-xl mx-auto text-center">
            
            <!-- Luxury Atelier Crest -->
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gold/10 border border-gold/30 mb-8 shadow-sm">
                <svg class="w-10 h-10 text-gold-dark" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>

            <p class="text-xs uppercase tracking-[0.3em] font-sans font-semibold text-gold-dark mb-3">Error 404 &bull; Archival Notice</p>
            
            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-charcoal font-normal tracking-tight mb-4">
                Creation Not Found
            </h1>

            <p class="font-sans text-sm sm:text-base text-charcoal-muted leading-relaxed mb-10 max-w-md mx-auto">
                The creation or salon you seek cannot be located. It may have been acquired by a private collector, retired to our archival vault, or relocated.
            </p>

            <!-- Action CTAs -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('shop') }}" 
                   class="btn-luxury-gold w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 text-xs uppercase tracking-[0.2em] font-sans font-semibold">
                    <span>Explore Creations</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ route('home') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3.5 text-xs uppercase tracking-[0.2em] font-sans font-semibold text-charcoal border border-charcoal/20 hover:border-charcoal hover:bg-ivory transition-colors">
                    Return to Atelier
                </a>
            </div>

            <p class="mt-12 text-xs text-charcoal-muted">
                Need bespoke assistance? Contact our Concierge at <a href="mailto:concierge@modernjewelleryhouse.com" class="text-gold-dark hover:underline font-medium">concierge@modernjewelleryhouse.com</a>
            </p>
        </div>
    </section>

</x-layouts.app>
