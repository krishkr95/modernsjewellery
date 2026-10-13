{{-- ============================================================
     MODERN JEWELLERY HOUSE — ATELIER HIGHLIGHTS & VISUAL EDITORIAL
     High-fashion photography collage showcasing brand pillars:
     Certifications, Bespoke Craftsmanship, Luxury Unboxing & Gemstones
     ============================================================ --}}
<section id="atelier-highlights" class="py-14 sm:py-20 bg-white border-b border-gray-200 select-none font-sans">
    <div class="max-w-[1700px] mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center mb-10 sm:mb-14">
            <span class="text-[11px] uppercase tracking-[0.25em] text-[#0a2240] font-bold block mb-1">
                The Atelier Aesthetic
            </span>
            <h2 class="font-serif text-3xl sm:text-4xl text-[#0a2240] font-normal tracking-tight">
                Modern Jewellery House Highlights
            </h2>
            <div class="w-12 h-1 bg-[#f15d4c] mx-auto mt-2.5 rounded-full"></div>
            <p class="text-xs sm:text-sm text-gray-500 max-w-xl mx-auto mt-3 font-light">
                Every piece reflects our commitment to ethical sourcing, master lapidary precision, and timeless Indian elegance.
            </p>
        </div>

        <!-- 2-Column Mobile, 4-Column Desktop Editorial Showcase Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-4 lg:gap-6">
            
            <!-- Highlight 1: Certified Solitaires -->
            <div class="group relative rounded-xl sm:rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 bg-[#081b32] text-white">
                <div class="aspect-[4/5] overflow-hidden">
                    <img src="{{ asset('assets/images/solitaire_red_velvet.jpg') }}" 
                         alt="Certified Solitaires Highlight" 
                         loading="lazy" decoding="async"
                         class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-700">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                <div class="absolute bottom-3 left-3 right-3 sm:bottom-5 sm:left-5 sm:right-5">
                    <span class="text-[9px] sm:text-[10px] uppercase tracking-widest text-amber-300 font-bold block mb-0.5 sm:mb-1">
                        100% Certified
                    </span>
                    <h3 class="font-serif text-sm sm:text-xl lg:text-2xl font-normal leading-snug sm:leading-tight">
                        GIA &amp; IGI Solitaires
                    </h3>
                    <p class="text-[10px] sm:text-xs text-gray-300 mt-0.5 sm:mt-1 font-light line-clamp-2 hidden xs:block">
                        Hand-selected rough diamonds cut with maximum light refraction.
                    </p>
                    <a href="{{ route('shop', ['search' => 'solitaire']) }}" 
                       class="inline-flex items-center gap-1 text-[10px] sm:text-xs text-amber-300 font-semibold uppercase tracking-wider mt-1.5 sm:mt-3 group-hover:translate-x-1 transition-transform">
                        <span>Explore Solitaires</span> <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Highlight 2: Master Lapidary Art -->
            <div class="group relative rounded-xl sm:rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 bg-[#28080f] text-white">
                <div class="aspect-[4/5] overflow-hidden">
                    <img src="{{ asset('assets/images/necklace_statement.jpg') }}" 
                         alt="Master Lapidary Art" 
                         loading="lazy" decoding="async"
                         class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-700">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                <div class="absolute bottom-3 left-3 right-3 sm:bottom-5 sm:left-5 sm:right-5">
                    <span class="text-[9px] sm:text-[10px] uppercase tracking-widest text-amber-300 font-bold block mb-0.5 sm:mb-1">
                        Heritage Craft
                    </span>
                    <h3 class="font-serif text-sm sm:text-xl lg:text-2xl font-normal leading-snug sm:leading-tight">
                        Haute Joaillerie Colliers
                    </h3>
                    <p class="text-[10px] sm:text-xs text-gray-300 mt-0.5 sm:mt-1 font-light line-clamp-2 hidden xs:block">
                        Hand-set Burmese rubies and diamonds set in hallmarked 18Kt yellow gold.
                    </p>
                    <a href="{{ route('shop', ['category' => 'necklaces']) }}" 
                       class="inline-flex items-center gap-1 text-[10px] sm:text-xs text-amber-300 font-semibold uppercase tracking-wider mt-1.5 sm:mt-3 group-hover:translate-x-1 transition-transform">
                        <span>Statement Pieces</span> <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Highlight 3: Fluid Architectural Forms -->
            <div class="group relative rounded-xl sm:rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 bg-[#1c1a17] text-white">
                <div class="aspect-[4/5] overflow-hidden">
                    <img src="{{ asset('assets/images/curve_gold.jpg') }}" 
                         alt="Fluid Architectural Forms" 
                         loading="lazy" decoding="async"
                         class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-700">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                <div class="absolute bottom-3 left-3 right-3 sm:bottom-5 sm:left-5 sm:right-5">
                    <span class="text-[9px] sm:text-[10px] uppercase tracking-widest text-amber-300 font-bold block mb-0.5 sm:mb-1">
                        Modern Silhouettes
                    </span>
                    <h3 class="font-serif text-sm sm:text-xl lg:text-2xl font-normal leading-snug sm:leading-tight">
                        The Curve Collection
                    </h3>
                    <p class="text-[10px] sm:text-xs text-gray-300 mt-0.5 sm:mt-1 font-light line-clamp-2 hidden xs:block">
                        Sculptural gold forms crafted for effortless everyday luxury.
                    </p>
                    <a href="{{ route('shop', ['category' => 'earrings']) }}" 
                       class="inline-flex items-center gap-1 text-[10px] sm:text-xs text-amber-300 font-semibold uppercase tracking-wider mt-1.5 sm:mt-3 group-hover:translate-x-1 transition-transform">
                        <span>Shop The Curve</span> <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Highlight 4: Modern Man Collection -->
            <div class="group relative rounded-xl sm:rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 bg-[#0d1622] text-white">
                <div class="aspect-[4/5] overflow-hidden">
                    <img src="{{ asset('assets/images/bluestone_man.jpg') }}" 
                         alt="Modern Man Highlights" 
                         loading="lazy" decoding="async"
                         class="w-full h-full object-cover object-top group-hover:scale-110 transition-transform duration-700">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                <div class="absolute bottom-3 left-3 right-3 sm:bottom-5 sm:left-5 sm:right-5">
                    <span class="text-[9px] sm:text-[10px] uppercase tracking-widest text-amber-300 font-bold block mb-0.5 sm:mb-1">
                        Bespoke Signets
                    </span>
                    <h3 class="font-serif text-sm sm:text-xl lg:text-2xl font-normal leading-snug sm:leading-tight">
                        Modern Man Atelier
                    </h3>
                    <p class="text-[10px] sm:text-xs text-gray-300 mt-0.5 sm:mt-1 font-light line-clamp-2 hidden xs:block">
                        Architectural cuffs, onyx bands, and platinum diamond rings.
                    </p>
                    <a href="{{ route('shop', ['search' => 'men']) }}" 
                       class="inline-flex items-center gap-1 text-[10px] sm:text-xs text-amber-300 font-semibold uppercase tracking-wider mt-1.5 sm:mt-3 group-hover:translate-x-1 transition-transform">
                        <span>Explore Men's</span> <span>&rarr;</span>
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>
