{{-- ============================================================
     BLUESTONE EXACT MATCH — SHOP BY CATEGORY (BURGUNDY BENTO GRID)
     Wine Red / Burgundy Luxury Gradient (#2c060b -> #4a0d15 -> #200407)
     Curved Script Title & Exact Mosaic Tile Structure
     ============================================================ --}}
<section id="shop-by-category" class="relative py-12 sm:py-16 px-3 sm:px-6 lg:px-8 bg-gradient-to-b from-[#260307] via-[#480c15] to-[#1c0205] text-white select-none overflow-hidden font-sans">
    
    <!-- Ambient Gold/Ruby Lighting Glows -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-4xl h-48 bg-amber-500/10 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-10 w-96 h-96 bg-rose-600/10 blur-3xl pointer-events-none"></div>

    <div class="max-w-[1700px] mx-auto relative z-10">
        
        <!-- Elegant Header with Flourishes -->
        <div class="text-center mb-8 sm:mb-12">
            <div class="inline-flex items-center justify-center gap-3 sm:gap-6">
                <span class="w-10 sm:w-20 h-px bg-gradient-to-r from-transparent to-amber-300/80"></span>
                <h2 class="font-serif italic text-3xl sm:text-4xl lg:text-5xl text-amber-100 font-normal tracking-wide drop-shadow-sm">
                    Shop By Category
                </h2>
                <span class="w-10 sm:w-20 h-px bg-gradient-to-l from-transparent to-amber-300/80"></span>
            </div>
            <div class="flex items-center justify-center gap-1.5 mt-2">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-400/80"></span>
                <span class="w-8 h-0.5 bg-amber-400/60 rounded-full"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-amber-400/80"></span>
            </div>
        </div>

        <!-- ========================================================
             DESKTOP & TABLET BENTO MOSAIC GRID
             Strict replica of the BlueStone homepage bento layout
             ======================================================== -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2.5 sm:gap-3.5">
            
            <!-- 1. TALL LEFT CARD: RINGS ON FORK (Spans 2 rows on lg) -->
            <a href="{{ route('shop', ['category' => 'rings']) }}" 
               class="group relative col-span-1 lg:row-span-2 min-h-[220px] sm:min-h-[280px] lg:min-h-[460px] rounded-xl sm:rounded-2xl overflow-hidden border border-white/10 hover:border-amber-300/60 shadow-md transition-all duration-300">
                <img src="{{ asset('assets/images/rings_fork.jpg') }}" 
                     alt="Rings Collection" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4">
                    <span class="text-white text-xs sm:text-sm md:text-base font-medium tracking-wide drop-shadow-md">
                        Rings
                    </span>
                </div>
            </a>

            <!-- 2. EARRINGS: Woman in orange dress -->
            <a href="{{ route('shop', ['category' => 'earrings']) }}" 
               class="group relative min-h-[140px] sm:min-h-[180px] lg:min-h-[220px] rounded-xl sm:rounded-2xl overflow-hidden border border-white/10 hover:border-amber-300/60 shadow-md transition-all duration-300">
                <img src="{{ asset('assets/images/earrings_model.jpg') }}" 
                     alt="Earrings Collection" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4">
                    <span class="text-white text-xs sm:text-sm md:text-base font-medium tracking-wide drop-shadow-md">
                        Earrings
                    </span>
                </div>
            </a>

            <!-- 3. PENDANTS: Heart pendant on blue silk -->
            <a href="{{ route('shop', ['search' => 'pendant']) }}" 
               class="group relative min-h-[140px] sm:min-h-[180px] lg:min-h-[220px] rounded-xl sm:rounded-2xl overflow-hidden border border-white/10 hover:border-amber-300/60 shadow-md transition-all duration-300">
                <img src="{{ asset('assets/images/heart_pendant.jpg') }}" 
                     alt="Pendants Collection" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4">
                    <span class="text-white text-xs sm:text-sm md:text-base font-medium tracking-wide drop-shadow-md">
                        Pendants
                    </span>
                </div>
            </a>

            <!-- 4. CHAINS: Gold necklace locket -->
            <a href="{{ route('shop', ['search' => 'chain']) }}" 
               class="group relative min-h-[140px] sm:min-h-[180px] lg:min-h-[220px] rounded-xl sm:rounded-2xl overflow-hidden border border-white/10 hover:border-amber-300/60 shadow-md transition-all duration-300">
                <img src="{{ asset('assets/images/celestial-baroque-pearl-pendant-1.jpg') }}" 
                     alt="Chains Collection" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4">
                    <span class="text-white text-xs sm:text-sm md:text-base font-medium tracking-wide drop-shadow-md">
                        Chains
                    </span>
                </div>
            </a>

            <!-- 5. CENTER HERO: WOMAN WITH RUBY NECKLACE ON YELLOW BACKGROUND (Spans 2 cols, 2 rows on lg) -->
            <a href="{{ route('shop', ['category' => 'necklaces']) }}" 
               class="group relative col-span-2 lg:col-span-2 lg:row-span-2 min-h-[240px] sm:min-h-[320px] lg:min-h-[460px] rounded-xl sm:rounded-2xl overflow-hidden border border-white/10 hover:border-amber-300/60 shadow-xl transition-all duration-300">
                <img src="{{ asset('assets/images/necklace_statement.jpg') }}" 
                     alt="Necklaces Statement Collection" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>
                <div class="absolute bottom-3 sm:bottom-5 left-3 sm:left-5">
                    <span class="text-white text-sm sm:text-base md:text-lg font-medium tracking-wide drop-shadow-md">
                        Necklaces
                    </span>
                </div>
            </a>

            <!-- 6. WATCH JEWELLERY: Architectural Gold Cuff -->
            <a href="{{ route('shop', ['search' => 'watch']) }}" 
               class="group relative min-h-[140px] sm:min-h-[180px] lg:min-h-[220px] rounded-xl sm:rounded-2xl overflow-hidden border border-white/10 hover:border-amber-300/60 shadow-md transition-all duration-300">
                <img src="{{ asset('assets/images/paloma-sculptural-gold-cuff-1.jpg') }}" 
                     alt="Watch Jewellery" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4">
                    <span class="text-white text-xs sm:text-sm md:text-base font-medium tracking-wide drop-shadow-md">
                        Watch Jewellery
                    </span>
                </div>
            </a>

            <!-- 7. GOLD COINS: Pure 24Kt Coin Emblem -->
            <a href="{{ route('shop', ['category' => 'coins']) }}" 
               class="group relative min-h-[140px] sm:min-h-[180px] lg:min-h-[220px] rounded-xl sm:rounded-2xl overflow-hidden border border-white/10 hover:border-amber-300/60 shadow-md transition-all duration-300">
                <img src="{{ asset('assets/images/gold_coin_emblem.jpg') }}" 
                     alt="Gold Coins" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4">
                    <span class="text-white text-xs sm:text-sm md:text-base font-medium tracking-wide drop-shadow-md">
                        Gold Coins
                    </span>
                </div>
            </a>

            <!-- 8. BANGLES: Gold Bangles On Silk (Spans 2 cols on lg) -->
            <a href="{{ route('shop', ['category' => 'bracelets']) }}" 
               class="group relative col-span-2 min-h-[140px] sm:min-h-[180px] lg:min-h-[220px] rounded-xl sm:rounded-2xl overflow-hidden border border-white/10 hover:border-amber-300/60 shadow-md transition-all duration-300">
                <img src="{{ asset('assets/images/collection-bracelets.jpg') }}" 
                     alt="Bangles Collection" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4">
                    <span class="text-white text-xs sm:text-sm md:text-base font-medium tracking-wide drop-shadow-md">
                        Bangles
                    </span>
                </div>
            </a>

            <!-- 9. KADAS / MEN'S WRIST: Diamond Kada on Wrist -->
            <a href="{{ route('shop', ['search' => 'kada']) }}" 
               class="group relative min-h-[140px] sm:min-h-[180px] lg:min-h-[220px] rounded-xl sm:rounded-2xl overflow-hidden border border-white/10 hover:border-amber-300/60 shadow-md transition-all duration-300">
                <img src="{{ asset('assets/images/sovereign-diamond-tennis-bracelet-1.jpg') }}" 
                     alt="Kadas Collection" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4">
                    <span class="text-white text-xs sm:text-sm md:text-base font-medium tracking-wide drop-shadow-md">
                        Kadas
                    </span>
                </div>
            </a>

            <!-- 10. NOSE PINS: Subtle Diamond Nose Pin -->
            <a href="{{ route('shop', ['search' => 'nose-pin']) }}" 
               class="group relative min-h-[140px] sm:min-h-[180px] lg:min-h-[220px] rounded-xl sm:rounded-2xl overflow-hidden border border-white/10 hover:border-amber-300/60 shadow-md transition-all duration-300">
                <img src="{{ asset('assets/images/aurelia-solitaire-diamond-ring-2.jpg') }}" 
                     alt="Nose Pins Collection" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4">
                    <span class="text-white text-xs sm:text-sm md:text-base font-medium tracking-wide drop-shadow-md">
                        Nose Pins
                    </span>
                </div>
            </a>

            <!-- 11. KIDS JEWELLERY: Rainbow Enamel -->
            <a href="{{ route('shop', ['search' => 'kids']) }}" 
               class="group relative min-h-[140px] sm:min-h-[180px] lg:min-h-[220px] rounded-xl sm:rounded-2xl overflow-hidden border border-white/10 hover:border-amber-300/60 shadow-md transition-all duration-300">
                <img src="{{ asset('assets/images/kids_jewels.jpg') }}" 
                     alt="Kids Jewellery" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4">
                    <span class="text-white text-xs sm:text-sm md:text-base font-medium tracking-wide drop-shadow-md">
                        Kids Jewellery
                    </span>
                </div>
            </a>

            <!-- 12. MEN'S JEWELLERY: Signet & Cuff on Man -->
            <a href="{{ route('shop', ['search' => 'men']) }}" 
               class="group relative min-h-[140px] sm:min-h-[180px] lg:min-h-[220px] rounded-xl sm:rounded-2xl overflow-hidden border border-white/10 hover:border-amber-300/60 shadow-md transition-all duration-300">
                <img src="{{ asset('assets/images/bluestone_man.jpg') }}" 
                     alt="Men's Jewellery" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4">
                    <span class="text-white text-xs sm:text-sm md:text-base font-medium tracking-wide drop-shadow-md">
                        Men's Jewellery
                    </span>
                </div>
            </a>

            <!-- 13. TALL RIGHT CARD: SOLITAIRES ON RED VELVET (Spans 2 rows on lg) -->
            <a href="{{ route('shop', ['search' => 'solitaire']) }}" 
               class="group relative col-span-1 lg:row-span-2 min-h-[220px] sm:min-h-[280px] lg:min-h-[460px] rounded-xl sm:rounded-2xl overflow-hidden border border-white/10 hover:border-amber-300/60 shadow-md transition-all duration-300">
                <img src="{{ asset('assets/images/solitaire_red_velvet.jpg') }}" 
                     alt="Solitaires Collection" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4">
                    <span class="text-white text-xs sm:text-sm md:text-base font-medium tracking-wide drop-shadow-md">
                        Solitaires
                    </span>
                </div>
            </a>

            <!-- 14. MANGALSUTRAS: Diamond mangalsutra on collarbone -->
            <a href="{{ route('shop', ['search' => 'mangalsutra']) }}" 
               class="group relative min-h-[140px] sm:min-h-[180px] lg:min-h-[220px] rounded-xl sm:rounded-2xl overflow-hidden border border-white/10 hover:border-amber-300/60 shadow-md transition-all duration-300">
                <img src="{{ asset('assets/images/etoile-cascade-diamond-collier-2.jpg') }}" 
                     alt="Mangalsutras Collection" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4">
                    <span class="text-white text-xs sm:text-sm md:text-base font-medium tracking-wide drop-shadow-md">
                        Mangalsutras
                    </span>
                </div>
            </a>

            <!-- 15. BRACELETS: Tennis Diamond Bracelet -->
            <a href="{{ route('shop', ['category' => 'bracelets']) }}" 
               class="group relative min-h-[140px] sm:min-h-[180px] lg:min-h-[220px] rounded-xl sm:rounded-2xl overflow-hidden border border-white/10 hover:border-amber-300/60 shadow-md transition-all duration-300">
                <img src="{{ asset('assets/images/sovereign-diamond-tennis-bracelet-2.jpg') }}" 
                     alt="Bracelets Collection" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4">
                    <span class="text-white text-xs sm:text-sm md:text-base font-medium tracking-wide drop-shadow-md">
                        Bracelets
                    </span>
                </div>
            </a>

            <!-- 16. COUPLES: Stacked Bands & Rings -->
            <a href="{{ route('shop', ['category' => 'rings']) }}" 
               class="group relative min-h-[140px] sm:min-h-[180px] lg:min-h-[220px] rounded-xl sm:rounded-2xl overflow-hidden border border-white/10 hover:border-amber-300/60 shadow-md transition-all duration-300">
                <img src="{{ asset('assets/images/collection-rings.jpg') }}" 
                     alt="Couples Collection" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/15 to-transparent"></div>
                <div class="absolute bottom-3 sm:bottom-4 left-3 sm:left-4">
                    <span class="text-white text-xs sm:text-sm md:text-base font-medium tracking-wide drop-shadow-md">
                        Couples
                    </span>
                </div>
            </a>

        </div>

    </div>
</section>
