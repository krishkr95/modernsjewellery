@props([
    'featuredProducts' => collect(),
    'newArrivals' => collect(),
])

{{-- ============================================================
     BLUESTONE EXACT MATCH — 4-COLUMN PRODUCT LISTING GRID
     4 cards per row, pure white cards, wishlist hearts, 
     exact ring titles, prices in ₹, and discount badges in red
     ============================================================ --}}
<section id="products-listing-grid" class="py-10 sm:py-14 bg-[#f8fafc] border-b border-gray-200 select-none font-sans">
    <div class="max-w-[1700px] mx-auto px-3 sm:px-6 lg:px-8">
        
        <!-- Header / Subtitle Filter Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 mb-6 border-b border-gray-200 gap-4">
            <div>
                <span class="text-[10px] sm:text-xs uppercase tracking-widest text-gray-500 font-semibold block mb-0.5">
                    Modern Jewellery House Atelier Catalog
                </span>
                <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl text-[#0a2240] font-normal tracking-tight">
                    Rings &bull; 2,400+ Certified Designs
                </h2>
            </div>

            <!-- Sort / Quick Filter Tags -->
            <div class="flex items-center gap-2 overflow-x-auto scrollbar-none pb-1">
                <span class="text-xs text-gray-500 mr-1 hidden sm:inline">Sort:</span>
                <a href="{{ route('shop', ['sort' => 'popular']) }}" 
                   class="px-4 py-1.5 bg-[#0a2240] text-white rounded-full text-xs font-semibold shadow-xs">
                    Popular
                </a>
                <a href="{{ route('shop', ['sort' => 'newest']) }}" 
                   class="px-4 py-1.5 bg-white text-gray-700 hover:bg-gray-100 border border-gray-200 rounded-full text-xs font-semibold transition-colors">
                    New Arrivals
                </a>
                <a href="{{ route('shop', ['sort' => 'price_low']) }}" 
                   class="px-4 py-1.5 bg-white text-gray-700 hover:bg-gray-100 border border-gray-200 rounded-full text-xs font-semibold transition-colors">
                    Price: Low to High
                </a>
                <a href="{{ route('shop', ['offer' => 'special']) }}" 
                   class="px-4 py-1.5 bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200 rounded-full text-xs font-semibold transition-colors">
                    Offers
                </a>
                <a href="{{ route('shop', ['has_3d' => '1']) }}" 
                   style="background-color: #fffbeb; color: #92400e; border: 1px solid #f59e0b; font-weight: 700;"
                   class="px-4 py-1.5 rounded-full text-xs transition-colors inline-flex items-center gap-1.5 hover:bg-amber-100 shadow-2xs">
                    <span class="w-2 h-2 rounded-full animate-pulse" style="background-color: #10b981;"></span>
                    <span style="color: #92400e; font-weight: 700;">360° Studio</span>
                </a>
            </div>
        </div>

        <!-- 4-Column Product Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-5">
            @forelse($featuredProducts as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-4 text-center py-16 text-gray-400 text-sm">
                    No products found.
                </div>
            @endforelse
        </div>

        <!-- Load More / Full Catalog Banner -->
        <div class="mt-12 text-center">
            <a href="{{ route('shop') }}" 
               class="inline-flex items-center gap-2 px-10 py-3.5 bg-[#f15d4c] hover:bg-[#d94b3a] text-white font-bold text-xs uppercase tracking-wider rounded-full shadow-md hover:shadow-xl transition-all duration-300">
                <span>View All 8,000+ Jewellery Designs</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

    </div>
</section>
