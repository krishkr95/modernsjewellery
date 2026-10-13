{{-- ============================================================
     BLUESTONE EXACT MATCH — RECOMMENDED FOR YOU (STORY CIRCLES)
     Circular Avatar Category Track: All | Rings | Earrings | Pendants | Solitaires | Mangalsutras | Bangles | Chains | Nose Pins | Men's | Kids | Coins
     ============================================================ --}}
<section id="recommended-categories-section" class="py-8 sm:py-10 bg-[#fafafa] border-t border-b border-gray-200/80 overflow-hidden select-none font-sans">
    <div class="max-w-[1700px] mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center mb-6">
            <h2 class="font-serif italic text-2xl sm:text-3xl text-[#0a2240] font-normal tracking-wide">
                Recommended For You
            </h2>
            <div class="w-10 h-0.5 bg-[#f15d4c] mx-auto mt-2 rounded-full"></div>
        </div>

        @php
            $stories = [
                ['name' => 'All', 'url' => route('shop'), 'img' => null, 'icon' => 'sparkles'],
                ['name' => 'Rings', 'url' => route('shop', ['category' => 'rings']), 'img' => asset('assets/images/rings_fork.jpg')],
                ['name' => 'Earrings', 'url' => route('shop', ['category' => 'earrings']), 'img' => asset('assets/images/earrings_model.jpg')],
                ['name' => 'Pendants', 'url' => route('shop', ['search' => 'pendant']), 'img' => asset('assets/images/heart_pendant.jpg')],
                ['name' => 'Solitaires', 'url' => route('shop', ['search' => 'solitaire']), 'img' => asset('assets/images/solitaire_red_velvet.jpg')],
                ['name' => 'Mangalsutra', 'url' => route('shop', ['search' => 'mangalsutra']), 'img' => asset('assets/images/etoile-cascade-diamond-collier-2.jpg')],
                ['name' => 'Bangles', 'url' => route('shop', ['category' => 'bracelets']), 'img' => asset('assets/images/collection-bracelets.jpg')],
                ['name' => 'Chains', 'url' => route('shop', ['search' => 'chain']), 'img' => asset('assets/images/celestial-baroque-pearl-pendant-1.jpg')],
                ['name' => 'Nose Pins', 'url' => route('shop', ['search' => 'nose-pin']), 'img' => asset('assets/images/aurelia-solitaire-diamond-ring-2.jpg')],
                ['name' => "Men's", 'url' => route('shop', ['search' => 'men']), 'img' => asset('assets/images/bluestone_man.jpg')],
                ['name' => 'Kids', 'url' => route('shop', ['search' => 'kids']), 'img' => asset('assets/images/kids_jewels.jpg')],
                ['name' => 'Coins', 'url' => route('shop', ['category' => 'coins']), 'img' => asset('assets/images/gold_coin_emblem.jpg')],
            ];
        @endphp

        <!-- Smooth Scrollable Story Avatar Container -->
        <div class="flex items-center justify-start lg:justify-center gap-4 sm:gap-6 lg:gap-8 overflow-x-auto scrollbar-none py-2 px-2 snap-x snap-mandatory"
             style="-webkit-overflow-scrolling: touch;">

            @foreach($stories as $story)
                <a href="{{ $story['url'] }}" 
                   class="group flex flex-col items-center flex-shrink-0 snap-center transition-all duration-300 focus:outline-none">
                    
                    <!-- Circular Icon/Image Container with Gradient Accent Border -->
                    <div class="relative w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20 rounded-full p-0.5 bg-gradient-to-tr from-amber-400 via-rose-300 to-amber-200 shadow-xs group-hover:shadow-md group-hover:scale-105 transition-all duration-300">
                        <div class="w-full h-full rounded-full overflow-hidden bg-white flex items-center justify-center border-2 border-white">
                            @if(!empty($story['icon']) && $story['icon'] === 'sparkles')
                                <div class="w-full h-full bg-gradient-to-br from-[#0a2240] to-[#163a66] flex items-center justify-center text-amber-300">
                                    <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l2.4 7.2L22 12l-7.6 2.8L12 22l-2.4-7.2L2 12l7.6-2.8L12 2z"/>
                                    </svg>
                                </div>
                            @else
                                <img src="{{ $story['img'] }}" 
                                     alt="{{ $story['name'] }}"
                                     loading="lazy"
                                     decoding="async"
                                     class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500">
                            @endif
                        </div>
                    </div>

                    <!-- Clean Centered Label -->
                    <span class="mt-2 text-[11px] sm:text-xs font-sans text-gray-700 group-hover:text-[#0a2240] group-hover:font-semibold text-center tracking-tight transition-all truncate max-w-[76px]">
                        {{ $story['name'] }}
                    </span>
                </a>
            @endforeach

        </div>

    </div>
</section>
