@props(['banners' => collect()])

@php
    // If no active banners found from the database, fall back to our 4 high-resolution commercial campaigns
    if ($banners->isEmpty()) {
        $banners = collect([
            (object)[
                'id' => 1,
                'title' => 'BIG GOLD UPGRADE',
                'cta_link' => route('shop', ['offer' => 'upgrade']),
                'desktop_image_url' => asset('assets/images/banner_gold_upgrade.jpg'),
                'mobile_image_url' => asset('assets/images/banner_gold_upgrade.jpg'),
            ],
            (object)[
                'id' => 2,
                'title' => 'UP TO 100% OFF IN MAKING CHARGES',
                'cta_link' => route('shop', ['offer' => 'making-charges']),
                'desktop_image_url' => asset('assets/images/banner_making_charges.jpg'),
                'mobile_image_url' => asset('assets/images/banner_making_charges.jpg'),
            ],
            (object)[
                'id' => 3,
                'title' => 'SOLITAIRE SOIREE - FLAT 10% OFF',
                'cta_link' => route('shop', ['search' => 'solitaire']),
                'desktop_image_url' => asset('assets/images/banner_solitaire_fest.jpg'),
                'mobile_image_url' => asset('assets/images/banner_solitaire_fest.jpg'),
            ],
            (object)[
                'id' => 4,
                'title' => 'ROYAL BRIDAL ATELIER - THE HERITAGE COLLECTION',
                'cta_link' => route('shop', ['collection' => 'heritage']),
                'desktop_image_url' => asset('assets/images/banner_bridal_heritage.jpg'),
                'mobile_image_url' => asset('assets/images/banner_bridal_heritage.jpg'),
            ],
        ]);
    }
@endphp

{{-- ============================================================
     FLIPKART-STYLE HOMEPAGE HERO BANNER CAROUSEL
     - Pixel-perfect recreation of www.flipkart.com hero banner slider
     - Edge-docked curved paddle navigation buttons with drop shadows
     - Bottom pill indicator pagination inside frosted glass capsule
     - 100% responsive aspect ratios tailored for Mobile, Tablet, Laptop & Desktop
     - Full touch swipe gestures with inertia & auto-rotation
     - 100% dynamically manageable via Admin Panel
     ============================================================ --}}
