@php
    $primaryImg = $product->primaryImage ? $product->primaryImage->url : asset('assets/images/hero-luxury.jpg');
    $allImages = $product->images;
    if ($allImages->isEmpty() && $product->primaryImage) {
        $allImages = collect([$product->primaryImage]);
    }
    $primaryImgUrl = $primaryImg;
    $has3d = $product->has_3d_model;
    $modelUrl = $product->model_3d_url;
    $modelProvider = $product->model_3d_provider;
    $isRenderMyJewelry = $product->is_render_my_jewelry;
    $badge = $product->effective_badge;

    $modelSettings = $product->model_3d_settings;
    $rmjAutorotate = $modelSettings['autorotate'] ?? true;
    $rmjSpeed = $modelSettings['speed'] ?? 'slow';
    $rmjShowColors = $modelSettings['show_colors'] ?? true;
    $rmjDefaultColor = $modelSettings['default_color'] ?? 'yellow';
    $rmjBg = $modelSettings['bg_color'] ?? '#0d0d0f';
    $rmjSmoothness = $modelSettings['smoothness'] ?? 'ultra';

    $cleanModelUrl = $modelUrl;
    if ($cleanModelUrl && preg_match('/src=[\"\']([^\"\']+)[\"\']/i', $cleanModelUrl, $matches)) {
        $cleanModelUrl = $matches[1];
    }

    $sizes = $product->available_sizes ?: ['14', '16', '18', '20'];
    $outOfStockSize = '20'; // Example out-of-stock size to demonstrate disabled state
@endphp

