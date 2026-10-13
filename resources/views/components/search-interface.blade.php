<div x-show="$store.searchModal.open" 
     x-transition:enter="ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     style="display: none;"
     class="fixed inset-0 z-50 overflow-y-auto bg-noir/80 backdrop-blur-md">

    <div class="min-h-screen px-4 text-center flex flex-col justify-start pt-16 sm:pt-24 max-w-4xl mx-auto">
        <!-- Close button -->
        <div class="flex justify-end mb-6">
            <button @click="$store.searchModal.close()" 
                    class="p-2 text-ivory hover:text-gold transition-colors text-xs tracking-widest uppercase flex items-center space-x-2">
                <span>Close</span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Search Input Box -->
        <div class="relative w-full border-b border-border-subtle/40 pb-4">
            <form action="{{ route('search') }}" method="GET" @submit="$store.searchModal.close()">
                <input id="search-modal-input"
                       type="text" 
                       name="q"
                       x-model="$store.searchModal.query"
                       @input.debounce.350ms="$store.searchModal.search()"
                       placeholder="Search diamonds, solitaires, emeralds, 18k gold..." 
                       class="w-full bg-transparent text-ivory font-serif text-2xl sm:text-4xl text-center placeholder:text-ivory-dark/30 focus:outline-none">
            </form>
        </div>

        <!-- Suggestions / Quick Categories -->
        <div class="mt-6 flex flex-wrap items-center justify-center gap-3 text-[11px] uppercase tracking-[0.2em] text-ivory-dark/60">
            <span>Popular:</span>
            <a href="{{ route('products.index', ['category' => 'rings']) }}" @click="$store.searchModal.close()" class="text-gold hover:text-ivory transition-colors">Solitaire Rings</a>
            <span class="text-border-subtle/30">•</span>
            <a href="{{ route('products.index', ['category' => 'necklaces']) }}" @click="$store.searchModal.close()" class="text-gold hover:text-ivory transition-colors">Diamond Colliers</a>
            <span class="text-border-subtle/30">•</span>
            <a href="{{ route('products.index', ['collection' => 'heritage-noir']) }}" @click="$store.searchModal.close()" class="text-gold hover:text-ivory transition-colors">Heritage Noir</a>
        </div>

        <!-- Live Results Container -->
        <div class="mt-12 text-left" x-show="$store.searchModal.results.length > 0">
            <div class="flex items-center justify-between pb-3 border-b border-border-subtle/20 text-xs uppercase tracking-widest text-ivory-dark/70 mb-6">
                <span>Direct Matches (<span x-text="$store.searchModal.results.length"></span>)</span>
                <a :href="'/search?q=' + encodeURIComponent($store.searchModal.query)" 
                   @click="$store.searchModal.close()"
                   class="text-gold hover:text-ivory transition-colors">
                    View Complete Results →
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <template x-for="item in $store.searchModal.results" :key="item.id">
                    <a :href="item.url" 
                       @click="$store.searchModal.close()"
                       class="group flex items-center space-x-4 p-3 bg-noir-deep/60 hover:bg-noir-deep border border-border-subtle/20 transition-all">
                        <img :src="item.image" :alt="item.name" class="w-16 h-16 object-cover bg-charcoal flex-shrink-0">
                        <div class="flex-1 min-w-0">
                            <p class="text-[9px] uppercase tracking-widest text-gold truncate" x-text="item.category"></p>
                            <h4 class="font-serif text-sm text-ivory group-hover:text-gold transition-colors truncate" x-text="item.name"></h4>
                            <p class="text-xs text-ivory-dark/70 mt-1" x-text="item.price"></p>
                        </div>
                    </a>
                </template>
            </div>
        </div>

        <!-- Loading indicator inside search -->
        <div x-show="$store.searchModal.loading" class="mt-8 text-center text-xs tracking-widest text-gold uppercase">
            Searching archive...
        </div>
    </div>
</div>