<section id="hero-banner" 
         class="w-full bg-[#f1f2f4] py-1 sm:py-2.5 lg:py-3 select-none overflow-hidden font-sans"
         x-data="{
             currentSlide: 0,
             totalSlides: {{ $banners->count() }},
             autoplayTimer: null,
             autoplaySpeed: 3500,
             isPaused: false,
             touchStartX: 0,
             touchEndX: 0,
             touchStartTime: 0,
             isSwiping: false,
             init() {
                 if (this.totalSlides > 1) {
                     this.startAutoplay();
                 }
             },
             startAutoplay() {
                 this.stopAutoplay();
                 this.autoplayTimer = setInterval(() => {
                     if (!this.isPaused) {
                         this.next();
                     }
                 }, this.autoplaySpeed);
             },
             stopAutoplay() {
                 if (this.autoplayTimer) {
                     clearInterval(this.autoplayTimer);
                     this.autoplayTimer = null;
                 }
             },
             next() {
                 this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
             },
             prev() {
                 this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
             },
             goTo(index) {
                 this.currentSlide = index;
                 this.startAutoplay();
             },
             handleTouchStart(e) {
                 this.touchStartX = e.touches[0].clientX;
                 this.touchStartTime = Date.now();
                 this.isSwiping = true;
                 this.stopAutoplay();
             },
             handleTouchMove(e) {
                 if (!this.isSwiping) return;
                 this.touchEndX = e.touches[0].clientX;
             },
             handleTouchEnd(e) {
                 if (!this.isSwiping) return;
                 this.isSwiping = false;
                 let diff = this.touchStartX - this.touchEndX;
                 let elapsed = Date.now() - this.touchStartTime;
                 // Threshold of 35px within reasonable gesture time
                 if (Math.abs(diff) > 35 && elapsed < 800) {
                     if (diff > 0) {
                         this.next();
                     } else {
                         this.prev();
                     }
                 }
                 this.startAutoplay();
             }
         }"
         @mouseenter="isPaused = true"
         @mouseleave="isPaused = false"
         @touchstart.passive="handleTouchStart($event)"
         @touchmove.passive="handleTouchMove($event)"
         @touchend="handleTouchEnd($event)"
         @keydown.left.window="prev()"
         @keydown.right.window="next()">

    <!-- Responsive Layout Container: Full-bleed on mobile, bordered margin on desktop -->
    <div class="w-full max-w-[1720px] mx-auto px-0 sm:px-3 lg:px-4 relative group">
        
        <!-- Flipkart Main Banner Viewport -->
        <div class="relative overflow-hidden rounded-none sm:rounded-md lg:rounded-lg shadow-xs sm:shadow-sm bg-slate-100 aspect-[16/9] xs:aspect-[16/8.5] sm:aspect-[21/9] md:aspect-[2.4/1] lg:aspect-[2.8/1] xl:aspect-[3.1/1]">
            
            <!-- Slides Track with Butter-Smooth Transform Sliding -->
            <div class="flex h-full w-full transition-transform duration-500 ease-out"
                 :style="`transform: translateX(-${currentSlide * 100}%);`">
                
                @foreach($banners as $index => $banner)
                    @php
                        $desktopImg = $banner->desktop_image_url ?: asset('assets/images/banner_gold_upgrade.jpg');
                        $mobileImg = $banner->mobile_image_url ?: $desktopImg;
                        $ctaUrl = $banner->cta_link ?: route('shop');
                    @endphp

                    <!-- Individual Banner Slide -->
                    <div class="w-full h-full flex-shrink-0 relative overflow-hidden bg-slate-900"
                         aria-roledescription="slide"
                         aria-label="Slide {{ $index + 1 }} of {{ $banners->count() }}">
                        
                        <a href="{{ $ctaUrl }}" 
                           class="block w-full h-full focus:outline-none select-none"
                           title="{{ $banner->title ?? 'Modern Jewellery House Campaign' }}">
                            
                            <picture class="block w-full h-full select-none">
                                @if($banner->mobile_image_url && $banner->mobile_image_url !== $desktopImg)
                                    <source media="(max-width: 640px)" srcset="{{ $banner->mobile_image_url }}">
                                @endif
                                <img src="{{ $desktopImg }}" 
                                     alt="{{ $banner->title ?? 'Campaign Banner' }}" 
                                     loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                     fetchpriority="{{ $index === 0 ? 'high' : 'auto' }}"
                                     decoding="async"
                                     draggable="false"
                                     class="w-full h-full object-cover object-center block select-none pointer-events-none cursor-pointer">
                            </picture>

                        </a>
                    </div>
                @endforeach

            </div>

            <!-- Flipkart-Style Left Paddle Chevron Button (Edge-Docked, Curved Inner Edge) -->
            <button type="button"
                    @click="prev()" 
                    class="hidden sm:flex absolute left-0 top-1/2 -translate-y-1/2 w-9 sm:w-11 lg:w-12 h-20 sm:h-24 lg:h-28 bg-white/95 hover:bg-white text-gray-800 shadow-[0_2px_8px_rgba(0,0,0,0.18)] rounded-r-md items-center justify-center transition-all duration-200 opacity-90 group-hover:opacity-100 hover:scale-[1.02] z-20 focus:outline-none cursor-pointer border-y border-r border-slate-200/90 active:scale-95"
                    aria-label="Previous Banner">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#212121]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <!-- Flipkart-Style Right Paddle Chevron Button (Edge-Docked, Curved Inner Edge) -->
            <button type="button"
                    @click="next()" 
                    class="hidden sm:flex absolute right-0 top-1/2 -translate-y-1/2 w-9 sm:w-11 lg:w-12 h-20 sm:h-24 lg:h-28 bg-white/95 hover:bg-white text-gray-800 shadow-[0_2px_8px_rgba(0,0,0,0.18)] rounded-l-md items-center justify-center transition-all duration-200 opacity-90 group-hover:opacity-100 hover:scale-[1.02] z-20 focus:outline-none cursor-pointer border-y border-l border-slate-200/90 active:scale-95"
                    aria-label="Next Banner">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#212121]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            <!-- Flipkart-Style Bottom Indicators (Elongated Active Capsule + Round Inactive Dots) -->
            @if($banners->count() > 1)
                <div class="absolute bottom-2.5 sm:bottom-4 left-1/2 -translate-x-1/2 z-20 flex items-center gap-1.5 sm:gap-2 px-3 py-1 bg-black/35 backdrop-blur-xs rounded-full shadow-xs">
                    <template x-for="(n, i) in totalSlides" :key="i">
                        <button type="button"
                                @click="goTo(i)" 
                                :class="currentSlide === i ? 'w-6 sm:w-8 bg-white' : 'w-1.5 sm:w-2 bg-white/50 hover:bg-white/80'"
                                class="h-1.5 sm:h-2 rounded-full transition-all duration-300 focus:outline-none cursor-pointer"
                                :aria-label="`Go to slide ${i + 1}`">
                        </button>
                    </template>
                </div>
            @endif

        </div>

    </div>
</section>