<x-layouts.app 
    :title="$product->meta_title ?: $product->name . ' | Modern Jewellery House'"
    :description="$product->meta_description ?: $product->short_description"
    :canonical="route('products.show', $product->slug)"
    :ogTitle="$product->name . ' | Haute Joaillerie'"
    :ogDescription="$product->short_description"
    :ogImage="$primaryImgUrl"
    ogType="product"
    :preloadImage="$primaryImgUrl"
    :schemaJsonLd="$schemaJsonLd">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10"
         x-data="productDetailGallery({
            totalSlides: {{ $allImages->count() + ($product->videos->count() > 0 ? 1 : 0) }},
            totalPhotos: {{ $allImages->count() }},
            has3d: {{ $has3d ? 'true' : 'false' }},
            isRenderMyJewelry: {{ $isRenderMyJewelry ? 'true' : 'false' }},
            modelUrl: '{{ addslashes($cleanModelUrl) }}',
            modelProvider: '{{ $modelProvider }}',
            rmjAutorotate: {{ $rmjAutorotate ? 'true' : 'false' }},
            rmjSpeed: '{{ $rmjSpeed }}',
            rmjShowColors: {{ $rmjShowColors ? 'true' : 'false' }},
            rmjDefaultColor: '{{ $rmjDefaultColor }}',
            rmjBg: '{{ $rmjBg }}',
            rmjSmoothness: '{{ $rmjSmoothness }}',
            productId: {{ $product->id }},
            productSlug: '{{ $product->slug }}',
            productName: '{{ addslashes($product->name) }}',
            productPrice: '{{ $product->formatted_price }}',
            productImage: '{{ $primaryImgUrl }}'
         })"
         x-init="initProduct()">

        <!-- Breadcrumbs -->
        <div class="mb-6">
            <x-breadcrumbs :items="[
                ['label' => 'Catalogue', 'url' => route('shop')],
                ['label' => $product->category->name ?? 'Fine Jewellery', 'url' => route('shop', ['category' => $product->category->slug ?? ''])],
                ['label' => $product->name]
            ]" />
        </div>

        <!-- Main Product Split Layout -->
        <!-- Desktop: 58% Gallery on Left | 42% Information on Right (Sticky) -->
        <!-- Mobile: Gallery First | Information Below -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
            
            <!-- LEFT: Product Media & Editorial Gallery (Col 1 to 7) -->
            <div class="lg:col-span-7 flex flex-col gap-3">
                
                <!-- Gallery Mode Switcher Bar (Photos | 360° Studio | Video) -->
                <div class="flex items-center justify-between px-1">
                    <div class="inline-flex items-center bg-[#F4F1EA] dark:bg-stone-800/80 p-1 rounded-full border border-border-subtle shadow-xs">
                        <button type="button" 
                                @click="switchGalleryMode('photos')"
                                :class="activeMode === 'photos' ? 'bg-noir text-ivory shadow-sm' : 'text-charcoal-muted hover:text-charcoal dark:text-stone-300 dark:hover:text-white'"
                                class="px-3.5 py-1.5 rounded-full text-[11px] font-sans uppercase tracking-[0.16em] transition-all duration-200 flex items-center space-x-1.5 cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Photos ({{ $allImages->count() }})</span>
                        </button>

                        @if($has3d)
                            <button type="button" 
                                    @click="switchGalleryMode('360')"
                                    :class="activeMode === '360' ? 'bg-[#996515] text-white shadow-sm' : 'text-charcoal-muted hover:text-charcoal dark:text-stone-300 dark:hover:text-white'"
                                    class="px-3.5 py-1.5 rounded-full text-[11px] font-sans uppercase tracking-[0.16em] transition-all duration-200 flex items-center space-x-1.5 cursor-pointer group">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                <svg class="w-3.5 h-3.5 text-gold-light group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                <span class="font-medium">360° Studio</span>
                            </button>
                        @endif

                        @if($product->videos->count() > 0)
                            <button type="button" 
                                    @click="switchGalleryMode('video')"
                                    :class="activeMode === 'video' ? 'bg-noir text-ivory shadow-sm' : 'text-charcoal-muted hover:text-charcoal dark:text-stone-300 dark:hover:text-white'"
                                    class="px-3.5 py-1.5 rounded-full text-[11px] font-sans uppercase tracking-[0.16em] transition-all duration-200 flex items-center space-x-1.5 cursor-pointer">
                                <svg class="w-3.5 h-3.5 text-gold" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                                <span>Video</span>
                            </button>
                        @endif
                    </div>

                    <!-- Right helper badge -->
                    <div class="hidden sm:flex items-center text-[10px] text-charcoal-muted dark:text-stone-400 tracking-wider uppercase font-light">
                        <template x-if="activeMode === '360'">
                            <span class="text-gold-dark font-medium flex items-center space-x-1">
                                <svg class="w-3 h-3 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                                </svg>
                                <span>360° Interactive Canvas</span>
                            </span>
                        </template>
                        <template x-if="activeMode === 'photos'">
                            <span x-text="'Slide ' + (activeSlide + 1) + ' of ' + totalPhotos"></span>
                        </template>
                        <template x-if="activeMode === 'video'">
                            <span>Atelier Cinema</span>
                        </template>
                    </div>
                </div>

                <!-- Gallery Main Row: Thumbnails + Viewport Stage -->
                <div class="flex flex-col-reverse md:flex-row gap-4 sm:gap-6">
                    
                    <!-- Vertical Thumbnail Strip (Desktop & Tablet) -->
                    @if($allImages->count() > 1 || $product->videos->count() > 0 || $has3d)
                        <div class="flex md:flex-col gap-3 overflow-x-auto md:overflow-y-auto no-scrollbar py-2 md:py-0 w-full md:w-20 lg:w-24 flex-shrink-0 order-2 md:order-1">
                            @foreach($allImages as $idx => $img)
                                <button type="button" 
                                        @click="goToSlide({{ $idx }})"
                                        :class="activeMode === 'photos' && activeSlide === {{ $idx }} ? 'border-charcoal ring-2 ring-gold/70 opacity-100 shadow-sm' : 'border-border-subtle opacity-70 hover:opacity-100'"
                                        class="relative aspect-square w-16 md:w-full bg-[#F7F5F0] border transition-all duration-200 overflow-hidden flex-shrink-0 cursor-pointer group">
                                    <img src="{{ $img->url }}" 
                                         alt="{{ $product->name }} thumb {{ $idx + 1 }}" 
                                         loading="lazy"
                                         class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-200">
                                    <span class="absolute bottom-0.5 right-1 text-[8px] font-mono text-charcoal/70 bg-white/80 px-1 rounded-xs">{{ $idx + 1 }}</span>
                                </button>
                            @endforeach

                            <!-- 360° Studio Dedicated Thumbnail Trigger -->
                            @if($has3d)
                                <button type="button" 
                                        @click="switchGalleryMode('360')"
                                        :class="activeMode === '360' ? 'border-[#996515] ring-2 ring-gold bg-gradient-to-br from-stone-900 to-black text-amber-200 shadow-md' : 'border-gold/40 bg-gradient-to-br from-[#1F1E1D] to-[#121212] text-stone-300 hover:border-gold hover:text-white opacity-90 hover:opacity-100'"
                                        class="relative aspect-square w-16 md:w-full border transition-all duration-200 overflow-hidden flex-shrink-0 flex flex-col items-center justify-center cursor-pointer shadow-xs group"
                                        title="Experience 360° Interactive Studio">
                                    <span class="absolute top-1 right-1 w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                    <svg class="w-6 h-6 text-gold group-hover:scale-115 group-hover:rotate-45 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    <span class="text-[9px] font-serif font-bold uppercase tracking-wider text-amber-300 mt-0.5">360°</span>
                                    <span class="text-[7px] uppercase tracking-widest text-amber-100/70 font-sans">Studio</span>
                                </button>
                            @endif

                            <!-- Video Thumbnail Trigger if exists -->
                            @if($product->videos->count() > 0)
                                <button type="button" 
                                        @click="switchGalleryMode('video')"
                                        :class="activeMode === 'video' ? 'border-charcoal ring-2 ring-gold/70 opacity-100 shadow-sm' : 'border-border-subtle opacity-70 hover:opacity-100'"
                                        class="relative aspect-square w-16 md:w-full bg-[#1A1A1A] text-ivory border transition-all duration-200 overflow-hidden flex-shrink-0 flex flex-col items-center justify-center cursor-pointer group">
                                    <svg class="w-6 h-6 text-gold group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                    <span class="text-[8px] uppercase tracking-wider font-sans mt-0.5">Video</span>
                                </button>
                            @endif
                        </div>
                    @endif

                    <!-- Main Viewport Area (Swipe on mobile, Zoom on desktop, 360 Studio in Stage) -->
                    <div class="flex-1 relative order-1 md:order-2">
                        <div class="relative w-full aspect-[4/5] bg-[#F7F5F0] dark:bg-stone-900 border border-border-subtle overflow-hidden select-none"
                             @touchstart="touchStart($event)"
                             @touchend="touchEnd($event)"
                             @mousemove="handleZoomMove($event)"
                             @mouseleave="handleZoomLeave()"
                             id="main-product-stage">
                            
                            <!-- Badges -->
                            <div class="absolute top-4 left-4 z-20 flex flex-col gap-2 pointer-events-none">
                                <template x-if="activeMode !== '360'">
                                    <div class="flex flex-col gap-2">
                                        @if($badge)
                                            <span class="bg-noir text-ivory text-[9px] uppercase tracking-[0.25em] px-3 py-1 font-medium shadow-sm">
                                                {{ $badge }}
                                            </span>
                                        @endif
                                        @if($product->certification)
                                            <span class="bg-ivory/95 border border-border-subtle text-charcoal text-[9px] uppercase tracking-[0.2em] px-2.5 py-1 backdrop-blur-sm">
                                                Certified
                                            </span>
                                        @endif
                                    </div>
                                </template>
                                <template x-if="activeMode === '360'">
                                    <div class="flex flex-col gap-1.5">
                                        <span class="bg-[#996515] text-white text-[9px] uppercase tracking-[0.25em] px-3 py-1 font-medium shadow-sm flex items-center space-x-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                            <span>360° Studio</span>
                                        </span>
                                    </div>
                                </template>
                            </div>

                            <!-- Stage Action Controls (Top Right) -->
                            <div class="absolute top-4 right-4 z-20 flex items-center space-x-2">
                                <!-- When in Photos mode: 3D button + Lightbox -->
                                <template x-if="activeMode === 'photos'">
                                    <div class="flex items-center space-x-2">
                                        @if($has3d)
                                            <button type="button" 
                                                    @click="switchGalleryMode('360')"
                                                    class="inline-flex items-center space-x-1.5 px-3 py-1.5 bg-ivory/90 hover:bg-ivory text-charcoal text-[10px] uppercase tracking-[0.2em] font-medium border border-border-subtle shadow-sm backdrop-blur-sm transition-all duration-200 hover:border-gold cursor-pointer"
                                                    aria-label="View 360 Studio">
                                                <svg class="w-3.5 h-3.5 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                </svg>
                                                <span>360° VIEW</span>
                                            </button>
                                        @endif

                                        <button type="button" 
                                                @click="openLightbox()"
                                                class="p-2 bg-ivory/90 hover:bg-ivory text-charcoal rounded-full border border-border-subtle shadow-sm backdrop-blur-sm transition-colors cursor-pointer"
                                                title="Fullscreen Photo View"
                                                aria-label="Fullscreen Photo View">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 8V4m0 0h4M4 4l5 5m11-5h-4m4 0v4m0-4l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                                            </svg>
                                        </button>
                                    </div>
                                </template>

                                <!-- When in 360 mode: Return to Photos -->
                                <template x-if="activeMode === '360'">
                                    <div class="flex items-center space-x-1.5">
                                        <button type="button" 
                                                @click="switchGalleryMode('photos')"
                                                class="inline-flex items-center space-x-1 px-3 py-1.5 bg-black/75 hover:bg-black text-ivory text-[10px] uppercase tracking-[0.2em] font-medium border border-white/20 shadow-sm backdrop-blur-sm transition-all cursor-pointer">
                                            <span>Photos</span>
                                        </button>
                                    </div>
                                </template>
                            </div>

                            <!-- SLIDE CONTAINER 1: PHOTOS -->
                            <div x-show="activeMode === 'photos'" class="w-full h-full relative">
                                @foreach($allImages as $idx => $img)
                                    <div x-show="activeSlide === {{ $idx }}" 
                                         x-transition:enter="transition-opacity ease-out duration-300"
                                         x-transition:enter-start="opacity-0"
                                         x-transition:enter-end="opacity-100"
                                         class="w-full h-full absolute inset-0 flex items-center justify-center">
                                        <img src="{{ $img->url }}" 
                                             alt="{{ $product->name }} view {{ $idx + 1 }}" 
                                             @if($idx === 0) fetchpriority="high" @else loading="lazy" @endif
                                             id="zoom-image-{{ $idx }}"
                                             class="w-full h-full object-cover object-center transition-transform duration-100 ease-out cursor-zoom-in"
                                             :style="isZooming && activeSlide === {{ $idx }} ? 'transform: scale(2.2); transform-origin: ' + zoomOrigin : ''">
                                    </div>
                                @endforeach

                                <!-- Navigation Arrows for Photos -->
                                <button type="button" 
                                        @click="prevSlide()"
                                        class="absolute left-3 top-1/2 -translate-y-1/2 p-2 bg-ivory/80 hover:bg-ivory text-charcoal rounded-full border border-border-subtle shadow-sm transition-all duration-200 opacity-0 group-hover:opacity-100 hover:scale-105 cursor-pointer"
                                        aria-label="Previous Slide">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </button>
                                <button type="button" 
                                        @click="nextSlide()"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 p-2 bg-ivory/80 hover:bg-ivory text-charcoal rounded-full border border-border-subtle shadow-sm transition-all duration-200 opacity-0 group-hover:opacity-100 hover:scale-105 cursor-pointer"
                                        aria-label="Next Slide">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>

                                <!-- Mobile Slide Indicator Dots for Photos -->
                                <div class="absolute bottom-4 inset-x-0 flex justify-center space-x-1.5 md:hidden z-20">
                                    @for($i = 0; $i < $allImages->count(); $i++)
                                        <span class="h-1.5 rounded-full transition-all duration-300"
                                              :class="activeSlide === {{ $i }} ? 'w-5 bg-charcoal' : 'w-1.5 bg-charcoal/30'"></span>
                                    @endfor
                                </div>
                            </div>

                            <!-- SLIDE CONTAINER 2: VIDEO -->
                            @if($product->videos->count() > 0)
                                @php $vid = $product->videos->first(); @endphp
                                <div x-show="activeMode === 'video'" 
                                     class="w-full h-full absolute inset-0 bg-black flex items-center justify-center">
                                    <video controls playsinline class="w-full h-full object-cover">
                                        <source src="{{ asset($vid->video_path) }}" type="video/mp4">
                                        Your browser does not support high luxury video playback.
                                    </video>
                                </div>
                            @endif

                            <!-- SLIDE CONTAINER 3: 360° INTERACTIVE STUDIO & 3D VIEWER -->
                            @if($has3d)
                                <div x-show="activeMode === '360'" 
                                     id="rmj-360-stage"
                                     class="w-full h-full absolute inset-0 flex items-center justify-center overflow-hidden select-none group"
                                     style="background-color: {{ $rmjBg }};">
                                    
                                    @if($isRenderMyJewelry || (!str_ends_with(strtolower(parse_url($cleanModelUrl, PHP_URL_PATH) ?? ''), '.glb') && !str_ends_with(strtolower(parse_url($cleanModelUrl, PHP_URL_PATH) ?? ''), '.gltf')))
                                        <iframe id="rmj-360-iframe"
                                                src="{{ $cleanModelUrl }}"
                                                class="w-full h-full border-0 select-none transition-opacity duration-300"
                                                allow="accelerometer; gyroscope; fullscreen; xr-spatial-tracking; autoplay"
                                                title="{{ $product->name }} 360 View">
                                        </iframe>
                                    @else
                                        <div id="model-stage-host" class="w-full h-full"></div>
                                    @endif

                                    <!-- LUXURY 360 HUD CONTROLLERS OVERLAY -->
                                    <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between pointer-events-none z-30">
                                        
                                        <!-- Left: Interactive Metal Color Swatches (Render My Jewelry Swatches) -->
                                        @if($rmjShowColors)
                                            <div class="pointer-events-auto flex items-center gap-1.5 p-1 rounded-full bg-black/75 backdrop-blur-md border border-white/20 shadow-lg">
                                                <button type="button" 
                                                        @click="changeColor('yellow')"
                                                        :class="currentMetal === 'yellow' ? 'ring-2 ring-amber-400 scale-110' : 'opacity-70 hover:opacity-100'"
                                                        class="w-6 h-6 rounded-full bg-gradient-to-br from-amber-300 via-amber-400 to-amber-600 transition-all shadow-xs cursor-pointer"
                                                        title="18K Yellow Gold">
                                                </button>
                                                <button type="button" 
                                                        @click="changeColor('white')"
                                                        :class="currentMetal === 'white' ? 'ring-2 ring-white scale-110' : 'opacity-70 hover:opacity-100'"
                                                        class="w-6 h-6 rounded-full bg-gradient-to-br from-slate-100 via-gray-300 to-slate-400 transition-all shadow-xs cursor-pointer"
                                                        title="18K White Gold / Platinum">
                                                </button>
                                                <button type="button" 
                                                        @click="changeColor('rose')"
                                                        :class="currentMetal === 'rose' ? 'ring-2 ring-rose-400 scale-110' : 'opacity-70 hover:opacity-100'"
                                                        class="w-6 h-6 rounded-full bg-gradient-to-br from-rose-300 via-rose-400 to-rose-500 transition-all shadow-xs cursor-pointer"
                                                        title="18K Rose Gold">
                                                </button>
                                            </div>
                                        @else
                                            <div></div>
                                        @endif

                                        <!-- Right: Motion Controls (Spin, Reset, Fullscreen) -->
                                        <div class="pointer-events-auto flex items-center gap-1.5 p-1 rounded-full bg-black/75 backdrop-blur-md border border-white/20 shadow-lg text-white text-xs">
                                            
                                            <!-- Spin Toggle Button -->
                                            <button type="button" 
                                                    @click="toggleSpin()" 
                                                    class="w-7 h-7 rounded-full flex items-center justify-center hover:bg-white/20 transition-all cursor-pointer"
                                                    :title="isSpinning ? 'Pause Rotation' : 'Auto Rotate'">
                                                <svg x-show="isSpinning" class="w-3.5 h-3.5 text-amber-300 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="animation-duration: 8s;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                </svg>
                                                <svg x-show="!isSpinning" class="w-3.5 h-3.5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                </svg>
                                            </button>

                                            <!-- Reset Camera Button -->
                                            <button type="button" 
                                                    @click="resetView()" 
                                                    class="w-7 h-7 rounded-full flex items-center justify-center hover:bg-white/20 transition-all text-white/80 hover:text-white cursor-pointer"
                                                    title="Reset Front View">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                                                </svg>
                                            </button>

                                            <!-- Fullscreen Button -->
                                            <button type="button" 
                                                    @click="toggleFullscreen()" 
                                                    class="w-7 h-7 rounded-full flex items-center justify-center hover:bg-white/20 transition-all text-white/80 hover:text-white cursor-pointer"
                                                    title="Fullscreen Studio">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-5h-4m4 0v4m0-4l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                                                </svg>
                                            </button>
                                        </div>

                                    </div>

                                    <!-- Floating 360 User Hint Badge -->
                                    <div x-show="show3dHint" 
                                         x-transition:leave="transition-opacity duration-500"
                                         x-transition:leave-start="opacity-100"
                                         x-transition:leave-end="opacity-0"
                                         class="absolute top-4 inset-x-0 flex justify-center pointer-events-none z-20">
                                        <div class="px-3 py-1 rounded-full bg-black/60 backdrop-blur-md border border-white/20 text-white text-[10px] font-sans tracking-wider uppercase flex items-center gap-1.5 shadow-lg">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                            <span>360° Studio &bull; Drag to Rotate</span>
                                        </div>
                                    </div>

                                </div>
                            @endif

                        </div>

                        <!-- Editorial Caption under Image / Stage -->
                        <div class="flex items-center justify-between text-[11px] text-charcoal-muted dark:text-stone-400 font-light pt-2.5">
                            <span class="flex items-center space-x-1">
                                <svg class="w-3.5 h-3.5 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
                                </svg>
                                <span x-show="activeMode === 'photos'">Hover or tap image to inspect lapidary details</span>
                                <span x-show="activeMode === '360'">360° Interactive Studio • Click &amp; drag to inspect from any angle</span>
                                <span x-show="activeMode === 'video'">High Definition Cinematic Showcase</span>
                            </span>
                            <span>SKU: {{ $product->sku }}</span>
                        </div>
                    </div>

                </div>

                <!-- Product Description Expandable Accordion (Desktop View: Placed Below Product Images) -->
                <div class="hidden lg:block border border-border-subtle bg-white dark:bg-stone-900 rounded-2xl divide-y divide-border-subtle/70 overflow-hidden shadow-xs mt-6" 
                     x-data="{ openSection: 'story' }">
                    
                    <!-- 1. STORY & DESIGN DETAILS -->
                    <div class="p-4 sm:p-5">
                        <button type="button" 
                                @click="openSection = (openSection === 'story' ? '' : 'story')"
                                class="w-full flex items-center justify-between text-left text-xs uppercase tracking-[0.18em] font-medium text-charcoal dark:text-ivory hover:text-gold-dark transition-colors cursor-pointer">
                            <span class="flex items-center gap-2">
                                <span class="text-gold-dark text-sm">✦</span>
                                <span>Design Inspiration &amp; Details</span>
                            </span>
                            <svg class="w-4 h-4 text-charcoal-muted transform transition-transform duration-200" :class="openSection === 'story' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="openSection === 'story'" x-transition class="mt-3.5 text-xs text-charcoal-muted dark:text-stone-300 leading-relaxed font-light">
                            <p class="whitespace-pre-line">{{ $product->description ?: $product->short_description }}</p>
                        </div>
                    </div>

                    <!-- 2. CRAFTSMANSHIP & HALLMARKING -->
                    <div class="p-4 sm:p-5">
                        <button type="button" 
                                @click="openSection = (openSection === 'craft' ? '' : 'craft')"
                                class="w-full flex items-center justify-between text-left text-xs uppercase tracking-[0.18em] font-medium text-charcoal dark:text-ivory hover:text-gold-dark transition-colors cursor-pointer">
                            <span class="flex items-center gap-2">
                                <span class="text-gold-dark text-sm">✦</span>
                                <span>Master Craftsmanship &amp; SKU</span>
                            </span>
                            <svg class="w-4 h-4 text-charcoal-muted transform transition-transform duration-200" :class="openSection === 'craft' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="openSection === 'craft'" x-transition class="mt-3.5 text-xs text-charcoal-muted dark:text-stone-300 leading-relaxed space-y-2 font-light">
                            <p>&bull; Individually handcrafted by master lapidaries with microscopic prong seating.</p>
                            <p>&bull; Official BIS Hallmark purity guarantee stamped on inner gallery.</p>
                            <p>&bull; Accompanied by official laboratory certificate of authenticity.</p>
                            <p>&bull; Atelier SKU Code: <span class="font-mono text-charcoal dark:text-ivory font-medium">{{ $product->sku }}</span></p>
                        </div>
                    </div>

                    <!-- 3. CARE & LONGEVITY -->
                    <div class="p-4 sm:p-5">
                        <button type="button" 
                                @click="openSection = (openSection === 'care' ? '' : 'care')"
                                class="w-full flex items-center justify-between text-left text-xs uppercase tracking-[0.18em] font-medium text-charcoal dark:text-ivory hover:text-gold-dark transition-colors cursor-pointer">
                            <span class="flex items-center gap-2">
                                <span class="text-gold-dark text-sm">✦</span>
                                <span>Precious Metal Care</span>
                            </span>
                            <svg class="w-4 h-4 text-charcoal-muted transform transition-transform duration-200" :class="openSection === 'care' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="openSection === 'care'" x-transition class="mt-3.5 text-xs text-charcoal-muted dark:text-stone-300 leading-relaxed space-y-2 font-light">
                            <p>To preserve scintillation, gently clean with lukewarm soapy water and our provided suede cloth.</p>
                            <p>Includes complimentary lifetime ultrasonic cleaning and prong re-tightening at Modern Jewellery House salons.</p>
                        </div>
                    </div>

                    <!-- 4. INSURED TRANSIT & RETURNS -->
                    <div class="p-4 sm:p-5">
                        <button type="button" 
                                @click="openSection = (openSection === 'transit' ? '' : 'transit')"
                                class="w-full flex items-center justify-between text-left text-xs uppercase tracking-[0.18em] font-medium text-charcoal dark:text-ivory hover:text-gold-dark transition-colors cursor-pointer">
                            <span class="flex items-center gap-2">
                                <span class="text-gold-dark text-sm">✦</span>
                                <span>Insured Delivery &amp; 30-Day Returns</span>
                            </span>
                            <svg class="w-4 h-4 text-charcoal-muted transform transition-transform duration-200" :class="openSection === 'transit' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="openSection === 'transit'" x-transition class="mt-3.5 text-xs text-charcoal-muted dark:text-stone-300 leading-relaxed space-y-2 font-light">
                            <p>&bull; <strong>100% Free Armored Transit:</strong> Fully insured discrete shipment with security tamper seals.</p>
                            <p>&bull; <strong>30-Day Return Privilege:</strong> Exchange or refund with complimentary courier pickup.</p>
                            <p>&bull; <strong>Prompt Dispatch:</strong> Meticulously prepared and dispatched within 24 to 48 business hours.</p>
                        </div>
                    </div>

                </div>

            </div>

            <!-- RIGHT: Product Information & Purchase Atelier (Col 8 to 12) -->
            <div class="lg:col-span-5 flex flex-col space-y-6 lg:sticky lg:top-28">
                
                <!-- Category & Title -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] uppercase tracking-[0.28em] text-gold-dark font-medium">
                            {{ $product->category->name ?? 'Fine Jewellery Atelier' }}
                        </span>

                        <!-- Reviews Rating -->
                        <a href="#reviews-section" 
                           class="flex items-center space-x-1.5 text-xs group cursor-pointer hover:opacity-80 transition-opacity">
                            <div class="flex text-amber-500 text-xs">
                                ★★★★★
                            </div>
                            <span class="text-[11px] text-charcoal font-semibold">{{ $product->average_rating }}</span>
                            <span class="text-[10px] text-charcoal-muted group-hover:text-gold-dark group-hover:underline">
                                ({{ $product->reviews->count() > 0 ? $product->reviews->count() . ' reviews' : 'Write Review' }})
                            </span>
                        </a>
                    </div>

                    <h1 class="font-serif text-2xl sm:text-3xl lg:text-4xl text-charcoal font-normal tracking-tight leading-tight mb-2">
                        {{ $product->name }}
                    </h1>

                    @if($product->tagline)
                        <p class="text-xs sm:text-sm text-charcoal-muted italic font-serif">
                            “{{ $product->tagline }}”
                        </p>
                    @endif
                </div>

                <!-- Price Area -->
                <div class="border-y border-border-subtle/80 py-4">
                    <div class="flex items-baseline space-x-3">
                        <span class="font-serif text-2xl sm:text-3xl text-charcoal font-normal">
                            {{ $product->formatted_price }}
                        </span>
                        @if($product->compare_at_price && $product->compare_at_price > $product->base_price)
                            <span class="text-sm text-charcoal-muted line-through font-light">
                                {{ $product->formatted_compare_price }}
                            </span>
                            <span class="text-xs text-[#8A3324] font-medium tracking-wider uppercase">
                                Save {{ $product->discount_percent }}%
                            </span>
                        @endif
                    </div>
                    <p class="text-[11px] text-charcoal-muted font-light mt-1.5 flex items-center space-x-1">
                        <svg class="w-3.5 h-3.5 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>Includes insured white-glove courier, authenticity dossier & velvet presentation case.</span>
                    </p>
                </div>

                <!-- Short Editorial Narrative -->
                @if($product->short_description)
                    <p class="text-xs sm:text-sm text-charcoal-muted leading-relaxed font-light">
                        {{ $product->short_description }}
                    </p>
                @endif

                <!-- Purchase Configuration Form -->
                <form action="{{ route('cart.store') }}" 
                      method="POST" 
                      id="add-to-bag-form"
                      @submit="handleAddToBag($event)"
                      class="space-y-6 pt-2">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="size" :value="selectedSize">

                    <!-- Size Selection -->
                    @if(!empty($sizes))
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-[11px] uppercase tracking-[0.2em] font-medium text-charcoal">
                                    Select Size:
                                </label>
                                <button type="button" 
                                        @click="sizeGuideModal = true" 
                                        class="text-[10px] uppercase tracking-wider text-charcoal-muted underline hover:text-gold-dark transition-colors">
                                    Size Guide
                                </button>
                            </div>

                            <div class="grid grid-cols-4 gap-2.5">
                                @foreach($sizes as $sizeOption)
                                    @php
                                        // Demo: if size equals '20', it's unavailable to satisfy requirements
                                        $isUnavailable = ($sizeOption == $outOfStockSize);
                                    @endphp
                                    <button type="button" 
                                            @if($isUnavailable) disabled @else @click="selectedSize = '{{ $sizeOption }}'" @endif
                                            :class="{
                                                'border-charcoal bg-ivory text-charcoal ring-1 ring-charcoal font-semibold': selectedSize === '{{ $sizeOption }}' && !{{ $isUnavailable ? 'true' : 'false' }},
                                                'border-border-subtle bg-ivory-light text-charcoal hover:border-charcoal': selectedSize !== '{{ $sizeOption }}' && !{{ $isUnavailable ? 'true' : 'false' }},
                                                'opacity-40 bg-gray-100 cursor-not-allowed line-through text-charcoal-muted border-border-subtle': {{ $isUnavailable ? 'true' : 'false' }}
                                            }"
                                            class="py-3 px-2 text-center text-xs tracking-wider uppercase border transition-all duration-200 relative group"
                                            title="{{ $isUnavailable ? 'Size unavailable — Contact Atelier' : 'Size ' . $sizeOption }}">
                                        <span>{{ $sizeOption }}</span>
                                        @if($isUnavailable)
                                            <span class="block text-[8px] text-[#8A3324] uppercase tracking-tighter mt-0.5">Out of Stock</span>
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                            <p class="text-[10px] text-charcoal-muted font-light mt-1.5" x-show="selectedSize">
                                Selected Atelier Size: <span class="font-medium text-charcoal" x-text="selectedSize"></span>
                            </p>
                        </div>
                    @endif

                    <!-- Complimentary Atelier Engraving -->
                    <div>
                        <label for="custom_engraving" class="block text-[10px] uppercase tracking-[0.2em] font-medium text-charcoal mb-1.5">
                            Complimentary Atelier Engraving (Optional):
                        </label>
                        <input type="text" 
                               name="custom_engraving" 
                               id="custom_engraving"
                               maxlength="30"
                               placeholder="e.g. Initials or Date (Up to 30 characters)"
                               class="w-full bg-ivory border border-border-subtle px-4 py-2.5 text-xs tracking-wider text-charcoal placeholder:text-charcoal-muted/50 focus:outline-none focus:border-charcoal">
                    </div>

                    <!-- Call To Action Buttons (ADD TO BAG & BUY NOW) -->
                    <div class="space-y-3 pt-2">
                        <!-- Primary: ADD TO BAG with subtle success animation -->
                        <button type="submit" 
                                :disabled="addingToBag"
                                class="w-full btn-luxury-primary text-xs tracking-[0.22em] py-4 relative overflow-hidden transition-all duration-300">
                            <span x-show="!addedSuccess">ADD TO BAG</span>
                            <span x-show="addedSuccess" class="inline-flex items-center space-x-2 text-gold">
                                <svg class="w-4 h-4 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>ADDED TO BAG</span>
                            </span>
                        </button>

                        <!-- Secondary: BUY NOW & WISHLIST ROW -->
                        <div class="flex items-center space-x-3">
                            <button type="button" 
                                    @click="handleBuyNow()"
                                    class="flex-1 py-3.5 px-4 bg-ivory border border-charcoal text-xs uppercase tracking-[0.2em] font-medium text-charcoal hover:bg-charcoal hover:text-ivory transition-colors text-center">
                                BUY NOW
                            </button>

                            <!-- Wishlist Button -->
                            <button type="button" 
                                    @click="toggleWishlist()"
                                    class="p-3.5 bg-ivory border border-border-subtle hover:border-charcoal text-charcoal transition-colors flex items-center justify-center"
                                    :title="isWishlisted ? 'Remove from Wishlist' : 'Add to Wishlist'">
                                <svg class="w-5 h-5 transition-transform active:scale-125" 
                                     :class="isWishlisted ? 'text-gold fill-gold' : 'text-charcoal'"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Certification Block -->
                @if($product->certification)
                    <div class="border border-border-subtle bg-ivory p-4 rounded-[1px] flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-full bg-gold/15 text-gold-dark flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                        <div class="flex-1 text-xs">
                            <div class="flex items-center justify-between">
                                <span class="font-medium uppercase tracking-wider text-charcoal text-[11px]">Certified Jewellery</span>
                                <span class="text-[10px] text-gold-dark font-sans font-medium">Verified Dossier</span>
                            </div>
                            <p class="text-charcoal-muted mt-0.5 font-light">
                                {{ $product->certification }}
                                @if($product->certificate_number)
                                    — Report #<span class="font-mono text-charcoal">{{ $product->certificate_number }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                @endif

                <!-- Atelier Specifications Matrix Card -->
                <div class="border border-border-subtle bg-white dark:bg-stone-900 rounded-2xl p-5 shadow-xs">
                    <div class="flex items-center justify-between pb-3 mb-4 border-b border-border-subtle/80">
                        <div class="flex items-center space-x-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-gold-dark"></span>
                            <span class="text-[11px] uppercase tracking-[0.2em] font-semibold text-charcoal dark:text-ivory">
                                Atelier Dossier
                            </span>
                        </div>
                        <span class="inline-flex items-center gap-1 text-[10px] text-emerald-800 bg-emerald-50 dark:bg-emerald-950/40 dark:text-emerald-300 px-2.5 py-0.5 rounded-full font-medium border border-emerald-200 dark:border-emerald-800/40">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            100% Certified
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-2.5 text-xs font-sans">
                        <div class="bg-ivory/60 dark:bg-stone-800/50 p-3 rounded-xl border border-border-subtle/60">
                            <span class="text-[9.5px] uppercase tracking-wider text-charcoal-muted dark:text-stone-400 block mb-0.5 font-medium">Precious Metal</span>
                            <span class="text-charcoal dark:text-ivory font-semibold text-xs">{{ $product->metal_type ?? '18Kt Yellow Gold' }}</span>
                        </div>
                        <div class="bg-ivory/60 dark:bg-stone-800/50 p-3 rounded-xl border border-border-subtle/60">
                            <span class="text-[9.5px] uppercase tracking-wider text-charcoal-muted dark:text-stone-400 block mb-0.5 font-medium">Hallmark Purity</span>
                            <span class="text-charcoal dark:text-ivory font-semibold text-xs">{{ $product->purity ?? '18K (Au 750)' }}</span>
                        </div>
                        <div class="bg-ivory/60 dark:bg-stone-800/50 p-3 rounded-xl border border-border-subtle/60">
                            <span class="text-[9.5px] uppercase tracking-wider text-charcoal-muted dark:text-stone-400 block mb-0.5 font-medium">Approx Weight</span>
                            <span class="text-charcoal dark:text-ivory font-semibold text-xs">{{ $product->weight ?? '4.85' }} grams</span>
                        </div>
                        <div class="bg-ivory/60 dark:bg-stone-800/50 p-3 rounded-xl border border-border-subtle/60">
                            <span class="text-[9.5px] uppercase tracking-wider text-charcoal-muted dark:text-stone-400 block mb-0.5 font-medium">Diamond &amp; Gems</span>
                            <span class="text-charcoal dark:text-ivory font-semibold text-xs">{{ $product->gemstone_type ?? 'Natural Diamonds' }}</span>
                        </div>
                        @if($product->stone)
                            <div class="col-span-2 bg-ivory/60 dark:bg-stone-800/50 p-3 rounded-xl border border-border-subtle/60">
                                <span class="text-[9.5px] uppercase tracking-wider text-charcoal-muted dark:text-stone-400 block mb-0.5 font-medium">Stone Arrangement</span>
                                <span class="text-charcoal dark:text-ivory font-medium text-xs">{{ $product->stone }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Description Expandable Accordion (Mobile View Only) -->
                <div class="lg:hidden block border border-border-subtle bg-white dark:bg-stone-900 rounded-2xl divide-y divide-border-subtle/70 overflow-hidden shadow-xs mt-6" 
                     x-data="{ openSection: 'story' }">
                    
                    <!-- 1. STORY & DESIGN DETAILS -->
                    <div class="p-4 sm:p-4.5">
                        <button type="button" 
                                @click="openSection = (openSection === 'story' ? '' : 'story')"
                                class="w-full flex items-center justify-between text-left text-xs uppercase tracking-[0.18em] font-medium text-charcoal dark:text-ivory hover:text-gold-dark transition-colors cursor-pointer">
                            <span class="flex items-center gap-2">
                                <span class="text-gold-dark text-sm">✦</span>
                                <span>Design Inspiration &amp; Details</span>
                            </span>
                            <svg class="w-4 h-4 text-charcoal-muted transform transition-transform duration-200" :class="openSection === 'story' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="openSection === 'story'" x-transition class="mt-3.5 text-xs text-charcoal-muted dark:text-stone-300 leading-relaxed font-light">
                            <p class="whitespace-pre-line">{{ $product->description ?: $product->short_description }}</p>
                        </div>
                    </div>

                    <!-- 2. CRAFTSMANSHIP & HALLMARKING -->
                    <div class="p-4 sm:p-4.5">
                        <button type="button" 
                                @click="openSection = (openSection === 'craft' ? '' : 'craft')"
                                class="w-full flex items-center justify-between text-left text-xs uppercase tracking-[0.18em] font-medium text-charcoal dark:text-ivory hover:text-gold-dark transition-colors cursor-pointer">
                            <span class="flex items-center gap-2">
                                <span class="text-gold-dark text-sm">✦</span>
                                <span>Master Craftsmanship &amp; SKU</span>
                            </span>
                            <svg class="w-4 h-4 text-charcoal-muted transform transition-transform duration-200" :class="openSection === 'craft' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="openSection === 'craft'" x-transition class="mt-3.5 text-xs text-charcoal-muted dark:text-stone-300 leading-relaxed space-y-2 font-light">
                            <p>&bull; Individually handcrafted by master lapidaries with microscopic prong seating.</p>
                            <p>&bull; Official BIS Hallmark purity guarantee stamped on inner gallery.</p>
                            <p>&bull; Accompanied by official laboratory certificate of authenticity.</p>
                            <p>&bull; Atelier SKU Code: <span class="font-mono text-charcoal dark:text-ivory font-medium">{{ $product->sku }}</span></p>
                        </div>
                    </div>

                    <!-- 3. CARE & LONGEVITY -->
                    <div class="p-4 sm:p-4.5">
                        <button type="button" 
                                @click="openSection = (openSection === 'care' ? '' : 'care')"
                                class="w-full flex items-center justify-between text-left text-xs uppercase tracking-[0.18em] font-medium text-charcoal dark:text-ivory hover:text-gold-dark transition-colors cursor-pointer">
                            <span class="flex items-center gap-2">
                                <span class="text-gold-dark text-sm">✦</span>
                                <span>Precious Metal Care</span>
                            </span>
                            <svg class="w-4 h-4 text-charcoal-muted transform transition-transform duration-200" :class="openSection === 'care' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="openSection === 'care'" x-transition class="mt-3.5 text-xs text-charcoal-muted dark:text-stone-300 leading-relaxed space-y-2 font-light">
                            <p>To preserve scintillation, gently clean with lukewarm soapy water and our provided suede cloth.</p>
                            <p>Includes complimentary lifetime ultrasonic cleaning and prong re-tightening at Modern Jewellery House salons.</p>
                        </div>
                    </div>

                    <!-- 4. INSURED TRANSIT & RETURNS -->
                    <div class="p-4 sm:p-4.5">
                        <button type="button" 
                                @click="openSection = (openSection === 'transit' ? '' : 'transit')"
                                class="w-full flex items-center justify-between text-left text-xs uppercase tracking-[0.18em] font-medium text-charcoal dark:text-ivory hover:text-gold-dark transition-colors cursor-pointer">
                            <span class="flex items-center gap-2">
                                <span class="text-gold-dark text-sm">✦</span>
                                <span>Insured Delivery &amp; 30-Day Returns</span>
                            </span>
                            <svg class="w-4 h-4 text-charcoal-muted transform transition-transform duration-200" :class="openSection === 'transit' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="openSection === 'transit'" x-transition class="mt-3.5 text-xs text-charcoal-muted dark:text-stone-300 leading-relaxed space-y-2 font-light">
                            <p>&bull; <strong>100% Free Armored Transit:</strong> Fully insured discrete shipment with security tamper seals.</p>
                            <p>&bull; <strong>30-Day Return Privilege:</strong> Exchange or refund with complimentary courier pickup.</p>
                            <p>&bull; <strong>Prompt Dispatch:</strong> Meticulously prepared and dispatched within 24 to 48 business hours.</p>
                        </div>
                    </div>

                </div>

                <!-- Private Concierge Assistance Card (Classic Luxury Compact Card) -->
                <div class="bg-stone-50/80 dark:bg-stone-900/60 border border-stone-200/90 dark:border-stone-800 rounded-xl p-3.5 sm:p-4 shadow-2xs transition-all hover:border-amber-400/50">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-[#0a2240] dark:bg-stone-800 text-amber-300 flex items-center justify-center flex-shrink-0 shadow-xs border border-amber-400/20">
                            <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2">
                                <h4 class="font-serif text-xs font-semibold text-charcoal dark:text-ivory tracking-wide">
                                    Bespoke Concierge &amp; Atelier Advice
                                </h4>
                                <span class="text-[9px] uppercase tracking-wider text-amber-800 dark:text-amber-300 font-bold bg-amber-100/70 dark:bg-amber-950/60 px-1.5 py-0.5 rounded border border-amber-300/50 flex-shrink-0">
                                    Online
                                </span>
                            </div>
                            <p class="text-[11px] text-charcoal-muted dark:text-stone-400 font-light mt-0.5 leading-relaxed">
                                Our certified gemologists assist with custom ring sizing, certified diamond gradings, and personalized engraving.
                            </p>
                            <div class="flex items-center gap-3 mt-2 pt-1.5 border-t border-stone-200/50 dark:border-stone-800">
                                <a href="mailto:concierge@modernjewelleryhouse.com" 
                                   class="inline-flex items-center gap-1 text-[11px] font-semibold text-[#0a2240] dark:text-amber-300 hover:text-[#f15d4c] transition-colors">
                                    <span>Speak with a Gemologist</span>
                                    <span>&rarr;</span>
                                </a>
                                <span class="text-stone-300 dark:text-stone-700">&bull;</span>
                                <span class="text-[10px] text-charcoal-muted dark:text-stone-400">Toll Free 1800-MJH-GOLD</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- ========================================================
             FULL-WIDTH PRODUCT SHOWCASE: ATELIER STORY & DETAILS
             Tabbed / Multi-Card Architecture with Luxury Aesthetics
             ======================================================== -->
        <section class="mt-8 sm:mt-12 pt-6 sm:pt-8 border-t border-gray-200 dark:border-stone-800" x-data="{ activePdpTab: 'story' }">
            
            <!-- Tab Headers -->
            <div class="flex items-center justify-center border-b border-gray-200 dark:border-stone-800 gap-2 sm:gap-6 pb-2.5 mb-6 overflow-x-auto scrollbar-none font-sans">
                <button type="button" 
                        @click="activePdpTab = 'story'"
                        :class="activePdpTab === 'story' ? 'text-[#0a2240] dark:text-amber-300 border-[#0a2240] dark:border-amber-300 font-bold' : 'text-gray-500 dark:text-stone-400 border-transparent hover:text-gray-800 dark:hover:text-stone-200'"
                        class="pb-2 border-b-2 text-xs sm:text-[13px] uppercase tracking-wider transition-all whitespace-nowrap">
                    Design Inspiration &amp; Story
                </button>
                <button type="button" 
                        @click="activePdpTab = 'specs'"
                        :class="activePdpTab === 'specs' ? 'text-[#0a2240] dark:text-amber-300 border-[#0a2240] dark:border-amber-300 font-bold' : 'text-gray-500 dark:text-stone-400 border-transparent hover:text-gray-800 dark:hover:text-stone-200'"
                        class="pb-2 border-b-2 text-xs sm:text-[13px] uppercase tracking-wider transition-all whitespace-nowrap">
                    Complete Specifications Matrix
                </button>
                <button type="button" 
                        @click="activePdpTab = 'price'"
                        :class="activePdpTab === 'price' ? 'text-[#0a2240] dark:text-amber-300 border-[#0a2240] dark:border-amber-300 font-bold' : 'text-gray-500 dark:text-stone-400 border-transparent hover:text-gray-800 dark:hover:text-stone-200'"
                        class="pb-2 border-b-2 text-xs sm:text-[13px] uppercase tracking-wider transition-all whitespace-nowrap">
                    Transparent Price Breakup
                </button>
                <button type="button" 
                        @click="activePdpTab = 'promise'"
                        :class="activePdpTab === 'promise' ? 'text-[#0a2240] dark:text-amber-300 border-[#0a2240] dark:border-amber-300 font-bold' : 'text-gray-500 dark:text-stone-400 border-transparent hover:text-gray-800 dark:hover:text-stone-200'"
                        class="pb-2 border-b-2 text-xs sm:text-[13px] uppercase tracking-wider transition-all whitespace-nowrap">
                    The Atelier Promise
                </button>
            </div>

            <!-- Tab 1: Design Inspiration & Story -->
            <div x-show="activePdpTab === 'story'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="max-w-4xl mx-auto">
                <div class="bg-white dark:bg-stone-900 rounded-xl border border-gray-200 dark:border-stone-800 p-4 sm:p-6 shadow-2xs">
                    <div class="flex items-center gap-2 mb-2.5">
                        <span class="w-5 h-0.5 bg-[#f15d4c]"></span>
                        <span class="text-[10px] uppercase tracking-wider text-[#f15d4c] font-bold">Atelier Narrative</span>
                    </div>
                    <h3 class="font-serif text-lg sm:text-xl text-[#0a2240] dark:text-white font-normal mb-2.5">
                        The Making of {{ $product->name }}
                    </h3>
                    <p class="text-xs sm:text-sm text-gray-700 dark:text-stone-300 leading-relaxed font-light mb-4">
                        {!! nl2br(e($product->description ?: $product->short_description)) !!}
                    </p>
                    
                    <div class="p-4 bg-gradient-to-r from-amber-50/60 to-rose-50/40 dark:from-stone-850 dark:to-stone-800 rounded-lg border border-amber-200/50 dark:border-amber-500/20 my-4">
                        <blockquote class="font-serif italic text-xs sm:text-sm text-gray-800 dark:text-stone-200 leading-relaxed text-center">
                            "Designed with mindful restraint, engineered with microscopic precision, and finished to become an eternal heirloom."
                        </blockquote>
                        <div class="text-center mt-2">
                            <span class="text-[9px] uppercase tracking-wider text-gray-500 dark:text-stone-400 font-semibold block">Modern Jewellery House &bull; Master Artisan Atelier</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-3 border-t border-gray-100 dark:border-stone-800 text-center">
                        <div class="p-3 bg-gray-50 dark:bg-stone-800/60 rounded-lg">
                            <span class="block text-lg mb-0.5">✨</span>
                            <span class="text-xs font-bold text-[#0a2240] dark:text-white block">Ideal Cut Ratio</span>
                            <span class="text-[10.5px] text-gray-500 dark:text-stone-400 font-light">Engineered for intense scintillation</span>
                        </div>
                        <div class="p-3 bg-gray-50 dark:bg-stone-800/60 rounded-lg">
                            <span class="block text-lg mb-0.5">🛡️</span>
                            <span class="text-xs font-bold text-[#0a2240] dark:text-white block">BIS Hallmarked Gold</span>
                            <span class="text-[10.5px] text-gray-500 dark:text-stone-400 font-light">Assayed by government authorized labs</span>
                        </div>
                        <div class="p-3 bg-gray-50 dark:bg-stone-800/60 rounded-lg">
                            <span class="block text-lg mb-0.5">🌱</span>
                            <span class="text-xs font-bold text-[#0a2240] dark:text-white block">Ethical Kimberly Process</span>
                            <span class="text-[10.5px] text-gray-500 dark:text-stone-400 font-light">100% Conflict-free natural stones</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 2: Complete Specifications Matrix -->
            <div x-show="activePdpTab === 'specs'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="max-w-4xl mx-auto" style="display: none;">
                <div class="bg-white dark:bg-stone-900 rounded-xl border border-gray-200 dark:border-stone-800 p-4 sm:p-6 shadow-2xs">
                    <h3 class="font-serif text-lg sm:text-xl text-[#0a2240] dark:text-white font-normal mb-4">
                        Complete Technical Dossier &bull; {{ $product->sku }}
                    </h3>
                    
                    <div class="divide-y divide-gray-100 dark:divide-stone-800 text-xs">
                        <div class="py-2.5 flex justify-between items-center">
                            <span class="text-gray-500 dark:text-stone-400">Product Code (SKU)</span>
                            <span class="font-mono font-bold text-gray-900 dark:text-white">{{ $product->sku }}</span>
                        </div>
                        <div class="py-2.5 flex justify-between items-center">
                            <span class="text-gray-500 dark:text-stone-400">Metal Composition</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $product->metal_type ?? '18Kt Gold' }}</span>
                        </div>
                        <div class="py-2.5 flex justify-between items-center">
                            <span class="text-gray-500 dark:text-stone-400">Gold Purity</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $product->purity ?? '18K (Au 750)' }} (75.0% Pure Gold)</span>
                        </div>
                        <div class="py-2.5 flex justify-between items-center">
                            <span class="text-gray-500 dark:text-stone-400">Gross Weight</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $product->weight ?? '4.85' }} grams (Approx.)</span>
                        </div>
                        <div class="py-2.5 flex justify-between items-center">
                            <span class="text-gray-500 dark:text-stone-400">Gemstone Details</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $product->gemstone_type ?? 'Natural Diamonds' }}</span>
                        </div>
                        <div class="py-2.5 flex justify-between items-center">
                            <span class="text-gray-500 dark:text-stone-400">Diamond Color &amp; Clarity</span>
                            <span class="font-semibold text-gray-900 dark:text-white">SI Clarity, IJ Color Grade</span>
                        </div>
                        <div class="py-2.5 flex justify-between items-center">
                            <span class="text-gray-500 dark:text-stone-400">Gemstone Setting Type</span>
                            <span class="font-semibold text-gray-900 dark:text-white">Micro-Pavé &amp; Shared Prong Setting</span>
                        </div>
                        <div class="py-2.5 flex justify-between items-center">
                            <span class="text-gray-500 dark:text-stone-400">Hallmark Certification</span>
                            <span class="font-semibold text-gray-900 dark:text-white">BIS Hallmarked &bull; SGL / IGI Certified</span>
                        </div>
                        <div class="py-2.5 flex justify-between items-center">
                            <span class="text-gray-500 dark:text-stone-400">Available Ring Sizes</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ implode(', ', $sizes) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 3: Transparent Price Breakup -->
            <div x-show="activePdpTab === 'price'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="max-w-4xl mx-auto" style="display: none;">
                <div class="bg-white dark:bg-stone-900 rounded-xl border border-gray-200 dark:border-stone-800 p-4 sm:p-6 shadow-2xs">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="font-serif text-lg sm:text-xl text-[#0a2240] dark:text-white font-normal">
                                Transparent Value &amp; Price Breakup
                            </h3>
                            <p class="text-[11px] text-gray-500 dark:text-stone-400 mt-0.5">Zero hidden margins &bull; Live market gold calculation</p>
                        </div>
                        <span class="text-[10px] font-bold text-rose-700 bg-rose-50 dark:bg-rose-950/50 px-2.5 py-0.5 rounded-full border border-rose-200 dark:border-rose-800">
                            Up to 50% Off on Making Charges
                        </span>
                    </div>

                    <div class="bg-gray-50 dark:bg-stone-800/60 rounded-lg p-4 divide-y divide-gray-200 dark:divide-stone-700 text-xs font-sans mb-4">
                        <div class="py-2 flex justify-between">
                            <span class="text-gray-600 dark:text-stone-300">Gold Value (Approx. {{ $product->weight ?? '4.85' }}g of {{ $product->purity ?? '18K' }})</span>
                            <span class="font-semibold text-gray-900 dark:text-white">₹ {{ number_format($product->base_price * 0.65, 0) }}</span>
                        </div>
                        <div class="py-2 flex justify-between">
                            <span class="text-gray-600 dark:text-stone-300">Natural Diamonds &amp; Gemstones Value</span>
                            <span class="font-semibold text-gray-900 dark:text-white">₹ {{ number_format($product->base_price * 0.25, 0) }}</span>
                        </div>
                        <div class="py-2 flex justify-between items-center">
                            <div>
                                <span class="text-gray-600 dark:text-stone-300 block">Making Charges (Crafting &amp; Setting)</span>
                                <span class="text-[9.5px] text-rose-600 font-semibold">Special Privilege Discount Applied</span>
                            </div>
                            <span class="font-semibold text-gray-900 dark:text-white">₹ {{ number_format($product->base_price * 0.07, 0) }}</span>
                        </div>
                        <div class="py-2 flex justify-between">
                            <span class="text-gray-600 dark:text-stone-300">Applicable GST (3%)</span>
                            <span class="font-semibold text-gray-900 dark:text-white">₹ {{ number_format($product->base_price * 0.03, 0) }}</span>
                        </div>
                        <div class="py-2.5 flex justify-between items-center text-xs sm:text-sm font-bold text-[#0a2240] dark:text-white pt-2.5">
                            <span>Total Price (Inclusive of All Taxes)</span>
                            <span class="text-base sm:text-lg text-[#0a2240] dark:text-amber-300">{{ $product->formatted_price }}</span>
                        </div>
                    </div>

                    <p class="text-[10px] text-gray-400 dark:text-stone-500 font-light text-center">
                        *Prices are calculated transparently based on standardized gold rates and gemological market indices.
                    </p>
                </div>
            </div>

            <!-- Tab 4: The Atelier Promise -->
            <div x-show="activePdpTab === 'promise'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="max-w-4xl mx-auto" style="display: none;">
                <div class="bg-white dark:bg-stone-900 rounded-xl border border-gray-200 dark:border-stone-800 p-4 sm:p-6 shadow-2xs">
                    <h3 class="font-serif text-lg sm:text-xl text-[#0a2240] dark:text-white font-normal mb-4 text-center">
                        The Modern Jewellery House Promise
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div class="p-3.5 rounded-lg border border-gray-100 dark:border-stone-800 bg-gray-50 dark:bg-stone-850 flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-amber-400/20 text-[#0a2240] flex items-center justify-center flex-shrink-0 text-base font-bold">
                                💎
                            </div>
                            <div>
                                <h4 class="font-bold text-xs uppercase tracking-wider text-[#0a2240] dark:text-white mb-0.5">100% Certified Jewellery</h4>
                                <p class="text-[11px] text-gray-600 dark:text-stone-400 font-light leading-relaxed">
                                    Every creation is stamped with BIS Hallmarks and accompanied by laboratory diamond dossiers from SGL/IGI.
                                </p>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-lg border border-gray-100 dark:border-stone-800 bg-gray-50 dark:bg-stone-850 flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-rose-400/20 text-[#0a2240] flex items-center justify-center flex-shrink-0 text-base font-bold">
                                🔄
                            </div>
                            <div>
                                <h4 class="font-bold text-xs uppercase tracking-wider text-[#0a2240] dark:text-white mb-0.5">Lifetime Exchange &amp; Buyback</h4>
                                <p class="text-[11px] text-gray-600 dark:text-stone-400 font-light leading-relaxed">
                                    Upgrade your piece anytime at maximum prevailing gold and diamond market value with 0% deduction.
                                </p>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-lg border border-gray-100 dark:border-stone-800 bg-gray-50 dark:bg-stone-850 flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-400/20 text-[#0a2240] flex items-center justify-center flex-shrink-0 text-base font-bold">
                                🛡️
                            </div>
                            <div>
                                <h4 class="font-bold text-xs uppercase tracking-wider text-[#0a2240] dark:text-white mb-0.5">100% Insured Armored Delivery</h4>
                                <p class="text-[11px] text-gray-600 dark:text-stone-400 font-light leading-relaxed">
                                    Every package travels discreetly insured to your doorstep, requiring adult signature verification upon receipt.
                                </p>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-lg border border-gray-100 dark:border-stone-800 bg-gray-50 dark:bg-stone-850 flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-emerald-400/20 text-[#0a2240] flex items-center justify-center flex-shrink-0 text-base font-bold">
                                🎁
                            </div>
                            <div>
                                <h4 class="font-bold text-xs uppercase tracking-wider text-[#0a2240] dark:text-white mb-0.5">Signature Presentation Box</h4>
                                <p class="text-[11px] text-gray-600 dark:text-stone-400 font-light leading-relaxed">
                                    Arrives nestled in our signature luxury presentation box with velvet travel pouch and tamper-evident certificate book.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <!-- ========================================================
             CUSTOMER REVIEWS & TESTIMONIALS SECTION
             ======================================================== -->
        @php
            $approvedReviews = $product->reviews;
            $totalReviewsCount = $approvedReviews->count();
            $ratingCounts = [
                5 => $approvedReviews->where('rating', 5)->count(),
                4 => $approvedReviews->where('rating', 4)->count(),
                3 => $approvedReviews->where('rating', 3)->count(),
                2 => $approvedReviews->where('rating', 2)->count(),
                1 => $approvedReviews->where('rating', 1)->count(),
            ];
            $allCustomerImages = $approvedReviews->flatMap(fn($r) => $r->images);
        @endphp

        <section id="reviews-section" 
                 class="mt-8 sm:mt-12 pt-6 sm:pt-8 border-t border-gray-200 dark:border-stone-800 scroll-mt-24" 
                 x-data="{ 
                     reviewModalOpen: false, 
                     activeZoomImage: null, 
                     newRating: 5, 
                     hoverRating: 5, 
                     photoPreviews: [],
                     handleFiles(event) {
                         const files = Array.from(event.target.files);
                         this.photoPreviews = [];
                         files.slice(0, 5).forEach(file => {
                             const reader = new FileReader();
                             reader.onload = (e) => {
                                 this.photoPreviews.push({ name: file.name, url: e.target.result });
                             };
                             reader.readAsDataURL(file);
                         });
                     }
                 }">
            
            <!-- Session Messages -->
            @if(session('success'))
                <div class="mb-8 p-4 bg-emerald-50 border border-emerald-300 rounded-xl flex items-center gap-3 text-emerald-800 text-sm shadow-xs">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-8 p-4 bg-rose-50 border border-rose-300 rounded-xl text-rose-800 text-sm shadow-xs">
                    <p class="font-bold mb-1">Please correct the following errors:</p>
                    <ul class="list-disc list-inside text-xs space-y-1">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Section Header & Rating Summary Matrix (Classic Compact Luxury Layout) -->
            <div class="bg-white dark:bg-stone-900 rounded-xl border border-gray-200 dark:border-stone-800 p-4 sm:p-6 shadow-2xs mb-6">
                <!-- Top Header Row -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-gray-100 dark:border-stone-800">
                    <div>
                        <div class="flex items-center gap-1.5 mb-1">
                            <span class="w-4 h-0.5 bg-[#f15d4c]"></span>
                            <span class="text-[10px] uppercase tracking-wider text-[#f15d4c] font-bold">Patron Experiences</span>
                        </div>
                        <h2 class="font-serif text-lg sm:text-xl text-[#0a2240] dark:text-white font-normal">
                            Customer Reviews &amp; Verifications
                        </h2>
                        <p class="text-xs text-gray-500 dark:text-stone-400 font-light mt-0.5">
                            Authentic reviews and heirloom photography submitted by connoisseurs worldwide.
                        </p>
                    </div>

                    <!-- Action: Write a Review -->
                    <button type="button" 
                            @click="reviewModalOpen = true"
                            class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-[#0a2240] hover:bg-[#16365c] text-white text-xs uppercase tracking-wider font-semibold rounded-lg transition-all shadow-xs hover:shadow active:scale-95 flex-shrink-0 cursor-pointer self-start sm:self-auto">
                        <svg class="w-3.5 h-3.5 text-amber-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span>Write A Review</span>
                    </button>
                </div>

                <!-- Scorecard and Bar Breakdown -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-5 pt-4 items-center">
                    <!-- Left Score -->
                    <div class="md:col-span-4 text-center md:text-left md:border-r md:border-gray-100 dark:md:border-stone-800 md:pr-6">
                        <div class="flex items-baseline justify-center md:justify-start gap-2 mb-1">
                            <span class="font-serif text-3xl sm:text-4xl text-[#0a2240] dark:text-white font-medium leading-none">
                                {{ $product->average_rating }}
                            </span>
                            <span class="text-xs text-gray-400 dark:text-stone-500 font-light">/ 5.0</span>
                        </div>
                        <div class="flex items-center justify-center md:justify-start gap-1 text-amber-500 text-sm mb-1.5">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round((float)$product->average_rating))
                                    <span>★</span>
                                @else
                                    <span class="text-gray-300 dark:text-stone-700">★</span>
                                @endif
                            @endfor
                        </div>
                        <div class="text-[11px] text-gray-500 dark:text-stone-400 font-medium">
                            Based on {{ $totalReviewsCount }} verified {{ Str::plural('review', $totalReviewsCount) }}
                        </div>
                        <div class="text-[10.5px] text-emerald-600 dark:text-emerald-400 font-medium mt-1 flex items-center justify-center md:justify-start gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>100% Certified Purchases</span>
                        </div>
                    </div>

                    <!-- Middle Bars Breakdown -->
                    <div class="md:col-span-8 space-y-1.5">
                        @foreach([5, 4, 3, 2, 1] as $star)
                            @php
                                $cnt = $ratingCounts[$star] ?? 0;
                                $pct = $totalReviewsCount > 0 ? round(($cnt / $totalReviewsCount) * 100) : 0;
                            @endphp
                            <div class="flex items-center gap-2.5 text-xs">
                                <span class="w-10 text-gray-600 dark:text-stone-300 text-[11px] font-medium flex items-center gap-1">
                                    {{ $star }} <span class="text-amber-500 text-xs">★</span>
                                </span>
                                <div class="flex-1 h-1.5 bg-gray-100 dark:bg-stone-800 rounded-full overflow-hidden">
                                    <div class="h-full bg-amber-400 rounded-full transition-all duration-500" style="width: {{ $pct }}%;"></div>
                                </div>
                                <span class="w-8 text-right text-gray-400 dark:text-stone-500 font-mono text-[10.5px]">{{ $cnt }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Customer Photos Showcase Bar (if photos exist) -->
                @if($allCustomerImages->count() > 0)
                    <div class="mt-4 pt-3.5 border-t border-gray-100 dark:border-stone-800">
                        <div class="flex items-center justify-between mb-2.5">
                            <h4 class="text-[11px] uppercase tracking-wider font-bold text-[#0a2240] dark:text-white flex items-center gap-1.5">
                                <span>📸 Customer Photos</span>
                                <span class="px-1.5 py-0.2 rounded-full bg-amber-100 dark:bg-amber-950/60 text-amber-800 dark:text-amber-300 text-[9.5px] font-bold">
                                    {{ $allCustomerImages->count() }}
                                </span>
                            </h4>
                            <span class="text-[10px] text-gray-400 dark:text-stone-500">Tap photo to enlarge</span>
                        </div>

                        <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-thin">
                            @foreach($allCustomerImages as $cImg)
                                <button type="button" 
                                        @click="activeZoomImage = '{{ $cImg->image_url }}'"
                                        class="relative flex-shrink-0 w-14 h-14 sm:w-16 sm:h-16 rounded-lg overflow-hidden border border-gray-200 dark:border-stone-700 hover:border-amber-500 hover:scale-102 transition-all shadow-2xs group focus:outline-none cursor-pointer">
                                    <img src="{{ $cImg->image_url }}" 
                                         alt="Customer photo" 
                                         class="w-full h-full object-cover group-hover:opacity-90">
                                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/>
                                        </svg>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Customer Reviews Feed List -->
            <div class="space-y-6">
                @forelse($approvedReviews as $rev)
                    <div class="bg-white dark:bg-stone-900 rounded-xl border border-gray-200 dark:border-stone-800 p-4 sm:p-6 shadow-2xs transition-all hover:border-amber-300/60">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-gray-100 dark:border-stone-800">
                            <!-- Patron Info & Stars -->
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-[#0a2240] to-[#1e3a5f] text-amber-300 font-bold flex items-center justify-center text-xs shadow-xs flex-shrink-0">
                                    {{ strtoupper(substr($rev->reviewer_name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-serif font-bold text-sm text-gray-900 dark:text-white leading-tight">
                                            {{ $rev->reviewer_name }}
                                        </h4>
                                        <span class="inline-flex items-center gap-1 px-1.5 py-0.2 rounded-full bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-400 text-[9.5px] font-bold border border-emerald-200 dark:border-emerald-800">
                                            <svg class="w-2.5 h-2.5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Verified Patron
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <div class="flex text-amber-400 text-xs">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $rev->rating)
                                                    <span>★</span>
                                                @else
                                                    <span class="text-gray-200 dark:text-stone-700">★</span>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="text-[10px] text-gray-400 dark:text-stone-500 font-light">&bull; {{ $rev->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Review Text & Title -->
                        <div class="mt-3">
                            @if($rev->title)
                                <h5 class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white mb-1.5 font-serif">
                                    "{{ $rev->title }}"
                                </h5>
                            @endif
                            <p class="text-xs text-gray-700 dark:text-stone-300 leading-relaxed font-light whitespace-pre-line">
                                {{ $rev->comment }}
                            </p>
                        </div>

                        <!-- Review Images Attached -->
                        @if($rev->images && $rev->images->count() > 0)
                            <div class="mt-4 pt-3 border-t border-gray-100 dark:border-stone-800">
                                <span class="text-[9.5px] uppercase tracking-wider text-gray-400 dark:text-stone-500 font-semibold block mb-2">Uploaded Images</span>
                                <div class="flex items-center gap-2 flex-wrap">
                                    @foreach($rev->images as $img)
                                        <button type="button" 
                                                @click="activeZoomImage = '{{ $img->image_url }}'"
                                                class="w-14 h-14 sm:w-16 sm:h-16 rounded-lg overflow-hidden border border-gray-200 dark:border-stone-700 hover:border-amber-500 hover:scale-102 transition-all shadow-2xs group focus:outline-none cursor-pointer">
                                            <img src="{{ $img->image_url }}" 
                                                 alt="Review photo" 
                                                 class="w-full h-full object-cover group-hover:opacity-90">
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="bg-white dark:bg-stone-900 rounded-xl border border-dashed border-gray-300 dark:border-stone-800 p-8 sm:p-10 text-center">
                        <div class="w-12 h-12 rounded-full bg-amber-50 dark:bg-amber-950/40 text-amber-500 mx-auto flex items-center justify-center text-xl mb-3">
                            ✨
                        </div>
                        <h3 class="font-serif text-lg sm:text-xl text-[#0a2240] dark:text-white font-normal mb-1">
                            Be the First to Review This Masterpiece
                        </h3>
                        <p class="text-xs text-gray-500 dark:text-stone-400 max-w-md mx-auto mb-4 font-light">
                            Share your styling notes, diamond sparkle observations, and atelier experience with our global collectors.
                        </p>
                        <button type="button" 
                                @click="reviewModalOpen = true"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-[#0a2240] hover:bg-[#16365c] text-white text-xs uppercase tracking-widest font-bold rounded-xl transition-all shadow-md hover:shadow-lg active:scale-95 cursor-pointer">
                            Write The First Review
                        </button>
                    </div>
                @endforelse
            </div>

            <!-- ========================================================
                 MODAL: WRITE A CUSTOMER REVIEW
                 ======================================================== -->
            <div x-show="reviewModalOpen" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm overflow-y-auto"
                 style="display: none;"
                 @keydown.escape.window="reviewModalOpen = false">
                
                <div class="relative w-full max-w-xl bg-white rounded-2xl shadow-2xl border border-gray-200 p-6 sm:p-8 my-8"
                     @click.away="reviewModalOpen = false">
                    
                    <!-- Close Button -->
                    <button type="button" 
                            @click="reviewModalOpen = false"
                            class="absolute top-5 right-5 p-2 text-gray-400 hover:text-gray-700 transition-colors rounded-full hover:bg-gray-100 cursor-pointer"
                            aria-label="Close modal">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <!-- Modal Title -->
                    <div class="mb-6">
                        <span class="text-[10px] uppercase tracking-widest text-[#f15d4c] font-bold block mb-1">Patron Feedback</span>
                        <h3 class="font-serif text-2xl text-[#0a2240] font-normal">
                            Review {{ $product->name }}
                        </h3>
                        <p class="text-xs text-gray-500 font-light mt-0.5">
                            Any customer can submit their thoughts and upload real product photos.
                        </p>
                    </div>

                    <!-- Review Form -->
                    <form action="{{ route('products.reviews.store', $product) }}" 
                          method="POST" 
                          enctype="multipart/form-data" 
                          class="space-y-5">
                        @csrf
                        
                        <!-- Rating Selector -->
                        <div>
                            <label class="block text-xs uppercase tracking-wider font-bold text-gray-700 mb-2">
                                Overall Rating <span class="text-rose-500">*</span>
                            </label>
                            <input type="hidden" name="rating" :value="newRating">
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-1.5">
                                    <template x-for="star in [1, 2, 3, 4, 5]" :key="star">
                                        <button type="button"
                                                @click="newRating = star; hoverRating = star"
                                                @mouseenter="hoverRating = star"
                                                @mouseleave="hoverRating = newRating"
                                                class="text-3xl transition-transform hover:scale-125 focus:outline-none cursor-pointer"
                                                :class="star <= hoverRating ? 'text-amber-400' : 'text-gray-200'">
                                            ★
                                        </button>
                                    </template>
                                </div>
                                <span class="text-xs font-bold text-gray-700 ml-2 font-mono" x-text="newRating + ' of 5 Stars'"></span>
                            </div>
                        </div>

                        <!-- Customer Details (Guest or Logged In) -->
                        @guest
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs uppercase tracking-wider font-bold text-gray-700 mb-1.5">
                                        Your Full Name <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text" 
                                           name="customer_name" 
                                           required 
                                           placeholder="e.g. Eleanor Vance" 
                                           value="{{ old('customer_name') }}"
                                           class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs sm:text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0a2240] focus:ring-1 focus:ring-[#0a2240] outline-none transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs uppercase tracking-wider font-bold text-gray-700 mb-1.5">
                                        Your Email Address <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="email" 
                                           name="customer_email" 
                                           required 
                                           placeholder="e.g. eleanor@example.com" 
                                           value="{{ old('customer_email') }}"
                                           class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs sm:text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0a2240] focus:ring-1 focus:ring-[#0a2240] outline-none transition-all">
                                </div>
                            </div>
                        @else
                            <div class="p-3 bg-gray-50 rounded-xl border border-gray-200 flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="w-6 h-6 rounded-full bg-[#0a2240] text-white flex items-center justify-center font-bold text-[10px]">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </span>
                                    <span class="text-gray-700">Submitting as <strong class="text-gray-900">{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }})</span>
                                </div>
                                <span class="text-[10px] text-emerald-600 font-bold">Logged In Patron</span>
                            </div>
                        @endguest

                        <!-- Review Title / Headline -->
                        <div>
                            <label class="block text-xs uppercase tracking-wider font-bold text-gray-700 mb-1.5">
                                Review Headline <span class="text-gray-400 text-[10px] font-normal">(Optional)</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   placeholder="e.g. Exquisite craftsmanship, beyond expectations!" 
                                   value="{{ old('title') }}"
                                   class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs sm:text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0a2240] focus:ring-1 focus:ring-[#0a2240] outline-none transition-all">
                        </div>

                        <!-- Review Commentary -->
                        <div>
                            <label class="block text-xs uppercase tracking-wider font-bold text-gray-700 mb-1.5">
                                Your Detailed Experience <span class="text-rose-500">*</span>
                            </label>
                            <textarea name="comment" 
                                      rows="4" 
                                      required 
                                      placeholder="Share your detailed feedback regarding diamond luster, metal finishing, packaging presentation, or everyday wear..." 
                                      class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-xs sm:text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:border-[#0a2240] focus:ring-1 focus:ring-[#0a2240] outline-none transition-all resize-y">{{ old('comment') }}</textarea>
                            <span class="text-[10px] text-gray-400 mt-1 block">Minimum 10 characters required.</span>
                        </div>

                        <!-- Customer Photos Upload -->
                        <div>
                            <label class="block text-xs uppercase tracking-wider font-bold text-gray-700 mb-1.5">
                                Add Product Photos <span class="text-gray-400 text-[10px] font-normal">(Optional, up to 5 photos)</span>
                            </label>
                            
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-amber-400 transition-colors bg-gray-50/50">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-9 w-9 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-xs text-gray-600 justify-center">
                                        <label for="review-photos-upload" class="relative cursor-pointer bg-white rounded-md font-bold text-[#0a2240] hover:text-amber-600 focus-within:outline-none">
                                            <span>Upload images</span>
                                            <input id="review-photos-upload" 
                                                   name="images[]" 
                                                   type="file" 
                                                   multiple 
                                                   accept="image/png,image/jpeg,image/jpg,image/webp" 
                                                   class="sr-only"
                                                   @change="handleFiles($event)">
                                        </label>
                                        <p class="pl-1">or drag &amp; drop</p>
                                    </div>
                                    <p class="text-[10px] text-gray-400">PNG, JPG, WEBP up to 5MB each (Max 5 images)</p>
                                </div>
                            </div>

                            <!-- Client-Side Image Previews -->
                            <div x-show="photoPreviews.length > 0" class="mt-3 flex items-center gap-2 flex-wrap">
                                <template x-for="(photo, pIdx) in photoPreviews" :key="pIdx">
                                    <div class="relative w-16 h-16 rounded-lg overflow-hidden border border-gray-200 shadow-2xs">
                                        <img :src="photo.url" class="w-full h-full object-cover" :alt="photo.name">
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                            <button type="button" 
                                    @click="reviewModalOpen = false"
                                    class="px-5 py-2.5 rounded-xl border border-gray-200 text-xs font-semibold text-gray-600 hover:bg-gray-50 transition-colors cursor-pointer">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="px-6 py-2.5 bg-[#0a2240] hover:bg-[#16365c] text-white text-xs uppercase tracking-widest font-bold rounded-xl transition-all shadow-md hover:shadow-lg active:scale-95 cursor-pointer">
                                Submit Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ========================================================
                 MODAL: ZOOM CUSTOMER IMAGE
                 ======================================================== -->
            <div x-show="activeZoomImage !== null" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-md"
                 style="display: none;"
                 @keydown.escape.window="activeZoomImage = null">
                
                <div class="relative max-w-4xl max-h-[85vh] flex flex-col items-center">
                    <button type="button" 
                            @click="activeZoomImage = null"
                            class="absolute -top-12 right-0 p-2 text-white hover:text-amber-400 transition-colors cursor-pointer"
                            aria-label="Close zoom image">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <img :src="activeZoomImage" 
                         alt="Enlarged customer review photo" 
                         class="max-w-full max-h-[80vh] rounded-xl object-contain shadow-2xl border border-white/10">
                </div>
            </div>

        </section>

        <!-- LIGHTBOX FULLSCREEN MODAL -->
        <div x-show="lightboxOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-noir/90 backdrop-blur-md"
             style="display: none;"
             @keydown.escape.window="lightboxOpen = false">
            
            <div class="relative w-full max-w-5xl h-[85vh] flex flex-col items-center justify-center">
                <button type="button" 
                        @click="lightboxOpen = false"
                        class="absolute top-2 right-2 p-3 text-ivory hover:text-gold transition-colors z-20"
                        aria-label="Close Lightbox">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <!-- Fullscreen Image -->
                <div class="w-full h-full flex items-center justify-center p-4">
                    @foreach($allImages as $idx => $img)
                        <img x-show="activeSlide === {{ $idx }}"
                             src="{{ $img->url }}" 
                             alt="{{ $product->name }} fullscreen" 
                             class="max-w-full max-h-full object-contain">
                    @endforeach
                </div>

                <!-- Lightbox Prev / Next -->
                <button type="button" @click="prevSlide()" class="absolute left-4 top-1/2 -translate-y-1/2 p-3 text-ivory hover:text-gold">
                    ‹
                </button>
                <button type="button" @click="nextSlide()" class="absolute right-4 top-1/2 -translate-y-1/2 p-3 text-ivory hover:text-gold">
                    ›
                </button>
            </div>
        </div>

        <!-- RELATED PRODUCTS SECTION 1: "YOU MAY ALSO LIKE" -->
        @if($relatedProducts->count() > 0)
            <section class="mt-12 sm:mt-20 pt-10 sm:pt-16 border-t border-border-subtle">
                <div class="text-center mb-6 sm:mb-10">
                    <span class="text-[10px] uppercase tracking-[0.25em] text-gold-dark font-medium block mb-1">
                        Curated Recommendations
                    </span>
                    <h2 class="font-serif text-xl sm:text-3xl text-charcoal dark:text-white font-normal">
                        You May Also Like
                    </h2>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 lg:gap-8">
                    @foreach($relatedProducts as $related)
                        <x-product-card :product="$related" />
                    @endforeach
                </div>
            </section>
        @endif

        <!-- RELATED PRODUCTS SECTION 2: "COMPLETE THE LOOK" -->
        @if($completeTheLook->count() > 0)
            <section class="mt-10 sm:mt-16 pt-10 sm:pt-16 border-t border-border-subtle/80">
                <div class="text-center mb-6 sm:mb-10">
                    <span class="text-[10px] uppercase tracking-[0.25em] text-gold-dark font-medium block mb-1">
                        Complementary Ensemble
                    </span>
                    <h2 class="font-serif text-xl sm:text-3xl text-charcoal dark:text-white font-normal">
                        Complete the Look
                    </h2>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 lg:gap-8">
                    @foreach($completeTheLook as $comp)
                        <x-product-card :product="$comp" />
                    @endforeach
                </div>
            </section>
        @endif

        <!-- RELATED PRODUCTS SECTION 3: "RECENTLY VIEWED" -->
        <section class="mt-10 sm:mt-16 pt-10 sm:pt-16 border-t border-border-subtle/80" 
                 x-show="recentlyViewedItems.length > 0"
                 x-transition>
            <div class="text-center mb-6 sm:mb-10">
                <span class="text-[10px] uppercase tracking-[0.25em] text-gold-dark font-medium block mb-1">
                    Your Atelier Browsing History
                </span>
                <h2 class="font-serif text-xl sm:text-3xl text-charcoal dark:text-white font-normal">
                    Recently Viewed
                </h2>
            </div>

            <!-- Authenticated items from server or dynamically hydrated from local storage -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 lg:gap-8" id="recently-viewed-grid">
                <template x-for="item in recentlyViewedItems" :key="item.id">
                    <article class="group relative flex flex-col transition-all duration-300">
                        <div class="relative w-full aspect-square bg-[#F7F5F0] overflow-hidden border border-border-subtle mb-3">
                            <a :href="item.url" class="block w-full h-full">
                                <img :src="item.image" :alt="item.name" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                            </a>
                            <span x-show="item.badge" x-text="item.badge" class="absolute top-2 left-2 bg-noir text-ivory text-[8px] tracking-[0.2em] uppercase px-2 py-0.5"></span>
                        </div>
                        <div>
                            <span class="text-[9px] uppercase tracking-[0.2em] text-gold-dark" x-text="item.category"></span>
                            <h4 class="font-serif text-sm text-charcoal line-clamp-1 mt-0.5">
                                <a :href="item.url" x-text="item.name" class="hover:text-gold-dark"></a>
                            </h4>
                            <p class="text-xs font-serif text-charcoal mt-1" x-text="item.price"></p>
                        </div>
                    </article>
                </template>
            </div>
        </section>

    </div>

    <!-- Alpine Product Detail Script -->
    <script>
        function productDetailGallery(config) {
            return {
                activeMode: 'photos', // 'photos' | '360' | 'video'
                activeSlide: 0,
                totalSlides: config.totalSlides,
                totalPhotos: config.totalPhotos || config.totalSlides,
                has3d: config.has3d,
                isRenderMyJewelry: config.isRenderMyJewelry,
                baseModelUrl: config.modelUrl,
                lightboxOpen: false,
                isZooming: false,
                zoomOrigin: 'center center',
                touchStartX: 0,
                touchEndX: 0,
                selectedSize: '{{ $sizes[0] ?? "16" }}',
                addingToBag: false,
                addedSuccess: false,
                sizeGuideModal: false,
                isWishlisted: window.isGuestWishlisted ? window.isGuestWishlisted(config.productId) : false,
                recentlyViewedItems: [],
                isSpinning: config.rmjAutorotate !== undefined ? config.rmjAutorotate : true,
                currentMetal: config.rmjDefaultColor || 'yellow',
                show3dHint: true,

                initProduct() {
                    // 1. Record recently viewed in localStorage
                    this.recordRecentlyViewedLocal();

                    // 2. Load recently viewed from localStorage or server
                    this.loadRecentlyViewed();

                    // 3. Record on server if authenticated
                    if (window.globalMaisonApp && {{ Auth::check() ? 'true' : 'false' }}) {
                        fetch('{{ route('recently-viewed.record') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ product_id: config.productId })
                        }).catch(e => console.debug('Recently viewed record skipped', e));
                    }
                },

                switchGalleryMode(mode) {
                    this.activeMode = mode;
                    this.isZooming = false;
                    if (mode === '360') {
                        this.show3dHint = true;
                        setTimeout(() => { this.show3dHint = false; }, 3500);
                        if (!this.isRenderMyJewelry) {
                            this.$nextTick(() => {
                                this.mountStandardModelViewer();
                            });
                        }
                    }
                },

                toggleSpin() {
                    this.isSpinning = !this.isSpinning;
                    const iframe = document.getElementById('rmj-360-iframe');
                    if (iframe && iframe.contentWindow) {
                        iframe.contentWindow.postMessage({
                            action: this.isSpinning ? 'play' : 'pause',
                            type: 'setAutorotate',
                            autorotate: this.isSpinning,
                            value: this.isSpinning
                        }, '*');
                    }
                    const mv = document.querySelector('model-viewer');
                    if (mv) {
                        if (this.isSpinning) {
                            mv.setAttribute('auto-rotate', '');
                        } else {
                            mv.removeAttribute('auto-rotate');
                        }
                    }
                },

                changeColor(color) {
                    this.currentMetal = color;
                    const iframe = document.getElementById('rmj-360-iframe');
                    if (iframe && iframe.contentWindow) {
                        iframe.contentWindow.postMessage({
                            action: 'changeColor',
                            type: 'setColor',
                            color: color,
                            metal: color,
                            value: color
                        }, '*');
                    }
                },

                resetView() {
                    const iframe = document.getElementById('rmj-360-iframe');
                    if (iframe && iframe.contentWindow) {
                        iframe.contentWindow.postMessage({
                            action: 'reset',
                            type: 'resetCamera',
                            value: true
                        }, '*');
                    }
                    const mv = document.querySelector('model-viewer');
                    if (mv) {
                        mv.cameraOrbit = '0deg 75deg 105%';
                        if (typeof mv.resetTurntableRotation === 'function') {
                            mv.resetTurntableRotation();
                        }
                    }
                },

                toggleFullscreen() {
                    const stage = document.getElementById('rmj-360-stage');
                    if (!document.fullscreenElement) {
                        if (stage && stage.requestFullscreen) {
                            stage.requestFullscreen().catch(err => console.debug('Fullscreen error', err));
                        }
                    } else {
                        if (document.exitFullscreen) {
                            document.exitFullscreen().catch(err => console.debug('Exit fullscreen error', err));
                        }
                    }
                },

                goToSlide(index) {
                    this.activeMode = 'photos';
                    if (index >= 0 && index < this.totalPhotos) {
                        this.activeSlide = index;
                    }
                },

                nextSlide() {
                    if (this.activeMode === 'photos') {
                        this.activeSlide = (this.activeSlide + 1) % this.totalPhotos;
                    }
                },

                prevSlide() {
                    if (this.activeMode === 'photos') {
                        this.activeSlide = (this.activeSlide - 1 + this.totalPhotos) % this.totalPhotos;
                    }
                },

                mountStandardModelViewer() {
                    const host = document.getElementById('model-stage-host');
                    if (!host || host.hasChildNodes()) return;
                    this.loadModelViewerScript(() => {
                        this.createModelViewerElement(host);
                    });
                },

                loadModelViewerScript(callback) {
                    if (window.customElements && window.customElements.get('model-viewer')) {
                        callback();
                        return;
                    }
                    const script = document.createElement('script');
                    script.type = 'module';
                    script.src = 'https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js';
                    script.onload = callback;
                    document.head.appendChild(script);
                },

                createModelViewerElement(host) {
                    if (!config.modelUrl) return;
                    const mv = document.createElement('model-viewer');
                    mv.setAttribute('src', config.modelUrl);
                    mv.setAttribute('alt', config.productName + ' 3D Studio');
                    mv.setAttribute('camera-controls', '');
                    mv.setAttribute('touch-action', 'pan-y');
                    mv.setAttribute('shadow-intensity', '1.2');
                    mv.setAttribute('exposure', '1.2');
                    mv.style.width = '100%';
                    mv.style.height = '100%';
                    host.appendChild(mv);
                },

                touchStart(e) {
                    this.touchStartX = e.changedTouches[0].screenX;
                },

                touchEnd(e) {
                    this.touchEndX = e.changedTouches[0].screenX;
                    const diff = this.touchStartX - this.touchEndX;
                    if (Math.abs(diff) > 40 && this.activeMode === 'photos') {
                        if (diff > 0) this.nextSlide();
                        else this.prevSlide();
                    }
                },

                handleZoomMove(e) {
                    if (this.activeMode !== 'photos') return;
                    const rect = e.currentTarget.getBoundingClientRect();
                    const x = ((e.clientX - rect.left) / rect.width) * 100;
                    const y = ((e.clientY - rect.top) / rect.height) * 100;
                    this.zoomOrigin = x + '% ' + y + '%';
                    this.isZooming = true;
                },

                handleZoomLeave() {
                    this.isZooming = false;
                },

                openLightbox() {
                    this.lightboxOpen = true;
                },

                handleAddToBag(e) {
                    e.preventDefault();
                    this.addingToBag = true;

                    const form = document.getElementById('add-to-bag-form');
                    const formData = new FormData(form);

                    fetch('{{ route('cart.store') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(r => r.json())
                    .then(d => {
                        this.addingToBag = false;
                        this.addedSuccess = true;

                        // Update bag count badge if returned
                        if (d.cart_count) {
                            const badge = document.getElementById('header-bag-count');
                            if (badge) badge.innerText = d.cart_count;
                        }

                        // Subtle notification & cart drawer preview
                        if (window.Alpine && window.Alpine.store('toast')) {
                            window.Alpine.store('toast').show('Piece added to your shopping bag.', 'success');
                        }

                        setTimeout(() => {
                            this.addedSuccess = false;
                            if (window.Alpine && window.Alpine.store('cartDrawer')) {
                                window.dispatchEvent(new CustomEvent('cart-updated'));
                            window.Alpine.store('cartDrawer').open = true;
                            }
                        }, 900);
                    })
                    .catch(err => {
                        this.addingToBag = false;
                        form.submit(); // Graceful fallback to standard HTTP POST
                    });
                },

                handleBuyNow() {
                    const form = document.getElementById('add-to-bag-form');
                    const formData = new FormData(form);

                    fetch('{{ route('cart.store') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(() => {
                        window.location.href = '{{ route('cart.index') }}';
                    })
                    .catch(() => {
                        form.submit();
                    });
                },

                toggleWishlist() {
                    window.toggleMaisonWishlist(config.productId);
                    this.isWishlisted = !this.isWishlisted;
                },

                recordRecentlyViewedLocal() {
                    try {
                        let rv = JSON.parse(localStorage.getItem('mjh_recently_viewed') || '[]');
                        // Filter out current product
                        rv = rv.filter(p => p.id !== config.productId);
                        // Add current product at top
                        rv.unshift({
                            id: config.productId,
                            name: config.productName,
                            slug: config.productSlug,
                            url: window.location.href,
                            price: config.productPrice,
                            image: config.productImage,
                            category: '{{ $product->category->name ?? "Fine Jewellery" }}',
                            badge: '{{ $badge ?? "" }}'
                        });
                        // Limit to 8 items
                        if (rv.length > 8) rv = rv.slice(0, 8);
                        localStorage.setItem('mjh_recently_viewed', JSON.stringify(rv));
                    } catch(e) { console.debug(e); }
                },

                loadRecentlyViewed() {
                    try {
                        const rv = JSON.parse(localStorage.getItem('mjh_recently_viewed') || '[]');
                        // Exclude current product
                        this.recentlyViewedItems = rv.filter(p => p.id !== config.productId).slice(0, 4);
                    } catch(e) {
                        this.recentlyViewedItems = [];
                    }
                }
            };
        }
    </script>
</x-layouts.app>
