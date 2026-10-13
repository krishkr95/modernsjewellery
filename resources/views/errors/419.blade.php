<x-layouts.app 
    title="Session Expired (419) | Modern Jewellery House"
    description="Your secure session has expired for security."
    :robots="'noindex, nofollow'">

    <section class="min-h-[70vh] flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 bg-ivory-light" aria-live="assertive">
        <div class="max-w-xl mx-auto text-center">
            
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-500/10 border border-blue-500/30 mb-8 shadow-sm">
                <svg class="w-10 h-10 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>

            <p class="text-xs uppercase tracking-[0.3em] font-sans font-semibold text-gold-dark mb-3">Error 419 &bull; Security Refresh</p>
            
            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-charcoal font-normal tracking-tight mb-4">
                Session Expired
            </h1>

            <p class="font-sans text-sm sm:text-base text-charcoal-muted leading-relaxed mb-10 max-w-md mx-auto">
                For the security of your private commissions and payment credentials, your encrypted session has timed out. Please refresh or return to your shopping bag to continue.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <button type="button" onclick="window.location.reload()" 
                        class="btn-luxury-gold w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 text-xs uppercase tracking-[0.2em] font-sans font-semibold">
                    <span>Refresh Session</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                </button>
                <a href="{{ route('home') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3.5 text-xs uppercase tracking-[0.2em] font-sans font-semibold text-charcoal border border-charcoal/20 hover:border-charcoal hover:bg-ivory transition-colors">
                    Return to Atelier
                </a>
            </div>
        </div>
    </section>

</x-layouts.app>
