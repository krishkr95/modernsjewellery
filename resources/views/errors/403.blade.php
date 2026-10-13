<x-layouts.app 
    title="Access Restricted (403) | Modern Jewellery House"
    description="You do not possess the required credentials to access this salon or vault."
    :robots="'noindex, nofollow'">

    <section class="min-h-[70vh] flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 bg-ivory-light" aria-live="assertive">
        <div class="max-w-xl mx-auto text-center">
            
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-amber-500/10 border border-amber-500/30 mb-8 shadow-sm">
                <svg class="w-10 h-10 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>

            <p class="text-xs uppercase tracking-[0.3em] font-sans font-semibold text-gold-dark mb-3">Error 403 &bull; Private Vault</p>
            
            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-charcoal font-normal tracking-tight mb-4">
                Access Restricted
            </h1>

            <p class="font-sans text-sm sm:text-base text-charcoal-muted leading-relaxed mb-10 max-w-md mx-auto">
                This private salon is reserved exclusively for authenticated atelier directors and verified VIP patrons. Please sign in with appropriate privileges to proceed.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('login') }}" 
                   class="btn-luxury-gold w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 text-xs uppercase tracking-[0.2em] font-sans font-semibold">
                    <span>Sign In to Vault</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                </a>
                <a href="{{ route('home') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3.5 text-xs uppercase tracking-[0.2em] font-sans font-semibold text-charcoal border border-charcoal/20 hover:border-charcoal hover:bg-ivory transition-colors">
                    Return to Atelier
                </a>
            </div>
        </div>
    </section>

</x-layouts.app>
