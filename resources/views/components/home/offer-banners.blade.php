@php
    use App\Models\Banner;
    
    // Fetch active banners for the promotional corridor ('promo')
    $adminPromoBanners = Banner::where('placement', 'promo')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    // Default luxury promotional fallback cards if no active admin banners
    $defaults = [
        (object)[
            'title' => 'Big Gold Upgrade',
            'subtitle' => 'Exchange your old gold jewellery for pure new designs at zero making charge loss.',
            'tagline' => '100% Exchange Value',
            'cta_text' => 'Upgrade Now',
            'cta_link' => route('shop', ['offer' => 'gold-upgrade']),
            'desktop_image_url' => asset('assets/images/gold_upgrade_jewel.jpg'),
            'gradient' => 'from-[#231b1b] to-[#120f0f]',
            'border' => 'border-amber-900/30'
        ],
        (object)[
            'title' => '0% Making Charges',
            'subtitle' => 'Special festival privileges on selected hallmarked diamond and polki creations.',
            'tagline' => 'Limited Privileges',
            'cta_text' => 'Explore Designs',
            'cta_link' => route('shop', ['offer' => 'zero-making']),
            'desktop_image_url' => asset('assets/images/rings_fork.jpg'),
            'gradient' => 'from-[#191428] to-[#0e0c1a]',
            'border' => 'border-purple-900/30'
        ],
        (object)[
            'title' => '10% Off Solitaires',
            'subtitle' => 'Certified lab & natural solitaire diamonds with complimentary platinum band.',
            'tagline' => 'Bespoke Atelier',
            'cta_text' => 'Shop Solitaires',
            'cta_link' => route('shop', ['category' => 'solitaires']),
            'desktop_image_url' => asset('assets/images/solitaire_red_velvet.jpg'),
            'gradient' => 'from-[#1c2229] to-[#0d1217]',
            'border' => 'border-blue-900/30'
        ],
        (object)[
            'title' => 'Bridal Trousseau Special',
            'subtitle' => 'Complete handcrafted heritage bridal sets with royal kundan & emerald setting.',
            'tagline' => 'Bridal Connoisseur',
            'cta_text' => 'View Trousseau',
            'cta_link' => route('shop', ['category' => 'bridal']),
            'desktop_image_url' => asset('assets/images/necklace_statement.jpg'),
            'gradient' => 'from-[#2a1b18] to-[#140b09]',
            'border' => 'border-rose-900/30'
        ]
    ];

    $displayCards = [];
    if ($adminPromoBanners->isNotEmpty()) {
        foreach ($adminPromoBanners as $b) {
            $displayCards[] = (object)[
                'title' => $b->title,
                'subtitle' => $b->subtitle,
                'tagline' => $b->tagline,
                'cta_text' => $b->cta_text ?: 'Explore Now',
                'cta_link' => $b->cta_link ?: route('shop'),
                'desktop_image_url' => $b->desktop_image_url ? asset($b->desktop_image_url) : null,
                'gradient' => 'from-[#1e1e24] to-[#111115]',
                'border' => 'border-amber-500/20'
            ];
        }
    } else {
        $displayCards = $defaults;
    }

    // Duplicate array to ensure seamless infinite looping right-to-left
    $sliderCards = array_merge($displayCards, $displayCards);
@endphp

{{-- ============================================================
     OFFER PROMOTIONS — SEAMLESS RIGHT-TO-LEFT AUTOSLIDER
     No navigation buttons, continuous smooth auto-scrolling
     Responsive across mobile, tablet, and desktop
     ============================================================ --}}
<section id="offer-promotions" class="py-4 sm:py-6 lg:py-8 bg-white dark:bg-stone-900 select-none overflow-hidden relative">
    
    <!-- Edge Fades for Smooth Horizon Transition -->
    <div class="absolute left-0 top-0 bottom-0 w-8 sm:w-16 lg:w-24 bg-gradient-to-r from-white dark:from-stone-900 via-white/80 dark:via-stone-900/80 to-transparent z-10 pointer-events-none"></div>
    <div class="absolute right-0 top-0 bottom-0 w-8 sm:w-16 lg:w-24 bg-gradient-to-l from-white dark:from-stone-900 via-white/80 dark:via-stone-900/80 to-transparent z-10 pointer-events-none"></div>

    <!-- Right-to-Left Continuous Scrolling Track -->
    <div class="w-full overflow-hidden py-1">
        <div class="flex gap-3 sm:gap-4 lg:gap-5 animate-offer-rtl hover:[animation-play-state:paused] w-max select-none">
            @foreach($sliderCards as $card)
                <a href="{{ $card->cta_link }}" 
                   class="group relative w-[280px] xs:w-[330px] sm:w-[420px] lg:w-[480px] h-[170px] sm:h-[210px] lg:h-[240px] rounded-xl sm:rounded-2xl overflow-hidden bg-gradient-to-br {{ $card->gradient }} {{ $card->border }} border shadow-xs hover:shadow-xl transition-all duration-300 flex items-center justify-between p-4 sm:p-6 text-white flex-shrink-0 cursor-pointer">
                    
                    @if($card->desktop_image_url)
                        <!-- Full Cover Background Image -->
                        <img src="{{ $card->desktop_image_url }}" 
                             alt="{{ $card->title }}" 
                             loading="lazy" 
                             decoding="async" 
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        
                        <!-- High Contrast Gradient Mask for Text Readability -->
                        <div class="absolute inset-0 bg-gradient-to-t sm:bg-gradient-to-r from-black/85 via-black/50 to-black/25 pointer-events-none"></div>
                    @else
                        <!-- Subtle Sparkle Glitter Pattern -->
                        <div class="absolute inset-0 opacity-20 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:12px_12px] pointer-events-none"></div>
                    @endif

                    <!-- Card Content Overlay -->
                    <div class="relative z-10 max-w-[80%] sm:max-w-[75%]">
                        @if($card->tagline)
                            <span class="inline-block px-2.5 py-0.5 bg-amber-400/20 text-amber-300 border border-amber-400/40 rounded-full text-[9px] sm:text-[10px] font-bold uppercase tracking-wider mb-2">
                                {{ $card->tagline }}
                            </span>
                        @endif
                        
                        <h3 class="font-serif text-base sm:text-2xl lg:text-3xl font-bold tracking-tight text-white leading-tight uppercase drop-shadow-sm">
                            {!! nl2br(e($card->title)) !!}
                        </h3>

                        @if($card->subtitle)
                            <p class="text-[10px] sm:text-xs text-slate-100/90 mt-1 sm:mt-1.5 font-medium line-clamp-2 leading-relaxed">
                                {{ $card->subtitle }}
                            </p>
                        @endif

                        @if($card->cta_text)
                            <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-xs font-bold text-amber-300 uppercase tracking-wider mt-2.5 sm:mt-3 group-hover:translate-x-1.5 transition-transform">
                                <span>{{ $card->cta_text }}</span> <span>&rarr;</span>
                            </span>
                        @endif
                    </div>

                    <!-- Sparkle Accent Icon -->
                    <div class="relative z-10 self-start text-amber-300/70 text-sm hidden sm:block">✦</div>
                </a>
            @endforeach
        </div>
    </div>

</section>

<!-- Smooth Continuous Right-to-Left Auto-Scrolling Animation -->
<style>
    @keyframes offerScrollRtl {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }

    .animate-offer-rtl {
        animation: offerScrollRtl 38s linear infinite;
        will-change: transform;
    }

    @media (max-width: 640px) {
        .animate-offer-rtl {
            animation-duration: 28s;
        }
    }
</style>
