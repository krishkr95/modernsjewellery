<x-layouts.app 
    title="Atelier Refinement (500) | Modern Jewellery House"
    description="The Maison is currently undergoing momentary maintenance."
    :robots="'noindex, nofollow'">

    <section class="min-h-[70vh] flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 bg-ivory-light" aria-live="assertive">
        <div class="max-w-xl mx-auto text-center">
            
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-rose-500/10 border border-rose-500/30 mb-8 shadow-sm">
                <svg class="w-10 h-10 text-rose-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>

            <p class="text-xs uppercase tracking-[0.3em] font-sans font-semibold text-gold-dark mb-3">Error 500 &bull; Atelier Service Notice</p>
            
            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-charcoal font-normal tracking-tight mb-4">
                Momentary Service Interruption
            </h1>

            <p class="font-sans text-sm sm:text-base text-charcoal-muted leading-relaxed mb-10 max-w-md mx-auto">
                Our master artisans and digital concierge are currently attending to an unexpected service refinement. No transaction or client data has been compromised.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('home') }}" 
                   class="btn-luxury-gold w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 text-xs uppercase tracking-[0.2em] font-sans font-semibold">
                    <span>Return to Boutique</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                </a>
                <a href="{{ route('shop') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3.5 text-xs uppercase tracking-[0.2em] font-sans font-semibold text-charcoal border border-charcoal/20 hover:border-charcoal hover:bg-ivory transition-colors">
                    Explore Catalogue
                </a>
            </div>

            <p class="mt-12 text-xs text-charcoal-muted">
                Our technical concierge is on standby at <a href="mailto:concierge@modernjewelleryhouse.com" class="text-gold-dark hover:underline font-medium">concierge@modernjewelleryhouse.com</a>
            </p>
        </div>
    </section>

</x-layouts.app>
