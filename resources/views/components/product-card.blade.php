@props([
    'product',
])

@php
    $primaryImg = $product->primaryImage ? $product->primaryImage->url : asset('assets/images/hero-luxury.jpg');
    $hoverImg = $product->images->where('is_primary', false)->first();
    $hoverImgPath = $hoverImg ? $hoverImg->url : $primaryImg;
    
    // Resolve badge
    $badge = $product->effective_badge;
    $productUrl = route('products.show', $product->slug);
    
    // BlueStone specific promotional perks
    $makingOffer = '50% off on Making Charges';
    if ($product->id % 3 === 0) {
        $makingOffer = '100% off on Making Charges';
    } elseif ($product->id % 2 === 0) {
        $makingOffer = 'Flat 10% off on Preset Solitaires';
    }
@endphp

<article class="bs-product-card group relative flex flex-col bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 font-sans"
         x-data="{ isWishlisted: window.isGuestWishlisted({{ $product->id }}) }">
    
    <!-- Image Box with hover swap & luxury zoom -->
    <div class="relative w-full aspect-square bg-[#f8fafc] overflow-hidden">
        
        <a href="{{ $productUrl }}" class="block w-full h-full relative" aria-label="View {{ $product->name }}">
            <!-- Main Studio Image -->
            <img src="{{ $primaryImg }}" 
                 alt="{{ $product->name }} — Studio Still" 
                 loading="lazy" decoding="async"
                 class="bs-card-img w-full h-full object-cover object-center group-hover:opacity-0 transition-all duration-500">

            <!-- Secondary Perspective / On-Model Hover Image -->
            <img src="{{ $hoverImgPath }}" 
                 alt="{{ $product->name }} — Detail View" 
                 loading="lazy" decoding="async"
                 class="bs-card-img w-full h-full object-cover object-center absolute inset-0 opacity-0 group-hover:opacity-100 transition-all duration-500">
        </a>

        <!-- Wishlist Button (Floating Circle Top-Left) -->
        <button type="button"
                @click.prevent="
                    window.toggleMaisonWishlist({{ $product->id }}, $el);
                    isWishlisted = !isWishlisted;
                "
                :class="isWishlisted ? 'text-[#f15d4c] bg-white shadow-md' : 'text-gray-400 hover:text-[#f15d4c] bg-white/90 hover:bg-white shadow-sm'"
                class="absolute top-3 left-3 p-2 rounded-full transition-all duration-200 z-10 border border-gray-200"
                aria-label="Save to Wishlist">
            <svg class="w-4 h-4 transition-transform duration-200 active:scale-125" 
                 :fill="isWishlisted ? 'currentColor' : 'none'" 
                 stroke="currentColor" 
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
        </button>

        <!-- Top-Right: Luxury Badge & 360° Studio Indicator -->
        <div class="absolute top-3 right-3 z-10 flex flex-col items-end gap-1.5">
            @if($product->has_3d_model)
                <a href="{{ $productUrl }}" 
                   style="background-color: #0f172a; color: #facc15; border: 1px solid rgba(250, 204, 21, 0.6); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);"
                   class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider backdrop-blur-md hover:scale-105 transition-all"
                   title="Interactive 360° Studio Available">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse" style="background-color: #34d399;"></span>
                    <span class="font-sans font-bold" style="color: #fde047; text-shadow: 0 1px 2px rgba(0,0,0,0.5);">360° Studio</span>
                </a>
            @endif
            @if($badge)
                <span class="inline-block bg-[#0a2240] text-white text-[8.5px] font-bold uppercase tracking-wider px-2 py-0.5 rounded shadow-xs">
                    {{ $badge }}
                </span>
            @endif
        </div>

        <!-- Quick View Overlay on Desktop Hover -->
        <div class="absolute inset-x-3 bottom-3 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 hidden sm:block z-10">
            <a href="{{ $productUrl }}" 
               class="block w-full text-center bg-[#f15d4c] hover:bg-[#d94b3a] text-white py-2 text-xs uppercase tracking-wider font-bold rounded-lg shadow-md transition-colors">
                BUY NOW
            </a>
        </div>
    </div>

    <!-- Product Metadata (BlueStone Card Format) -->
    <div class="p-3.5 sm:p-4 flex flex-col flex-1">
        <!-- Title & Spec -->
        <h3 class="text-xs sm:text-sm text-[#0a2240] font-semibold hover:text-[#f15d4c] transition-colors line-clamp-1 mb-1">
            <a href="{{ $productUrl }}">
                {{ $product->name }}
            </a>
        </h3>

        <p class="text-[11px] text-gray-500 line-clamp-1 mb-2 font-normal">
            {{ $product->metal_type ?? '18Kt Yellow Gold, Diamonds' }}
        </p>

        <!-- Price Display Block -->
        <div class="mt-auto pt-1">
            <div class="flex items-baseline space-x-2">
                <span class="text-sm sm:text-base font-bold text-[#0a2240]">
                    {{ $product->formatted_price }}
                </span>
                @if($product->compare_at_price && $product->compare_at_price > $product->base_price)
                    <span class="text-xs text-gray-400 line-through">
                        {{ $product->formatted_compare_price }}
                    </span>
                @endif
            </div>

            <!-- BlueStone Promo Tagline in Coral -->
            <div class="mt-1.5 flex items-center justify-between">
                <span class="inline-block text-[10px] font-semibold text-[#f15d4c] bg-[#fff0ed] px-2 py-0.5 rounded border border-[#ffe0d9]">
                    {{ $makingOffer }}
                </span>
            </div>
        </div>

        <!-- Mobile BUY NOW Button -->
        <div class="sm:hidden mt-3">
            <a href="{{ $productUrl }}" class="block w-full text-center py-2 bg-[#f15d4c] text-white text-[11px] font-bold rounded-md uppercase tracking-wider">
                BUY NOW
            </a>
        </div>
    </div>
</article>
