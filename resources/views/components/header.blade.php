{{-- ============================================================
     BLUESTONE EXACT MATCH HEADER
     Deep Navy Palette (#0a2240), Coral Accents (#f15d4c),
     Live Search, Utility Badges & Multi-Column Mega Menu
     ============================================================ --}}
<header class="sticky top-0 z-40 w-full max-w-full transition-all duration-300 shadow-md font-sans"
        x-data="{
            activeMega: null,
            megaTimer: null,
            searchOpen: false,
            searchQuery: '',
            accountMenuOpen: false,
            recentlyViewedOpen: false,
            setMega(menu) {
                clearTimeout(this.megaTimer);
                this.activeMega = menu;
            },
            leaveMega() {
                this.megaTimer = setTimeout(() => {
                    this.activeMega = null;
                }, 150);
            }
        }">

    @php
        $siteAnnouncement = \App\Models\Banner::active()->where('placement', 'announcement')->first();
    @endphp
    @if($siteAnnouncement)
        <aside aria-label="Announcement" class="w-full bg-[#0a2240] text-amber-300 py-1.5 px-3 sm:px-6 text-center text-xs font-medium tracking-wide flex items-center justify-center gap-2 border-b border-amber-400/20">
            @if($siteAnnouncement->tagline)
                <span class="px-2 py-0.5 bg-amber-400/20 text-amber-300 border border-amber-400/30 rounded-full text-[10px] font-bold uppercase tracking-wider">{{ $siteAnnouncement->tagline }}</span>
            @endif
            <span class="text-white text-[11px] sm:text-xs truncate max-w-xl">{{ $siteAnnouncement->title }}</span>
            @if($siteAnnouncement->cta_link)
                <a href="{{ $siteAnnouncement->cta_link }}" class="underline text-amber-300 font-bold text-[11px] sm:text-xs hover:text-white transition-colors flex-shrink-0">
                    {{ $siteAnnouncement->cta_text ?: 'Explore' }} &rarr;
                </a>
            @endif
        </aside>
    @endif

    <!-- Main Navigation Bar (Clean White Background as shown in BlueStone Screenshot) -->
    <div class="w-full max-w-full bg-white text-gray-800 border-b border-gray-200">
        <div class="max-w-[1700px] mx-auto px-2 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-14 sm:h-20 gap-1 sm:gap-4">
                
                <!-- Left: Mobile Nav Toggle & Brand Logo -->
                <div class="flex items-center gap-1 sm:gap-4 min-w-0 flex-shrink-0">
                    <button @click="$dispatch('toggle-mobile-nav')" 
                            class="lg:hidden w-7 h-7 sm:w-9 sm:h-9 flex items-center justify-center text-gray-700 hover:text-[#0a2240] hover:bg-gray-100 rounded-md transition-colors focus:outline-none flex-shrink-0"
                            aria-label="Open Navigation">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <a href="{{ route('home') }}" class="flex items-center gap-2 sm:gap-3.5 group min-w-0 py-1">
                        <!-- Modern Jewellery House Official 3D Emblem Logo -->
                        <img src="{{ asset('assets/images/logo.png') }}" 
                             alt="Modern Jewellery House Logo" 
                             class="w-8 h-8 sm:w-12 sm:h-12 lg:w-13 lg:h-13 aspect-square rounded-full object-contain drop-shadow-sm group-hover:scale-105 transition-transform duration-300 flex-shrink-0">
                        <div class="min-w-0 flex flex-col justify-center">
                            <span class="block font-serif text-xs sm:text-xl lg:text-[22px] tracking-[0.02em] sm:tracking-[0.04em] font-bold text-[#0a2240] group-hover:text-[#f15d4c] transition-colors whitespace-nowrap leading-tight">
                                <span class="sm:hidden">MODERN JEWELLERY</span>
                                <span class="hidden sm:inline">MODERN JEWELLERY HOUSE</span>
                            </span>
                            <span class="hidden sm:block text-[8px] sm:text-[9px] tracking-[0.25em] uppercase text-gray-500 font-sans mt-0.5 font-medium truncate">
                                Fine Jewellery Atelier &bull; Modern Luxury
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Center: Search Bar (Strictly Desktop Only) -->
                <div class="desktop-search-bar hidden sm:flex flex-1 max-w-xl mx-4 lg:mx-8 relative"
                     @click.away="searchOpen = false">
                    <form action="{{ route('shop') }}" method="GET" class="w-full">
                        <div class="relative flex items-center">
                            <input type="text" 
                                   name="search" 
                                   x-model="searchQuery"
                                   @focus="searchOpen = true"
                                   placeholder="Search Modern Jewellery House for Rings, Solitaires, Necklaces..." 
                                   class="w-full pl-11 pr-24 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-900 border border-gray-300 rounded-full text-xs font-sans placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0a2240] focus:bg-white shadow-xs transition-all">
                            
                            <!-- Search Icon Left -->
                            <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
                                </svg>
                            </div>

                            <!-- Search Button Right -->
                            <button type="submit" 
                                    class="absolute right-1 top-1/2 -translate-y-1/2 px-4 py-1.5 bg-[#f15d4c] hover:bg-[#d94b3a] text-white text-[11px] font-sans font-semibold uppercase tracking-wider rounded-full transition-colors shadow-xs">
                                Search
                            </button>
                        </div>
                    </form>

                    <!-- Instant Search Suggestions Dropdown -->
                    <div x-show="searchOpen"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-2"
                         class="absolute left-0 right-0 top-full mt-2 bg-white rounded-2xl shadow-2xl border border-gray-100 text-gray-800 p-4 z-50 animate-mega-menu">
                        
                        <div class="mb-3">
                            <span class="text-[10px] uppercase font-bold text-gray-400 tracking-wider block mb-2">Trending Searches</span>
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('shop', ['search' => 'solitaire']) }}" class="px-3 py-1 bg-gray-100 hover:bg-amber-50 hover:text-amber-800 rounded-full text-xs font-medium transition-colors">
                                    💎 Solitaire Rings
                                </a>
                                <a href="{{ route('shop', ['search' => 'evil eye']) }}" class="px-3 py-1 bg-gray-100 hover:bg-amber-50 hover:text-amber-800 rounded-full text-xs font-medium transition-colors">
                                    🧿 Evil Eye Pendants
                                </a>
                                <a href="{{ route('shop', ['category' => 'earrings']) }}" class="px-3 py-1 bg-gray-100 hover:bg-amber-50 hover:text-amber-800 rounded-full text-xs font-medium transition-colors">
                                    ✨ Diamond Studs
                                </a>
                                <a href="{{ route('shop', ['search' => 'mangalsutra']) }}" class="px-3 py-1 bg-gray-100 hover:bg-amber-50 hover:text-amber-800 rounded-full text-xs font-medium transition-colors">
                                    📿 Modern Mangalsutras
                                </a>
                                <a href="{{ route('shop', ['category' => 'coins']) }}" class="px-3 py-1 bg-gray-100 hover:bg-amber-50 hover:text-amber-800 rounded-full text-xs font-medium transition-colors">
                                    🪙 24Kt Gold Coins
                                </a>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                            <span>Browse certified jewellery pieces</span>
                            <a href="{{ route('shop') }}" class="text-[#f15d4c] font-semibold hover:underline">View All Designs &rarr;</a>
                        </div>
                    </div>
                </div>

                <!-- Right: Action Icons (Search, Recently Viewed, Stores, Wishlist, Cart, Account) -->
                <div class="flex items-center gap-1 sm:gap-5 flex-shrink-0 text-gray-700">
                    
                    <!-- Mobile Search Trigger Button -->
                    <button @click="$store.searchModal.toggle()" 
                            class="sm:hidden w-7 h-7 rounded-full flex items-center justify-center text-gray-700 hover:text-[#0a2240] hover:bg-gray-100 transition-colors" 
                            aria-label="Search">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
                        </svg>
                    </button>

                    <!-- Recently Viewed with Eye Icon (Desktop) -->
                    <a href="{{ route('shop') }}" 
                       class="hidden xl:flex flex-col items-center p-1 text-gray-600 hover:text-[#0a2240] transition-colors text-[10px]"
                       title="Recently Viewed">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span class="mt-0.5">Recent</span>
                    </a>

                    <!-- Store Locator (Desktop) -->
                    <button type="button"
                            @click="$store.storeModal.toggle()"
                            class="hidden lg:flex flex-col items-center p-1 text-gray-600 hover:text-[#0a2240] transition-colors text-[10px]"
                            title="Find a Store">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="mt-0.5">Stores</span>
                    </button>

                    <!-- Wishlist with Live Counter Badge -->
                    <a href="{{ Auth::check() ? route('customer.wishlist') : route('shop') }}" 
                       class="relative w-7 h-7 sm:w-auto sm:h-auto flex flex-col items-center justify-center text-gray-600 hover:text-[#f15d4c] hover:bg-gray-100 sm:hover:bg-transparent rounded-full sm:rounded-none transition-colors text-[10px]"
                       aria-label="Wishlist">
                        <div class="relative flex items-center justify-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            <span id="header-wishlist-count" 
                                  class="absolute -top-1 -right-1.5 sm:-top-1.5 sm:-right-2 bg-[#f15d4c] text-white text-[8px] sm:text-[9px] min-w-3.5 h-3.5 sm:min-w-4 sm:h-4 px-0.5 sm:px-1 rounded-full flex items-center justify-center font-bold shadow-xs">
                                0
                            </span>
                        </div>
                        <span class="mt-0.5 hidden sm:inline">Wishlist</span>
                    </a>

                    <!-- Shopping Cart / Bag with Live Counter Badge -->
                    <button @click="$store.cartDrawer.toggle()" 
                            class="relative w-7 h-7 sm:w-auto sm:h-auto flex flex-col items-center justify-center text-gray-600 hover:text-[#0a2240] hover:bg-gray-100 sm:hover:bg-transparent rounded-full sm:rounded-none transition-colors text-[10px]"
                            aria-label="Shopping Cart">
                        <div class="relative flex items-center justify-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            @php
                                $cartCount = 0;
                                if (Auth::check() && Auth::user()->activeCart) {
                                    $cartCount = Auth::user()->activeCart->total_items_count;
                                }
                            @endphp
                            <span id="header-bag-count" 
                                  class="absolute -top-1 -right-1.5 sm:-top-1.5 sm:-right-2 bg-[#0a2240] text-amber-300 text-[8px] sm:text-[9px] min-w-3.5 h-3.5 sm:min-w-4 sm:h-4 px-0.5 sm:px-1 rounded-full flex items-center justify-center font-bold shadow-xs">
                                {{ $cartCount }}
                            </span>
                        </div>
                        <span class="mt-0.5 hidden sm:inline">Cart</span>
                    </button>

                    <!-- Account / Auth Link -->
                    @auth
                        <div class="relative" @click.outside="accountMenuOpen = false" @click.away="accountMenuOpen = false">
                            <button @click="accountMenuOpen = !accountMenuOpen"
                                    type="button"
                                    class="w-8 h-8 sm:w-auto sm:h-auto flex flex-col items-center justify-center text-gray-700 hover:text-[#0a2240] hover:bg-gray-100 sm:hover:bg-transparent rounded-full sm:rounded-none transition-colors text-[10px]"
                                    aria-label="Account">
                                <div class="relative w-6 h-6 sm:w-7 sm:h-7 rounded-full p-[1.5px] bg-gradient-to-tr from-[#B38728] via-[#FBF5B7] to-[#DAA520] shadow-xs flex-shrink-0">
                                    <img src="{{ Auth::user()->avatar_url }}"
                                         alt="{{ Auth::user()->name }}"
                                         class="w-full h-full rounded-full object-cover">
                                </div>
                                <span class="mt-0.5 hidden sm:inline font-medium text-gray-800 max-w-[70px] truncate">{{ explode(' ', Auth::user()->name)[0] }}</span>
                            </button>

                            <!-- Account Dropdown Menu -->
                            <div x-show="accountMenuOpen"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                                 x-cloak
                                 class="absolute right-0 top-full mt-2 w-56 sm:w-64 bg-white rounded-2xl shadow-2xl py-2.5 text-gray-800 text-xs z-[100] border border-gray-100">
                                
                                <!-- User Identity Banner -->
                                <div class="px-4 py-2.5 border-b border-gray-100 flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-full p-[1.5px] bg-gradient-to-tr from-[#B38728] via-[#FBF5B7] to-[#DAA520] shadow-xs flex-shrink-0">
                                        <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="w-full h-full rounded-full object-cover">
                                    </div>
                                    <div class="overflow-hidden flex-1">
                                        <p class="font-bold text-gray-900 truncate text-xs">{{ Auth::user()->name }}</p>
                                        <p class="text-[10px] text-gray-400 truncate">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>

                                <div class="py-1">
                                    <button type="button" 
                                            @click="$dispatch('open-avatar-modal'); accountMenuOpen = false" 
                                            class="w-full text-left px-4 py-2 hover:bg-amber-50/70 text-amber-900 font-medium flex items-center space-x-2.5 transition-colors">
                                        <svg class="w-4 h-4 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span>Change Profile Picture</span>
                                    </button>

                                    @if(Auth::user()->hasRole(['SUPER_ADMIN', 'ADMIN', 'MANAGER', 'STAFF']))
                                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2.5 px-4 py-2 hover:bg-amber-50/50 font-semibold text-amber-800 transition-colors">
                                            <svg class="w-4 h-4 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                            </svg>
                                            <span>Admin Dashboard</span>
                                        </a>
                                    @endif

                                    <a href="{{ route('customer.dashboard') }}" class="flex items-center space-x-2.5 px-4 py-2 hover:bg-gray-50 text-gray-700 transition-colors">
                                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                        </svg>
                                        <span>My Orders &amp; Profile</span>
                                    </a>

                                    <a href="{{ route('customer.wishlist') }}" class="flex items-center space-x-2.5 px-4 py-2 hover:bg-gray-50 text-gray-700 transition-colors">
                                        <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                        <span>My Wishlist</span>
                                    </a>
                                </div>

                                <div class="border-t border-gray-100 my-1"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-rose-600 hover:bg-rose-50 flex items-center space-x-2.5 font-medium transition-colors">
                                        <svg class="w-4 h-4 text-rose-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        <span>Sign Out</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" 
                           class="w-7 h-7 sm:w-auto sm:h-auto flex flex-col items-center justify-center text-gray-600 hover:text-[#0a2240] hover:bg-gray-100 sm:hover:bg-transparent rounded-full sm:rounded-none transition-colors text-[10px]"
                           title="Sign In">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="mt-0.5 hidden sm:inline">Profile</span>
                        </a>
                    @endauth

                </div>

            </div>
        </div>
    </div>

    <!-- Category Strip & Multi-Column Mega Menu (BlueStone Desktop) -->
    <div class="hidden lg:block bg-white border-b border-gray-200 relative"
         @mouseleave="leaveMega()">
        <div class="max-w-[1700px] mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center justify-between text-[12px] font-sans font-semibold tracking-wide text-gray-800">
                
                <!-- 10+1 Monthly Plans -->
                <div class="py-3" @mouseenter="setMega('monthly')">
                    <a href="{{ route('shop', ['offer' => 'monthly-plan']) }}" 
                       class="flex items-center gap-1.5 text-amber-700 hover:text-amber-900 transition-colors py-1 border-b-2 border-transparent hover:border-amber-500 font-bold">
                        <span>10+1 Monthly Plans</span>
                        <span class="bg-amber-100 text-amber-800 text-[9px] px-1.5 py-0.5 rounded uppercase font-bold">Offer</span>
                    </a>
                </div>

                <!-- Watch Jewellery -->
                <div class="py-3" @mouseenter="setMega('watch')">
                    <a href="{{ route('shop', ['search' => 'watch']) }}" 
                       class="hover:text-[#f15d4c] transition-colors py-1 border-b-2 border-transparent hover:border-[#f15d4c]">
                        Watch Jewellery
                    </a>
                </div>

                <!-- Rings -->
                <div class="py-3" @mouseenter="setMega('rings')">
                    <a href="{{ route('shop', ['category' => 'rings']) }}" 
                       class="hover:text-[#f15d4c] transition-colors py-1 border-b-2 border-transparent hover:border-[#f15d4c]">
                        Rings
                    </a>
                </div>

                <!-- Earrings -->
                <div class="py-3" @mouseenter="setMega('earrings')">
                    <a href="{{ route('shop', ['category' => 'earrings']) }}" 
                       class="hover:text-[#f15d4c] transition-colors py-1 border-b-2 border-transparent hover:border-[#f15d4c]">
                        Earrings
                    </a>
                </div>

                <!-- Pendants -->
                <div class="py-3" @mouseenter="setMega('pendants')">
                    <a href="{{ route('shop', ['search' => 'pendant']) }}" 
                       class="hover:text-[#f15d4c] transition-colors py-1 border-b-2 border-transparent hover:border-[#f15d4c]">
                        Pendants
                    </a>
                </div>

                <!-- Solitaires -->
                <div class="py-3" @mouseenter="setMega('solitaires')">
                    <a href="{{ route('shop', ['search' => 'solitaire']) }}" 
                       class="hover:text-[#f15d4c] transition-colors py-1 border-b-2 border-transparent hover:border-[#f15d4c]">
                        Solitaires
                    </a>
                </div>

                <!-- All Jewellery -->
                <div class="py-3" @mouseenter="setMega('all_jewellery')">
                    <a href="{{ route('shop') }}" 
                       class="hover:text-[#f15d4c] transition-colors py-1 border-b-2 border-transparent hover:border-[#f15d4c]">
                        All Jewellery
                    </a>
                </div>

                <!-- Gifts -->
                <div class="py-3" @mouseenter="setMega('gifts')">
                    <a href="{{ route('shop', ['search' => 'gift']) }}" 
                       class="hover:text-[#f15d4c] transition-colors py-1 border-b-2 border-transparent hover:border-[#f15d4c]">
                        Gifts
                    </a>
                </div>

                <!-- Coins -->
                <div class="py-3" @mouseenter="setMega('coins')">
                    <a href="{{ route('shop', ['category' => 'coins']) }}" 
                       class="hover:text-[#f15d4c] transition-colors py-1 border-b-2 border-transparent hover:border-[#f15d4c]">
                        Coins
                    </a>
                </div>

                <!-- Offers (Special Badge) -->
                <div class="py-3" @mouseenter="setMega('offers')">
                    <a href="{{ route('shop', ['offer' => 'special']) }}" 
                       class="flex items-center gap-1.5 text-[#f15d4c] hover:text-[#d94b3a] transition-colors py-1 border-b-2 border-transparent hover:border-[#f15d4c] font-bold">
                        <span class="w-2 h-2 rounded-full bg-[#f15d4c] animate-ping"></span>
                        <span>Offers</span>
                    </a>
                </div>

            </nav>
        </div>

        <!-- ========================================================
             MEGA MENU DROPDOWNS (BlueStone Exact Category Layout)
             ======================================================== -->
        
        <!-- MEGA 1: RINGS -->
        <div x-show="activeMega === 'rings'"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="absolute left-0 right-0 top-full bg-white shadow-2xl border-t border-gray-100 z-50">
            <div class="max-w-[1700px] mx-auto px-8 py-8 grid grid-cols-5 gap-8 text-xs font-sans">
                <!-- Col 1: Shop by Style -->
                <div>
                    <h4 class="font-bold text-[#0a2240] uppercase tracking-wider mb-3 text-[11px] pb-1 border-b border-gray-100">By Style</h4>
                    <ul class="space-y-2 text-gray-600 font-normal">
                        <li><a href="{{ route('shop', ['category' => 'rings', 'sort' => 'popular']) }}" class="hover:text-[#f15d4c] transition-colors">All Rings (By Popularity)</a></li>
                        <li><a href="{{ route('shop', ['category' => 'rings', 'sort' => 'newest']) }}" class="hover:text-[#f15d4c] transition-colors">Latest Designs</a></li>
                        <li><a href="{{ route('shop', ['search' => 'solitaire ring']) }}" class="hover:text-[#f15d4c] transition-colors font-medium text-gray-800">Solitaire Rings</a></li>
                        <li><a href="{{ route('shop', ['search' => 'engagement ring']) }}" class="hover:text-[#f15d4c] transition-colors">Engagement Rings</a></li>
                        <li><a href="{{ route('shop', ['search' => 'couple band']) }}" class="hover:text-[#f15d4c] transition-colors">Couple Bands</a></li>
                        <li><a href="{{ route('shop', ['search' => 'eternity ring']) }}" class="hover:text-[#f15d4c] transition-colors">Eternity Bands</a></li>
                        <li><a href="{{ route('shop', ['search' => 'cocktail ring']) }}" class="hover:text-[#f15d4c] transition-colors">Cocktail Rings</a></li>
                        <li><a href="{{ route('shop', ['search' => 'stackable ring']) }}" class="hover:text-[#f15d4c] transition-colors">Stackable Rings</a></li>
                    </ul>
                </div>

                <!-- Col 2: Shop by Metal -->
                <div>
                    <h4 class="font-bold text-[#0a2240] uppercase tracking-wider mb-3 text-[11px] pb-1 border-b border-gray-100">Metal &amp; Purity</h4>
                    <ul class="space-y-2 text-gray-600 font-normal">
                        <li><a href="{{ route('shop', ['category' => 'rings', 'metal' => 'yellow-gold']) }}" class="hover:text-[#f15d4c] transition-colors">18Kt Yellow Gold</a></li>
                        <li><a href="{{ route('shop', ['category' => 'rings', 'metal' => 'rose-gold']) }}" class="hover:text-[#f15d4c] transition-colors">18Kt Rose Gold</a></li>
                        <li><a href="{{ route('shop', ['category' => 'rings', 'metal' => 'white-gold']) }}" class="hover:text-[#f15d4c] transition-colors">White Gold</a></li>
                        <li><a href="{{ route('shop', ['category' => 'rings', 'metal' => 'platinum']) }}" class="hover:text-[#f15d4c] transition-colors">Platinum Rings</a></li>
                        <li><a href="{{ route('shop', ['category' => 'rings', 'metal' => '22kt']) }}" class="hover:text-[#f15d4c] transition-colors">22Kt Plain Gold</a></li>
                    </ul>
                </div>

                <!-- Col 3: Shop by Price -->
                <div>
                    <h4 class="font-bold text-[#0a2240] uppercase tracking-wider mb-3 text-[11px] pb-1 border-b border-gray-100">Price Range</h4>
                    <ul class="space-y-2 text-gray-600 font-normal">
                        <li><a href="{{ route('shop', ['category' => 'rings', 'max_price' => 10000]) }}" class="hover:text-[#f15d4c] transition-colors">Below ₹10,000</a></li>
                        <li><a href="{{ route('shop', ['category' => 'rings', 'min_price' => 10000, 'max_price' => 20000]) }}" class="hover:text-[#f15d4c] transition-colors">₹10,000 - ₹20,000</a></li>
                        <li><a href="{{ route('shop', ['category' => 'rings', 'min_price' => 20000, 'max_price' => 30000]) }}" class="hover:text-[#f15d4c] transition-colors">₹20,000 - ₹30,000</a></li>
                        <li><a href="{{ route('shop', ['category' => 'rings', 'min_price' => 30000, 'max_price' => 50000]) }}" class="hover:text-[#f15d4c] transition-colors">₹30,000 - ₹50,000</a></li>
                        <li><a href="{{ route('shop', ['category' => 'rings', 'min_price' => 50000]) }}" class="hover:text-[#f15d4c] transition-colors font-medium text-amber-700">₹50,000 &amp; Above</a></li>
                    </ul>
                </div>

                <!-- Col 4: Occasion -->
                <div>
                    <h4 class="font-bold text-[#0a2240] uppercase tracking-wider mb-3 text-[11px] pb-1 border-b border-gray-100">Occasion</h4>
                    <ul class="space-y-2 text-gray-600 font-normal">
                        <li><a href="{{ route('shop', ['category' => 'rings', 'search' => 'daily wear']) }}" class="hover:text-[#f15d4c] transition-colors">Daily Wear</a></li>
                        <li><a href="{{ route('shop', ['category' => 'rings', 'search' => 'office']) }}" class="hover:text-[#f15d4c] transition-colors">Office Wear</a></li>
                        <li><a href="{{ route('shop', ['category' => 'rings', 'search' => 'wedding']) }}" class="hover:text-[#f15d4c] transition-colors">Bridal &amp; Wedding</a></li>
                        <li><a href="{{ route('shop', ['category' => 'rings', 'search' => 'anniversary']) }}" class="hover:text-[#f15d4c] transition-colors">Anniversary Gifts</a></li>
                    </ul>
                </div>

                <!-- Col 5: Featured Card -->
                <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl p-4 border border-amber-200 flex flex-col justify-between">
                    <div>
                        <span class="inline-block px-2 py-0.5 bg-[#f15d4c] text-white text-[9px] uppercase tracking-wider font-bold rounded mb-2">HOT SELLER</span>
                        <h5 class="font-serif text-base text-[#0a2240] font-normal mb-1">The Odalia Solitaire Ring</h5>
                        <p class="text-[11px] text-gray-600 mb-3">18Kt Yellow Gold &bull; Certified IGI Diamonds</p>
                        <img src="{{ asset('assets/images/aurelia-solitaire-diamond-ring-1.jpg') }}" alt="Odalia Ring" class="w-full h-28 object-cover rounded-lg shadow-sm mb-3">
                    </div>
                    <a href="{{ route('shop', ['category' => 'rings']) }}" class="text-[11px] font-bold text-[#f15d4c] hover:underline flex items-center justify-between">
                        <span>Explore 2,800+ Rings</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- MEGA 2: EARRINGS -->
        <div x-show="activeMega === 'earrings'"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="absolute left-0 right-0 top-full bg-white shadow-2xl border-t border-gray-100 z-50">
            <div class="max-w-[1700px] mx-auto px-8 py-8 grid grid-cols-5 gap-8 text-xs font-sans">
                <div>
                    <h4 class="font-bold text-[#0a2240] uppercase tracking-wider mb-3 text-[11px] pb-1 border-b border-gray-100">By Style</h4>
                    <ul class="space-y-2 text-gray-600 font-normal">
                        <li><a href="{{ route('shop', ['category' => 'earrings']) }}" class="hover:text-[#f15d4c] transition-colors">All Earrings</a></li>
                        <li><a href="{{ route('shop', ['search' => 'studs']) }}" class="hover:text-[#f15d4c] transition-colors font-medium">Stud Earrings</a></li>
                        <li><a href="{{ route('shop', ['search' => 'drops']) }}" class="hover:text-[#f15d4c] transition-colors">Drop Earrings</a></li>
                        <li><a href="{{ route('shop', ['search' => 'hoops']) }}" class="hover:text-[#f15d4c] transition-colors">Hoops &amp; Huggies</a></li>
                        <li><a href="{{ route('shop', ['search' => 'danglers']) }}" class="hover:text-[#f15d4c] transition-colors">Danglers</a></li>
                        <li><a href="{{ route('shop', ['search' => 'sui dhaga']) }}" class="hover:text-[#f15d4c] transition-colors">Sui Dhaga</a></li>
                        <li><a href="{{ route('shop', ['search' => 'jhumka']) }}" class="hover:text-[#f15d4c] transition-colors">Jhumkas &amp; Chandbalis</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-[#0a2240] uppercase tracking-wider mb-3 text-[11px] pb-1 border-b border-gray-100">Stones &amp; Metals</h4>
                    <ul class="space-y-2 text-gray-600 font-normal">
                        <li><a href="{{ route('shop', ['category' => 'earrings', 'stone' => 'diamond']) }}" class="hover:text-[#f15d4c] transition-colors">Diamond Earrings</a></li>
                        <li><a href="{{ route('shop', ['category' => 'earrings', 'stone' => 'gemstone']) }}" class="hover:text-[#f15d4c] transition-colors">Gemstone &amp; Ruby</a></li>
                        <li><a href="{{ route('shop', ['category' => 'earrings', 'stone' => 'pearl']) }}" class="hover:text-[#f15d4c] transition-colors">Pearl Earrings</a></li>
                        <li><a href="{{ route('shop', ['category' => 'earrings', 'metal' => 'plain-gold']) }}" class="hover:text-[#f15d4c] transition-colors">22Kt Plain Gold</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-[#0a2240] uppercase tracking-wider mb-3 text-[11px] pb-1 border-b border-gray-100">Price</h4>
                    <ul class="space-y-2 text-gray-600 font-normal">
                        <li><a href="{{ route('shop', ['category' => 'earrings', 'max_price' => 10000]) }}" class="hover:text-[#f15d4c] transition-colors">Under ₹10,000</a></li>
                        <li><a href="{{ route('shop', ['category' => 'earrings', 'min_price' => 10000, 'max_price' => 20000]) }}" class="hover:text-[#f15d4c] transition-colors">₹10,000 - ₹20,000</a></li>
                        <li><a href="{{ route('shop', ['category' => 'earrings', 'min_price' => 20000, 'max_price' => 40000]) }}" class="hover:text-[#f15d4c] transition-colors">₹20,000 - ₹40,000</a></li>
                        <li><a href="{{ route('shop', ['category' => 'earrings', 'min_price' => 40000]) }}" class="hover:text-[#f15d4c] transition-colors font-medium text-amber-700">₹40,000 &amp; Above</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-[#0a2240] uppercase tracking-wider mb-3 text-[11px] pb-1 border-b border-gray-100">Featured</h4>
                    <ul class="space-y-2 text-gray-600 font-normal">
                        <li><a href="{{ route('shop', ['search' => 'chandbali']) }}" class="hover:text-[#f15d4c] transition-colors">Festive Chandbalis</a></li>
                        <li><a href="{{ route('shop', ['search' => 'ear climber']) }}" class="hover:text-[#f15d4c] transition-colors">Ear Climbers</a></li>
                        <li><a href="{{ route('shop', ['search' => 'solitaire studs']) }}" class="hover:text-[#f15d4c] transition-colors">Certified Solitaire Studs</a></li>
                    </ul>
                </div>
                <div class="bg-gradient-to-br from-rose-50 to-amber-50 rounded-xl p-4 border border-rose-200 flex flex-col justify-between">
                    <div>
                        <span class="inline-block px-2 py-0.5 bg-[#f15d4c] text-white text-[9px] uppercase tracking-wider font-bold rounded mb-2">NEW IN</span>
                        <h5 class="font-serif text-base text-[#0a2240] font-normal mb-1">Verdant Empress Emerald Drops</h5>
                        <p class="text-[11px] text-gray-600 mb-3">Natural Emeralds &bull; Brilliant Cut Diamonds</p>
                        <img src="{{ asset('assets/images/verdant-empress-emerald-drops-1.jpg') }}" alt="Emerald Drops" class="w-full h-28 object-cover rounded-lg shadow-sm mb-3">
                    </div>
                    <a href="{{ route('shop', ['category' => 'earrings']) }}" class="text-[11px] font-bold text-[#f15d4c] hover:underline flex items-center justify-between">
                        <span>Explore 1,900+ Earrings</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- MEGA 3: SOLITAIRES -->
        <div x-show="activeMega === 'solitaires'"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="absolute left-0 right-0 top-full bg-white shadow-2xl border-t border-gray-100 z-50">
            <div class="max-w-[1700px] mx-auto px-8 py-8 grid grid-cols-4 gap-8 text-xs font-sans">
                <div>
                    <h4 class="font-bold text-[#0a2240] uppercase tracking-wider mb-3 text-[11px] pb-1 border-b border-gray-100">Preset Solitaires</h4>
                    <ul class="space-y-2 text-gray-600 font-normal">
                        <li><a href="{{ route('shop', ['search' => 'preset solitaire ring']) }}" class="hover:text-[#f15d4c] transition-colors">Preset Solitaire Rings</a></li>
                        <li><a href="{{ route('shop', ['search' => 'preset solitaire pendant']) }}" class="hover:text-[#f15d4c] transition-colors">Preset Solitaire Pendants</a></li>
                        <li><a href="{{ route('shop', ['search' => 'preset solitaire earrings']) }}" class="hover:text-[#f15d4c] transition-colors">Preset Solitaire Earrings</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-[#0a2240] uppercase tracking-wider mb-3 text-[11px] pb-1 border-b border-gray-100">Diamond Shapes</h4>
                    <ul class="space-y-2 text-gray-600 font-normal">
                        <li><a href="{{ route('shop', ['search' => 'round diamond']) }}" class="hover:text-[#f15d4c] transition-colors">Round Brilliant</a></li>
                        <li><a href="{{ route('shop', ['search' => 'princess diamond']) }}" class="hover:text-[#f15d4c] transition-colors">Princess Cut</a></li>
                        <li><a href="{{ route('shop', ['search' => 'pear diamond']) }}" class="hover:text-[#f15d4c] transition-colors">Pear &amp; Oval</a></li>
                        <li><a href="{{ route('shop', ['search' => 'marquise diamond']) }}" class="hover:text-[#f15d4c] transition-colors">Marquise</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-[#0a2240] uppercase tracking-wider mb-3 text-[11px] pb-1 border-b border-gray-100">Certification</h4>
                    <div class="p-3 bg-gray-50 rounded-lg border border-gray-100 text-gray-600 leading-relaxed text-[11px]">
                        <span class="font-bold text-[#0a2240] block mb-1">✓ GIA &amp; IGI Certified</span>
                        Every solitaire diamond includes laser inscription &amp; authentic grading certificate.
                    </div>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-200 flex flex-col justify-between">
                    <div>
                        <span class="inline-block px-2 py-0.5 bg-[#0a2240] text-white text-[9px] uppercase tracking-wider font-bold rounded mb-2">FLAT 10% OFF</span>
                        <h5 class="font-serif text-base text-[#0a2240] font-normal mb-1">Bespoke Solitaire Rings</h5>
                        <p class="text-[11px] text-gray-600 mb-3">Starting from 0.30 Ct to 2.50+ Ct</p>
                        <img src="{{ asset('assets/images/aurelia-solitaire-diamond-ring-2.jpg') }}" alt="Solitaire" class="w-full h-28 object-cover rounded-lg shadow-sm mb-3">
                    </div>
                    <a href="{{ route('shop', ['search' => 'solitaire']) }}" class="text-[11px] font-bold text-[#0a2240] hover:underline flex items-center justify-between">
                        <span>Browse Solitaires &rarr;</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- MEGA 4: 10+1 MONTHLY PLANS -->
        <div x-show="activeMega === 'monthly'"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="absolute left-0 right-0 top-full bg-white shadow-2xl border-t border-gray-100 z-50">
            <div class="max-w-[1700px] mx-auto px-8 py-8 grid grid-cols-3 gap-8 text-xs font-sans">
                <div class="p-6 bg-amber-50 rounded-2xl border border-amber-200">
                    <span class="text-[10px] uppercase font-bold text-amber-800 tracking-wider">How It Works</span>
                    <h4 class="font-serif text-xl text-[#0a2240] font-normal my-2">Pay 10 Installments, 11th on BlueStone</h4>
                    <p class="text-gray-600 leading-relaxed text-xs mb-4">
                        Deposit a fixed amount every month for 10 months. BlueStone contributes the 11th month installment completely free! Redeem against any gold or diamond jewellery.
                    </p>
                    <a href="{{ route('shop', ['offer' => 'monthly-plan']) }}" class="inline-block px-5 py-2 bg-amber-600 hover:bg-amber-700 text-white font-bold rounded-full text-xs">
                        Start Monthly Plan
                    </a>
                </div>
                <div>
                    <h4 class="font-bold text-[#0a2240] uppercase tracking-wider mb-3 text-[11px] pb-1 border-b border-gray-100">Key Benefits</h4>
                    <ul class="space-y-2 text-gray-600 font-normal">
                        <li>✓ 100% Contribution on 11th installment</li>
                        <li>✓ Lock in today's gold rate with Gold Mine scheme</li>
                        <li>✓ Redeem on 8,000+ jewellery designs</li>
                        <li>✓ No hidden charges or cancellation fees</li>
                    </ul>
                </div>
                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 text-center flex flex-col items-center justify-center">
                    <div class="w-12 h-12 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center font-bold text-lg mb-2">10+1</div>
                    <h5 class="font-serif text-lg text-gray-900 font-normal">India's Most Trusted Jewellery Plan</h5>
                    <p class="text-xs text-gray-500 mt-1">Over 2,00,000+ happy subscribers</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Mobile Secondary Category Bar (Horizontally Scrollable) -->
    <div class="lg:hidden w-full max-w-full bg-white border-b border-gray-200 overflow-x-auto scrollbar-none py-2 px-3 flex items-center space-x-4 text-[11px] font-sans font-medium uppercase tracking-wider text-gray-700 whitespace-nowrap">
        <a href="{{ route('shop') }}" class="text-[#f15d4c] font-bold">All Designs</a>
        <a href="{{ route('shop', ['category' => 'rings']) }}" class="hover:text-[#f15d4c]">Rings</a>
        <a href="{{ route('shop', ['category' => 'earrings']) }}" class="hover:text-[#f15d4c]">Earrings</a>
        <a href="{{ route('shop', ['search' => 'pendant']) }}" class="hover:text-[#f15d4c]">Pendants</a>
        <a href="{{ route('shop', ['search' => 'solitaire']) }}" class="hover:text-[#f15d4c]">Solitaires</a>
        <a href="{{ route('shop', ['search' => 'mangalsutra']) }}" class="hover:text-[#f15d4c]">Mangalsutra</a>
        <a href="{{ route('shop', ['category' => 'bracelets']) }}" class="hover:text-[#f15d4c]">Bracelets</a>
        <a href="{{ route('shop', ['category' => 'coins']) }}" class="hover:text-[#f15d4c]">Coins</a>
        <a href="{{ route('shop', ['offer' => 'special']) }}" class="text-amber-700 font-bold">10+1 Plans</a>
    </div>

</header>
