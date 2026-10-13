{{-- ============================================================
     MODERN JEWELLERY HOUSE — INSTAGRAM REELS & SHORTS
     Clean Luxury UI (No extra noisy effects)
     Working Video Playback with Play/Pause & Sound Toggle
     ============================================================ --}}
<section id="insta-shorts-section" 
         x-data="{
             activeReel: null,
             toggleVideo(cardEl) {
                 const video = cardEl.querySelector('video');
                 const playIcon = cardEl.querySelector('.play-indicator-icon');
                 const pauseIcon = cardEl.querySelector('.pause-indicator-icon');
                 const indicator = cardEl.querySelector('.playback-indicator');
                 
                 if (!video) return;

                 if (video.paused) {
                     video.play().then(() => {
                         if (indicator && playIcon && pauseIcon) {
                             playIcon.classList.remove('hidden');
                             pauseIcon.classList.add('hidden');
                             indicator.classList.remove('opacity-0');
                             setTimeout(() => indicator.classList.add('opacity-0'), 600);
                         }
                     }).catch(() => {});
                 } else {
                     video.pause();
                     if (indicator && playIcon && pauseIcon) {
                         playIcon.classList.add('hidden');
                         pauseIcon.classList.remove('hidden');
                         indicator.classList.remove('opacity-0');
                         setTimeout(() => indicator.classList.add('opacity-0'), 600);
                     }
                 }
             },
             toggleSound(btnEl) {
                 const card = btnEl.closest('.reel-card');
                 const video = card ? card.querySelector('video') : null;
                 if (!video) return;

                 video.muted = !video.muted;
                 const mutedIcon = btnEl.querySelector('.sound-muted-icon');
                 const unmutedIcon = btnEl.querySelector('.sound-unmuted-icon');

                 if (video.muted) {
                     mutedIcon.classList.remove('hidden');
                     unmutedIcon.classList.add('hidden');
                 } else {
                     mutedIcon.classList.add('hidden');
                     unmutedIcon.classList.remove('hidden');
                     if (video.paused) video.play();
                 }
             }
         }"
         class="py-12 sm:py-16 bg-white dark:bg-stone-900 border-b border-gray-100 dark:border-white/5 font-sans select-none overflow-hidden">
    
    <div class="max-w-[1700px] mx-auto px-4 sm:px-6 lg:px-8 mb-6 sm:mb-8">
        
        <!-- Clean Luxury Header -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-50 dark:bg-amber-500/10 border border-amber-200 dark:border-amber-500/20 rounded-full mb-2">
                    <svg class="w-3.5 h-3.5 text-amber-600 dark:text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                    <span class="text-[11px] font-bold text-amber-800 dark:text-amber-300">
                        @modernjewelleryhouse &bull; Instagram Reels &amp; Shorts
                    </span>
                </div>
                <h2 class="font-serif text-2xl sm:text-3xl text-slate-900 dark:text-white font-normal tracking-tight">
                    Craftsmanship in Motion
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5 font-light">
                    Watch our certified diamonds catch the light and explore fine jewellery atelier creations.
                </p>
            </div>

            <!-- Follow Button -->
            <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" 
               class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 hover:bg-[#0a2240] dark:bg-white dark:hover:bg-slate-200 text-white dark:text-slate-900 rounded-full text-xs font-semibold shadow-xs transition-all self-start sm:self-auto cursor-pointer">
                <span>Follow on Instagram</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

    </div>

    @php
        $reels = [
            [
                'video' => asset('assets/video/landing-diamond.webm'),
                'img' => asset('assets/images/solitaire_red_velvet.jpg'),
                'title' => 'The Solitaire Glow ✨',
                'caption' => 'Pure fire & brilliance in our certified 1.5ct Solitaire.',
                'likes' => '24.8K',
                'views' => '180K',
                'audio' => 'Original Audio — MJH Atelier',
            ],
            [
                'video' => asset('assets/video/craft-chain.webm'),
                'img' => asset('assets/images/necklace_statement.jpg'),
                'title' => 'Master At Work 👑',
                'caption' => '120 hours of hand-setting Burmese rubies & diamonds.',
                'likes' => '42.1K',
                'views' => '310K',
                'audio' => 'Royal Heritage Theme',
            ],
            [
                'video' => asset('assets/video/landing-diamond.webm'),
                'img' => asset('assets/images/rings_fork.jpg'),
                'title' => 'Stacking Goals 💍',
                'caption' => 'Which one are you choosing? White, yellow, or rose gold?',
                'likes' => '31.5K',
                'views' => '220K',
                'audio' => 'Trending Luxury Audio',
            ],
            [
                'video' => asset('assets/video/craft-chain.webm'),
                'img' => asset('assets/images/earrings_model.jpg'),
                'title' => 'Golden Hour Glow ✨',
                'caption' => 'Chandelier drops catching the sunset light perfectly.',
                'likes' => '19.4K',
                'views' => '145K',
                'audio' => 'Sunset Atelier Beats',
            ],
            [
                'video' => asset('assets/video/landing-diamond.webm'),
                'img' => asset('assets/images/wish_flower_ring.jpg'),
                'title' => 'Blooming Petals 🌸',
                'caption' => 'The WISH floral ring moving in 3D precision.',
                'likes' => '28.9K',
                'views' => '195K',
                'audio' => 'Classical Diamond Strings',
            ],
            [
                'video' => asset('assets/video/craft-chain.webm'),
                'img' => asset('assets/images/curve_gold.jpg'),
                'title' => 'Sculptural Gold 💫',
                'caption' => 'Liquid gold forms inspired by modern architecture.',
                'likes' => '23.6K',
                'views' => '160K',
                'audio' => 'Minimalist Atelier Sound',
            ],
        ];
        
        $carouselReels = array_merge($reels, $reels);
    @endphp

    <!-- Clean Video Marquee Track -->
    <div class="w-full overflow-hidden py-2 relative">
        <div class="flex gap-4 sm:gap-5 animate-reel-rtl hover:[animation-play-state:paused] w-max select-none">
            @foreach($carouselReels as $reel)
                <div @click="toggleVideo($el)"
                     class="reel-card group relative w-[190px] sm:w-[220px] md:w-[240px] aspect-[9/16] rounded-2xl overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 flex-shrink-0 cursor-pointer border border-gray-200 dark:border-white/10 bg-black">
                    
                    <!-- Clean Video Player -->
                    <video loop 
                           muted 
                           playsinline 
                           autoplay
                           preload="metadata"
                           poster="{{ $reel['img'] }}"
                           class="w-full h-full object-cover object-center group-hover:scale-102 transition-transform duration-500">
                        <source src="{{ $reel['video'] }}" type="video/webm">
                    </video>
                    
                    <!-- Bottom Dark Vignette for Text Contrast -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-black/30 pointer-events-none"></div>

                    <!-- Centered Play/Pause Feedback Indicator -->
                    <div class="playback-indicator absolute inset-0 flex items-center justify-center pointer-events-none opacity-0 transition-opacity duration-300 z-30">
                        <div class="w-12 h-12 rounded-full bg-black/60 backdrop-blur-md flex items-center justify-center text-white shadow-lg">
                            <svg class="play-indicator-icon w-6 h-6 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                            <svg class="pause-indicator-icon w-6 h-6 text-white hidden" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Top Bar: Views Badge & Sound Toggle -->
                    <div class="absolute top-3 left-3 right-3 flex items-center justify-between text-white text-[10px] font-medium z-20">
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-black/50 backdrop-blur-md border border-white/15 text-white/90">
                            <span>{{ $reel['views'] }} views</span>
                        </span>

                        <!-- Sound Toggle Button -->
                        <button type="button" 
                                @click.stop="toggleSound($el)" 
                                class="w-7 h-7 rounded-full bg-black/60 backdrop-blur-md border border-white/20 text-white flex items-center justify-center hover:bg-black/90 active:scale-95 transition-all shadow-md focus:outline-none cursor-pointer"
                                title="Toggle Sound">
                            <!-- Muted Icon -->
                            <svg class="w-3.5 h-3.5 sound-muted-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/>
                            </svg>
                            <!-- Unmuted Icon -->
                            <svg class="w-3.5 h-3.5 sound-unmuted-icon hidden text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Bottom Details: Handle, Caption & Likes -->
                    <div class="absolute bottom-3 left-3 right-3 text-white z-10 pointer-events-none">
                        <span class="block text-[10.5px] font-bold text-amber-300 mb-0.5">
                            @modernjewelleryhouse
                        </span>

                        <p class="text-[11px] text-white/95 font-medium line-clamp-2 leading-snug mb-2">
                            {{ $reel['caption'] }}
                        </p>

                        <div class="flex items-center justify-between text-[10px] text-white/70 pt-1.5 border-t border-white/10">
                            <span class="flex items-center gap-1 text-rose-300">
                                ♥ {{ $reel['likes'] }}
                            </span>
                            <span class="text-[9.5px] truncate max-w-[100px] text-gray-300">
                                {{ $reel['audio'] }}
                            </span>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>

</section>

<!-- Smooth Continuous Marquee Animation -->
<style>
    @keyframes reelScrollRtl {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }

    .animate-reel-rtl {
        animation: reelScrollRtl 50s linear infinite;
        will-change: transform;
    }

    @media (max-width: 640px) {
        .animate-reel-rtl {
            animation-duration: 35s;
        }
    }
</style>
