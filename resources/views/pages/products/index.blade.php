<x-layouts.app 
    title="{{ request('category') ? ucfirst(request('category')) . ' Catalogue | Modern Jewellery House' : 'Fine Jewellery Discovery Catalogue | Modern Jewellery House' }}"
    description="Discover the Modern Jewellery House collection: ethically crafted rings, colliers, cuffs, and earrings in 18k recycled gold, platinum, and naturally certified GIA diamonds."
    canonical="{{ route('shop') }}"
    :schemaJsonLd="$schemaJsonLd ?? null">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12" 
         x-data="{ 
            mobileFiltersOpen: false,
            searchQuery: '{{ request('search') ?? request('q') ?? '' }}'
         }">
        
        <!-- Breadcrumbs -->
        <x-breadcrumbs :items="[
            ['label' => 'Maison Catalogue', 'url' => route('shop')],
            ['label' => request('category') ? ucfirst(request('category')) : (request('collection') ? ucwords(str_replace('-', ' ', request('collection'))) : 'All Creations')]
        ]" />

        <!-- Editorial Hero Header -->
        <div class="text-center max-w-3xl mx-auto my-8 sm:my-14">
            <span class="text-[10px] uppercase tracking-[0.3em] text-gold-dark font-medium block mb-2.5">
                Haute Lapidary & Atelier Creations
            </span>
            <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl text-charcoal font-normal tracking-tight mb-4">
                @if(request('search'))
                    Search: “{{ request('search') }}”
                @elseif(request('category'))
                    {{ ucfirst(request('category')) }}
                @elseif(request('collection'))
                    {{ ucwords(str_replace('-', ' ', request('collection'))) }} Collection
                @else
                    Fine Jewellery Discovery
                @endif
            </h1>
            <div class="w-12 h-[1px] bg-gold-dark mx-auto mb-4"></div>
            <p class="text-xs sm:text-sm text-charcoal-muted leading-relaxed font-light max-w-2xl mx-auto">
                Individual masterworks forged in certified recycled 18-karat gold and platinum 950. Every diamond and coloured gemstone is individually verified for conflict-free provenance and extraordinary scintillation.
            </p>
        </div>

        <!-- Filter & Sort Bar (Top Bar) -->
        <div class="border-y border-border-subtle py-4 mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                
                <!-- Left: Filter Drawer Trigger & Active Count -->
                <div class="flex items-center space-x-4">
                    <button type="button" 
                            @click="mobileFiltersOpen = !mobileFiltersOpen"
                            class="inline-flex items-center space-x-2 text-xs uppercase tracking-widest font-medium text-charcoal hover:text-gold-dark transition-colors py-1.5 px-3 border border-border-subtle hover:border-charcoal bg-ivory">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        <span>Filter & Refine</span>
                        @if($activeFiltersCount > 0)
                            <span class="bg-charcoal text-ivory text-[10px] w-4 h-4 rounded-full flex items-center justify-center font-sans ml-1">
                                {{ $activeFiltersCount }}
                            </span>
                        @endif
                    </button>

                    <!-- Fast Category Links -->
                    <div class="hidden lg:flex items-center space-x-5 text-[11px] tracking-[0.18em] uppercase font-medium text-charcoal-muted border-l border-border-subtle pl-5">
                        <a href="{{ route('shop') }}" 
                           class="{{ !request('category') && !request('collection') ? 'text-charcoal border-b border-charcoal font-semibold' : 'hover:text-charcoal' }} pb-0.5 transition-colors">
                            All
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('shop', array_merge(request()->except(['category', 'page']), ['category' => $cat->slug])) }}" 
                               class="{{ request('category') === $cat->slug ? 'text-charcoal border-b border-charcoal font-semibold' : 'hover:text-charcoal' }} pb-0.5 transition-colors whitespace-nowrap">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Right: Pieces Count & Sorting -->
                <div class="flex items-center justify-between md:justify-end space-x-6">
                    <span class="text-xs text-charcoal-muted tracking-wider uppercase font-light hidden sm:inline">
                        {{ $products->total() }} {{ Str::plural('Creation', $products->total()) }}
                    </span>

                    <form action="{{ route('shop') }}" method="GET" id="sort-form" class="flex items-center space-x-2.5">
                        {{-- Keep active query parameters --}}
                        @foreach(request()->except(['sort', 'page']) as $key => $val)
                            @if(is_array($val))
                                @foreach($val as $subVal)
                                    <input type="hidden" name="{{ $key }}[]" value="{{ $subVal }}">
                                @endforeach
                            @elseif($val)
                                <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                            @endif
                        @endforeach

                        <label for="sort" class="text-[11px] uppercase tracking-wider text-charcoal-muted font-normal whitespace-nowrap">
                            Sort By:
                        </label>
                        <select id="sort" name="sort" onchange="this.form.submit()" 
                                class="bg-ivory border border-border-subtle text-xs tracking-wider uppercase px-3 py-1.5 focus:outline-none focus:border-charcoal cursor-pointer">
                            <option value="featured" {{ $sort === 'featured' ? 'selected' : '' }}>Featured</option>
                            <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="price_asc" {{ $sort === 'price_asc' ? 'selected' : '' }}>Price low to high</option>
                            <option value="price_desc" {{ $sort === 'price_desc' ? 'selected' : '' }}>Price high to low</option>
                            <option value="best_selling" {{ $sort === 'best_selling' || $sort === 'bestselling' ? 'selected' : '' }}>Best selling</option>
                            <option value="top_rated" {{ $sort === 'top_rated' ? 'selected' : '' }}>Top rated</option>
                        </select>
                    </form>
                </div>

            </div>

            <!-- Active Filter Badges -->
            @if($activeFiltersCount > 0)
                <div class="flex flex-wrap items-center gap-2 pt-3 mt-3 border-t border-border-subtle/50 text-[11px]">
                    <span class="text-charcoal-muted uppercase tracking-wider text-[10px]">Active Filters:</span>
                    
                    @if(request('search'))
                        <span class="inline-flex items-center space-x-1.5 bg-ivory px-2.5 py-1 border border-border-subtle">
                            <span>Keyword: “{{ request('search') }}”</span>
                            <a href="{{ route('shop', request()->except('search')) }}" class="hover:text-gold-dark font-bold">×</a>
                        </span>
                    @endif

                    @if(request('category'))
                        <span class="inline-flex items-center space-x-1.5 bg-ivory px-2.5 py-1 border border-border-subtle">
                            <span>Category: {{ ucfirst(request('category')) }}</span>
                            <a href="{{ route('shop', request()->except('category')) }}" class="hover:text-gold-dark font-bold">×</a>
                        </span>
                    @endif

                    @if(request('collection'))
                        <span class="inline-flex items-center space-x-1.5 bg-ivory px-2.5 py-1 border border-border-subtle">
                            <span>Collection: {{ ucwords(str_replace('-', ' ', request('collection'))) }}</span>
                            <a href="{{ route('shop', request()->except('collection')) }}" class="hover:text-gold-dark font-bold">×</a>
                        </span>
                    @endif

                    @if(request('material'))
                        <span class="inline-flex items-center space-x-1.5 bg-ivory px-2.5 py-1 border border-border-subtle">
                            <span>Material: {{ request('material') }}</span>
                            <a href="{{ route('shop', request()->except('material')) }}" class="hover:text-gold-dark font-bold">×</a>
                        </span>
                    @endif

                    @if(request('gemstone'))
                        <span class="inline-flex items-center space-x-1.5 bg-ivory px-2.5 py-1 border border-border-subtle">
                            <span>Gemstone: {{ request('gemstone') }}</span>
                            <a href="{{ route('shop', request()->except('gemstone')) }}" class="hover:text-gold-dark font-bold">×</a>
                        </span>
                    @endif

                    @if(request('occasion'))
                        <span class="inline-flex items-center space-x-1.5 bg-ivory px-2.5 py-1 border border-border-subtle">
                            <span>Occasion: {{ request('occasion') }}</span>
                            <a href="{{ route('shop', request()->except('occasion')) }}" class="hover:text-gold-dark font-bold">×</a>
                        </span>
                    @endif

                    @if(request('availability'))
                        <span class="inline-flex items-center space-x-1.5 bg-ivory px-2.5 py-1 border border-border-subtle">
                            <span>In Stock Only</span>
                            <a href="{{ route('shop', request()->except('availability')) }}" class="hover:text-gold-dark font-bold">×</a>
                        </span>
                    @endif

                    @if(request('min_price') || request('max_price'))
                        <span class="inline-flex items-center space-x-1.5 bg-ivory px-2.5 py-1 border border-border-subtle">
                            <span>Price Range: {{ request('min_price') ? '$' . request('min_price') : '$0' }} – {{ request('max_price') ? '$' . request('max_price') : 'Any' }}</span>
                            <a href="{{ route('shop', request()->except(['min_price', 'max_price'])) }}" class="hover:text-gold-dark font-bold">×</a>
                        </span>
                    @endif

                    <a href="{{ route('shop') }}" class="text-[10px] uppercase tracking-wider text-gold-dark underline hover:text-charcoal ml-2 font-medium">
                        Clear all
                    </a>
                </div>
            @endif
        </div>

        <!-- Layout Grid: Refine Filter Drawer/Sidebar + Products Grid -->
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 items-start">
            
            <!-- Filters Drawer / Sidebar -->
            <aside class="w-full lg:w-72 flex-shrink-0"
                   :class="mobileFiltersOpen ? 'block' : 'hidden lg:block'"
                   x-transition>
                
                <div class="bg-ivory border border-border-subtle p-6 space-y-7 shadow-sm sticky top-28">
                    
                    <div class="flex items-center justify-between border-b border-border-subtle/80 pb-4">
                        <span class="text-xs uppercase tracking-[0.25em] font-medium text-charcoal">
                            Refine Catalogue
                        </span>
                        <a href="{{ route('shop') }}" class="text-[10px] uppercase tracking-wider text-charcoal-muted hover:text-gold-dark">
                            Reset
                        </a>
                    </div>

                    <form action="{{ route('shop') }}" method="GET" class="space-y-6">
                        @if(request('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif

                        <!-- Search within Catalog -->
                        <div>
                            <label for="catalog-search" class="block text-[10px] uppercase tracking-[0.2em] font-medium text-charcoal mb-2">
                                Search Pieces
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       id="catalog-search"
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Diamond, Solitaire, 18k..."
                                       class="w-full bg-ivory-light border border-border-subtle px-3 py-2 text-xs tracking-wider text-charcoal placeholder:text-charcoal-muted/50 focus:outline-none focus:border-charcoal">
                                @if(request('search'))
                                    <a href="{{ route('shop', request()->except('search')) }}" class="absolute right-2.5 top-2.5 text-xs text-charcoal-muted hover:text-charcoal">×</a>
                                @endif
                            </div>
                        </div>

                        <!-- Category Filtering -->
                        <div class="border-t border-border-subtle/60 pt-4" x-data="{ open: true }">
                            <button type="button" @click="open = !open" class="w-full flex items-center justify-between text-left text-[11px] uppercase tracking-[0.2em] font-medium text-charcoal">
                                <span>Category</span>
                                <span class="text-sm font-serif" x-text="open ? '−' : '+'">−</span>
                            </button>
                            <div x-show="open" class="mt-3 space-y-2 text-xs">
                                @foreach($categories as $cat)
                                    <label class="flex items-center justify-between cursor-pointer group">
                                        <div class="flex items-center space-x-2">
                                            <input type="radio" 
                                                   name="category" 
                                                   value="{{ $cat->slug }}" 
                                                   {{ request('category') === $cat->slug ? 'checked' : '' }}
                                                   onchange="this.form.submit()"
                                                   class="text-charcoal focus:ring-gold-dark">
                                            <span class="text-charcoal-muted group-hover:text-charcoal font-light">{{ $cat->name }}</span>
                                        </div>
                                        <span class="text-[10px] text-charcoal-muted/60">({{ $cat->products_count }})</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Collection Filtering -->
                        <div class="border-t border-border-subtle/60 pt-4" x-data="{ open: true }">
                            <button type="button" @click="open = !open" class="w-full flex items-center justify-between text-left text-[11px] uppercase tracking-[0.2em] font-medium text-charcoal">
                                <span>Collection</span>
                                <span class="text-sm font-serif" x-text="open ? '−' : '+'">−</span>
                            </button>
                            <div x-show="open" class="mt-3 space-y-2 text-xs">
                                @foreach($collections as $col)
                                    <label class="flex items-center justify-between cursor-pointer group">
                                        <div class="flex items-center space-x-2">
                                            <input type="radio" 
                                                   name="collection" 
                                                   value="{{ $col->slug }}" 
                                                   {{ request('collection') === $col->slug ? 'checked' : '' }}
                                                   onchange="this.form.submit()"
                                                   class="text-charcoal focus:ring-gold-dark">
                                            <span class="text-charcoal-muted group-hover:text-charcoal font-light">{{ $col->name }}</span>
                                        </div>
                                        <span class="text-[10px] text-charcoal-muted/60">({{ $col->products_count }})</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Material Filtering -->
                        <div class="border-t border-border-subtle/60 pt-4" x-data="{ open: true }">
                            <button type="button" @click="open = !open" class="w-full flex items-center justify-between text-left text-[11px] uppercase tracking-[0.2em] font-medium text-charcoal">
                                <span>Material</span>
                                <span class="text-sm font-serif" x-text="open ? '−' : '+'">−</span>
                            </button>
                            <div x-show="open" class="mt-3 space-y-2 text-xs">
                                @foreach($materials as $matKey => $matLabel)
                                    <label class="flex items-center space-x-2 cursor-pointer group">
                                        <input type="radio" 
                                               name="material" 
                                               value="{{ $matKey }}" 
                                               {{ request('material') === $matKey ? 'checked' : '' }}
                                               onchange="this.form.submit()"
                                               class="text-charcoal focus:ring-gold-dark">
                                        <span class="text-charcoal-muted group-hover:text-charcoal font-light">{{ $matLabel }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Gemstone Filtering -->
                        <div class="border-t border-border-subtle/60 pt-4" x-data="{ open: true }">
                            <button type="button" @click="open = !open" class="w-full flex items-center justify-between text-left text-[11px] uppercase tracking-[0.2em] font-medium text-charcoal">
                                <span>Gemstone</span>
                                <span class="text-sm font-serif" x-text="open ? '−' : '+'">−</span>
                            </button>
                            <div x-show="open" class="mt-3 space-y-2 text-xs">
                                @foreach($gemstones as $gemKey => $gemLabel)
                                    <label class="flex items-center space-x-2 cursor-pointer group">
                                        <input type="radio" 
                                               name="gemstone" 
                                               value="{{ $gemKey }}" 
                                               {{ request('gemstone') === $gemKey ? 'checked' : '' }}
                                               onchange="this.form.submit()"
                                               class="text-charcoal focus:ring-gold-dark">
                                        <span class="text-charcoal-muted group-hover:text-charcoal font-light">{{ $gemLabel }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Occasion Filtering -->
                        <div class="border-t border-border-subtle/60 pt-4" x-data="{ open: true }">
                            <button type="button" @click="open = !open" class="w-full flex items-center justify-between text-left text-[11px] uppercase tracking-[0.2em] font-medium text-charcoal">
                                <span>Occasion</span>
                                <span class="text-sm font-serif" x-text="open ? '−' : '+'">−</span>
                            </button>
                            <div x-show="open" class="mt-3 space-y-2 text-xs">
                                @foreach($occasions as $occKey => $occLabel)
                                    <label class="flex items-center space-x-2 cursor-pointer group">
                                        <input type="radio" 
                                               name="occasion" 
                                               value="{{ $occKey }}" 
                                               {{ request('occasion') === $occKey ? 'checked' : '' }}
                                               onchange="this.form.submit()"
                                               class="text-charcoal focus:ring-gold-dark">
                                        <span class="text-charcoal-muted group-hover:text-charcoal font-light">{{ $occLabel }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Filtering -->
                        <div class="border-t border-border-subtle/60 pt-4" x-data="{ open: true }">
                            <button type="button" @click="open = !open" class="w-full flex items-center justify-between text-left text-[11px] uppercase tracking-[0.2em] font-medium text-charcoal">
                                <span>Price Range</span>
                                <span class="text-sm font-serif" x-text="open ? '−' : '+'">−</span>
                            </button>
                            <div x-show="open" class="mt-3 space-y-3">
                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    <div>
                                        <span class="text-[9px] uppercase tracking-wider text-charcoal-muted block mb-1">Min ($)</span>
                                        <input type="number" 
                                               name="min_price" 
                                               value="{{ request('min_price') }}" 
                                               placeholder="0"
                                               class="w-full bg-ivory-light border border-border-subtle px-2 py-1.5 text-xs text-charcoal focus:outline-none focus:border-charcoal">
                                    </div>
                                    <div>
                                        <span class="text-[9px] uppercase tracking-wider text-charcoal-muted block mb-1">Max ($)</span>
                                        <input type="number" 
                                               name="max_price" 
                                               value="{{ request('max_price') }}" 
                                               placeholder="50000"
                                               class="w-full bg-ivory-light border border-border-subtle px-2 py-1.5 text-xs text-charcoal focus:outline-none focus:border-charcoal">
                                    </div>
                                </div>
                                <button type="submit" class="w-full py-1.5 bg-ivory-light border border-border-subtle text-[10px] uppercase tracking-widest text-charcoal hover:bg-gold hover:text-noir transition-colors">
                                    Apply Price Filter
                                </button>
                            </div>
                        </div>

                        <!-- Availability Filtering -->
                        <div class="border-t border-border-subtle/60 pt-4">
                            <label class="flex items-center space-x-2 cursor-pointer group">
                                <input type="checkbox" 
                                       name="availability" 
                                       value="in_stock"
                                       {{ request('availability') === 'in_stock' ? 'checked' : '' }}
                                       onchange="this.form.submit()"
                                       class="rounded text-charcoal focus:ring-gold-dark">
                                <span class="text-xs text-charcoal-muted group-hover:text-charcoal font-light">
                                    Available in Atelier Only
                                </span>
                            </label>
                        </div>

                        <!-- Apply Button -->
                        <div class="pt-2">
                            <button type="submit" class="w-full btn-luxury-primary text-[10px] py-3">
                                Filter Results
                            </button>
                        </div>
                    </form>

                </div>
            </aside>

            <!-- Product Grid Area -->
            <div class="flex-1 w-full">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
                        @foreach($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>

                    <!-- Luxury Pagination -->
                    <div class="mt-14 pt-8 border-t border-border-subtle">
                        <x-pagination :paginator="$products" />
                    </div>
                @else
                    <x-empty-state 
                        title="No Jewellery Creations Found" 
                        description="We currently have no available jewellery pieces matching your selected refine criteria. Please reset your filters or request a bespoke commission through our private concierge."
                        actionText="Reset All Filters"
                        :actionUrl="route('shop')" />
                @endif
            </div>

        </div>

    </div>

</x-layouts.app>
