{{-- ============================================================
     MODERN JEWELLERY HOUSE — CINEMATIC VIDEO LANDING HERO
     Full Original Height Video with Clean Text Overlay
     ============================================================ --}}
<section id="hero-landing-video"
         class="relative w-full bg-black overflow-hidden select-none">

    <!-- Full Original Height Video Container -->
    <div class="relative w-full overflow-hidden bg-black">
        
        <!-- Full Original Height Video Element -->
        <video poster="{{ asset('assets/images/hero-poster.jpg') }}"
               autoplay
               muted
               loop
               playsinline
               preload="auto"
               class="w-full h-auto block pointer-events-none">
            <source src="{{ asset('assets/video/craft-chain.mp4') }}" type="video/mp4">
            <source src="{{ asset('assets/video/d.webm') }}" type="video/webm">
        </video>

        <!-- Subtle Luxury Gradient for Text Legibility -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/25 to-black/35 pointer-events-none z-10"></div>

        <!-- Clean, Elegant Text Overlay (Centered & Refined) -->
        <div class="absolute inset-0 z-20 flex flex-col items-center justify-center text-center px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto pointer-events-none">

            <!-- Grand Headline -->
            <h1 class="font-serif text-2xl xs:text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-normal text-white leading-tight tracking-tight drop-shadow-md mb-2 sm:mb-3">
                Crafted for <span class="italic font-normal bg-gradient-to-r from-[#F7E7CE] via-[#ECC274] to-[#C59B4E] bg-clip-text text-transparent">Eternity</span>
            </h1>

            <!-- Elegant Short Tagline -->
            <p class="font-sans text-xs sm:text-sm md:text-base text-slate-200/90 font-light max-w-xl mx-auto leading-relaxed mb-5 sm:mb-6 drop-shadow-sm">
                Certified diamond solitaires and 22K hallmarked fine jewellery, handcrafted with bespoke precision.
            </p>

            <!-- Minimalist Luxury CTA Button -->
            <div class="pointer-events-auto">
                <a href="{{ route('shop') }}"
                   class="inline-flex items-center gap-2 px-6 sm:px-8 py-2.5 sm:py-3 rounded-full bg-gradient-to-r from-[#DFB76C] via-[#D4AF37] to-[#B8860B] hover:from-[#ECC274] hover:to-[#D4AF37] text-stone-950 font-bold text-[11px] sm:text-xs tracking-[0.16em] uppercase transition-all duration-300 shadow-[0_4px_20px_rgba(212,175,55,0.4)] hover:shadow-[0_6px_28px_rgba(212,175,55,0.6)] hover:-translate-y-0.5">
                    <span>Explore Creations</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

        </div>

    </div>

</section>