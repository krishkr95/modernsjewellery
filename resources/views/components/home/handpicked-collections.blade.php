{{-- ============================================================
     BLUESTONE EXACT MATCH — HANDPICKED FOR YOU
     Top row (4 cards): BLUESTONE MAN | DAINTY DREAMS | Evil Eye | VIEW ALL / SOLITAIRES
     Bottom row (5 cards): Evening Glam | Barbie Kids | WISH | curve | Modern Chic
     ============================================================ --}}
<section id="handpicked-for-you" class="py-10 sm:py-14 px-3 sm:px-6 lg:px-8 bg-white select-none font-sans">
    <div class="max-w-[1700px] mx-auto">
        
        <!-- Section Header -->
        <div class="text-center mb-8 sm:mb-10">
            <h2 class="font-serif italic text-2xl sm:text-3xl lg:text-4xl text-[#0a2240] font-normal tracking-wide">
                Handpicked For You
            </h2>
            <div class="w-12 h-0.5 bg-[#f15d4c] mx-auto mt-2 rounded-full"></div>
        </div>

        <!-- TOP ROW: 4 Curated Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-3 sm:mb-4">
            
            <!-- Card 1: MODERN MAN -->
            <a href="{{ route('shop', ['search' => 'men']) }}" 
               class="group relative h-[260px] sm:h-[340px] lg:h-[400px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 border border-gray-200/80 bg-gray-100">
                <img src="{{ asset('assets/images/bluestone_man.jpg') }}" 
                     alt="MODERN MAN" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                
                <div class="absolute top-3 right-3 text-right">
                    <span class="text-[9px] uppercase tracking-widest text-gray-700 font-bold block">COLLECTION</span>
                    <span class="font-serif text-sm sm:text-base font-bold text-gray-900 tracking-wider">MAN</span>
                </div>

                <div class="absolute bottom-4 left-4 right-4">
                    <span class="text-[9px] uppercase tracking-widest text-amber-300 font-semibold block mb-0.5">Bold &bull; Architectural</span>
                    <h3 class="font-serif text-base sm:text-xl text-white font-normal drop-shadow-sm">
                        MODERN MAN
                    </h3>
                </div>
            </a>

            <!-- Card 2: DAINTY DREAMS -->
            <a href="{{ route('shop', ['category' => 'rings']) }}" 
               class="group relative h-[260px] sm:h-[340px] lg:h-[400px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 border border-purple-900/30 bg-[#28142a]">
                <img src="{{ asset('assets/images/dainty_dreams.jpg') }}" 
                     alt="DAINTY DREAMS" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/10 to-transparent"></div>

                <div class="absolute bottom-5 left-4 right-4 text-center">
                    <h3 class="font-serif text-2xl sm:text-3xl lg:text-4xl text-white font-normal tracking-wider uppercase leading-none drop-shadow-md">
                        DAINTY<br>
                        <span class="italic font-light text-pink-200">DREAMS</span>
                    </h3>
                    <p class="text-[9px] uppercase tracking-widest text-pink-200/80 mt-1.5 font-sans">Stackable Multi-Toned Bands</p>
                </div>
            </a>

            <!-- Card 3: Evil Eye -->
            <a href="{{ route('shop', ['search' => 'evil-eye']) }}" 
               class="group relative h-[260px] sm:h-[340px] lg:h-[400px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 border border-blue-900/30 bg-[#16273c]">
                <img src="{{ asset('assets/images/evil_eye_model.jpg') }}" 
                     alt="Evil Eye Collection" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>

                <div class="absolute top-4 right-4 text-right">
                    <h3 class="font-serif text-xl sm:text-3xl text-white font-normal leading-tight drop-shadow-md">
                        Evil<br><span class="italic text-cyan-300">Eye</span>
                    </h3>
                </div>

                <div class="absolute bottom-4 left-4 right-4">
                    <span class="text-[9px] uppercase tracking-widest text-cyan-300 font-semibold block mb-0.5">Protective Charms</span>
                    <p class="font-serif text-sm sm:text-base text-white">Turquoise &amp; Diamond Keepsakes</p>
                </div>
            </a>

            <!-- Card 4: VIEW ALL / SOLITAIRES CLASSIC -->
            <a href="{{ route('shop', ['search' => 'solitaire']) }}" 
               class="group relative h-[260px] sm:h-[340px] lg:h-[400px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 border border-amber-400/40 bg-[#1b263b]">
                <img src="{{ asset('assets/images/solitaire_red_velvet.jpg') }}" 
                     alt="View All Collection" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>

                <div class="absolute bottom-6 left-4 right-4 text-center">
                    <span class="text-[9px] uppercase tracking-widest text-amber-300 font-bold block mb-1">CURATED EDIT</span>
                    <h3 class="font-serif text-xl sm:text-2xl lg:text-3xl text-white font-normal uppercase tracking-wider leading-tight drop-shadow-md">
                        VIEW ALL<br>COLLECTIONS
                    </h3>
                    <div class="w-10 h-0.5 bg-amber-300 mx-auto mt-2"></div>
                </div>
            </a>

        </div>

        <!-- BOTTOM ROW: 5 Curated Cards -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">
            
            <!-- Card 5: Evening Model -->
            <a href="{{ route('shop', ['category' => 'bracelets']) }}" 
               class="group relative h-[240px] sm:h-[300px] lg:h-[360px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 border border-gray-200/80 bg-gray-100">
                <img src="{{ asset('assets/images/bridal-hero.jpg') }}" 
                     alt="Evening Glam" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-3 left-3 right-3">
                    <span class="text-[9px] uppercase tracking-wider text-amber-300 font-semibold block">Evening Glam</span>
                    <h4 class="font-serif text-sm sm:text-base text-white font-normal">Diamond Cuffs</h4>
                </div>
            </a>

            <!-- Card 6: Barbie Kids Rainbow -->
            <a href="{{ route('shop', ['search' => 'kids']) }}" 
               class="group relative h-[240px] sm:h-[300px] lg:h-[360px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 border border-pink-300/40 bg-pink-50">
                <img src="{{ asset('assets/images/kids_jewels.jpg') }}" 
                     alt="Barbie Kids" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-pink-950/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-4 left-3 right-3 text-center">
                    <h4 class="font-serif italic text-xl sm:text-2xl text-white font-normal drop-shadow-md">
                        Barbie Kids
                    </h4>
                    <p class="text-[8px] uppercase tracking-widest text-pink-200 mt-0.5">Pastel Rainbow Enamel</p>
                </div>
            </a>

            <!-- Card 7: WISH Flower Ring -->
            <a href="{{ route('shop', ['category' => 'rings']) }}" 
               class="group relative h-[240px] sm:h-[300px] lg:h-[360px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 border border-amber-900/30 bg-[#231b1b]">
                <img src="{{ asset('assets/images/wish_flower_ring.jpg') }}" 
                     alt="WISH Collection" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-transparent to-transparent"></div>
                <div class="absolute top-3 left-3 right-3 text-center">
                    <h4 class="font-serif text-xl sm:text-2xl text-amber-200 font-bold tracking-widest drop-shadow-md">
                        WISH
                    </h4>
                </div>
                <div class="absolute bottom-3 left-3 right-3 text-center">
                    <span class="text-[9px] uppercase tracking-widest text-amber-200 font-semibold">Blooming Petals</span>
                </div>
            </a>

            <!-- Card 8: curve Sculptural Gold -->
            <a href="{{ route('shop', ['category' => 'earrings']) }}" 
               class="group relative h-[240px] sm:h-[300px] lg:h-[360px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 border border-amber-700/30 bg-[#3a2818]">
                <img src="{{ asset('assets/images/curve_gold.jpg') }}" 
                     alt="The curve" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-transparent to-transparent"></div>
                <div class="absolute top-3 left-3 right-3 text-center">
                    <h4 class="font-serif italic text-2xl sm:text-3xl text-amber-100 font-light drop-shadow-md">
                        curve
                    </h4>
                </div>
                <div class="absolute bottom-3 left-3 right-3 text-center">
                    <span class="text-[9px] uppercase tracking-widest text-amber-200 font-semibold">18k Sculptural Gold</span>
                </div>
            </a>

            <!-- Card 9: Modern Chic Hoops -->
            <a href="{{ route('shop', ['category' => 'earrings']) }}" 
               class="group relative h-[240px] sm:h-[300px] lg:h-[360px] rounded-xl sm:rounded-2xl overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 border border-gray-200/80 bg-gray-100 col-span-2 sm:col-span-1">
                <img src="{{ asset('assets/images/earrings_model.jpg') }}" 
                     alt="Modern Hoops" 
                     loading="lazy" decoding="async"
                     class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-3 left-3 right-3">
                    <span class="text-[9px] uppercase tracking-wider text-amber-300 font-semibold block">Modern Chic</span>
                    <h4 class="font-serif text-sm sm:text-base text-white font-normal">Chandelier Drops</h4>
                </div>
            </a>

        </div>

    </div>
</section>
