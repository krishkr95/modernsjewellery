<div x-data="{ open: false }" 
     @toggle-mobile-nav.window="open = !open" 
     @keydown.escape.window="open = false" 
     class="lg:hidden">

    <!-- Mobile Drawer Overlay -->
    <div x-show="open" 
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false" 
         class="fixed inset-0 bg-noir/70 backdrop-blur-sm z-50"></div>

    <!-- Mobile Drawer Panel -->
    <aside x-show="open"
           x-transition:enter="transition ease-out duration-300 transform"
           x-transition:enter-start="-translate-x-full"
           x-transition:enter-end="translate-x-0"
           x-transition:leave="transition ease-in duration-200 transform"
           x-transition:leave-start="translate-x-0"
           x-transition:leave-end="-translate-x-full"
           class="fixed inset-y-0 left-0 max-w-xs w-full bg-ivory-light shadow-2xl z-50 flex flex-col justify-between overflow-y-auto border-r border-border-subtle p-6">
        
        <div>
            <!-- Header inside drawer -->
            <div class="flex items-center justify-between pb-6 border-b border-border-subtle">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Modern Jewellery House Logo" class="w-8 h-8 rounded-full object-cover border border-amber-400/40 shadow-xs flex-shrink-0">
                    <span class="font-serif text-sm tracking-wider text-charcoal font-bold uppercase leading-tight">Modern Jewellery</span>
                </a>
                <button @click="open = false" class="p-2 text-charcoal hover:text-gold transition-colors" aria-label="Close menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Links -->
            <nav class="mt-8 space-y-5 text-sm tracking-[0.16em] uppercase">
                <a href="{{ route('products.index') }}" @click="open = false" 
                   class="block py-2 text-charcoal hover:text-gold font-medium border-b border-border-subtle/50">
                    All Creations
                </a>
                <a href="{{ route('products.index', ['category' => 'rings']) }}" @click="open = false" 
                   class="block py-2 text-charcoal hover:text-gold font-medium border-b border-border-subtle/50">
                    Rings
                </a>
                <a href="{{ route('products.index', ['category' => 'necklaces']) }}" @click="open = false" 
                   class="block py-2 text-charcoal hover:text-gold font-medium border-b border-border-subtle/50">
                    Necklaces
                </a>
                <a href="{{ route('products.index', ['category' => 'earrings']) }}" @click="open = false" 
                   class="block py-2 text-charcoal hover:text-gold font-medium border-b border-border-subtle/50">
                    Earrings
                </a>
                <a href="{{ route('products.index', ['category' => 'bracelets']) }}" @click="open = false" 
                   class="block py-2 text-charcoal hover:text-gold font-medium border-b border-border-subtle/50">
                    Bracelets
                </a>
                <a href="{{ route('products.index', ['category' => 'high-jewellery']) }}" @click="open = false" 
                   class="block py-2 text-gold-dark hover:text-charcoal font-medium border-b border-border-subtle/50">
                    High Jewellery
                </a>
                <a href="{{ route('products.index', ['collection' => 'heritage-noir']) }}" @click="open = false" 
                   class="block py-2 text-charcoal hover:text-gold font-medium border-b border-border-subtle/50">
                    Collections
                </a>
            </nav>
        </div>

        <!-- Mobile Bottom Concierge & Account -->
        <div class="pt-8 border-t border-border-subtle space-y-4">
            @auth
                <div class="text-xs uppercase tracking-wider text-charcoal-muted">
                    Signed in as <span class="font-medium text-charcoal">{{ Auth::user()->name }}</span>
                </div>
                <div class="flex flex-col space-y-2 text-xs tracking-wider uppercase">
                    @if(Auth::user()->hasRole(['SUPER_ADMIN', 'ADMIN', 'MANAGER', 'STAFF']))
                        <a href="{{ route('admin.dashboard') }}" class="py-1 text-gold-dark font-medium">Maison Admin Portal</a>
                    @endif
                    <a href="{{ route('customer.dashboard') }}" class="py-1 hover:text-gold">Private Client Account</a>
                    <a href="{{ route('customer.wishlist') }}" class="py-1 hover:text-gold">Curated Wishlist</a>
                    <form method="POST" action="{{ route('logout') }}" class="pt-2">
                        @csrf
                        <button type="submit" class="text-xs uppercase tracking-widest text-charcoal-muted hover:text-charcoal">Sign Out</button>
                    </form>
                </div>
            @else
                <div class="flex items-center space-x-4 text-xs tracking-wider uppercase">
                    <a href="{{ route('login') }}" class="py-2 text-charcoal hover:text-gold">Sign In</a>
                    <span class="text-border-subtle">/</span>
                    <a href="{{ route('register') }}" class="py-2 text-gold-dark hover:text-charcoal font-medium">Register</a>
                </div>
            @endauth

            <div class="pt-4 text-[11px] text-charcoal-muted tracking-widest uppercase">
                Concierge: +1 (800) 492-9180
            </div>
        </div>
    </aside>
</div>
