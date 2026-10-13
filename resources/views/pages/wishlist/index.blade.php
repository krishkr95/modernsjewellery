<x-layouts.app title="Curated Wishlist | Modern Jewellery House">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        
        <x-breadcrumbs :items="[
            ['label' => 'Private Client Portal', 'url' => route('customer.dashboard')],
            ['label' => 'Curated Wishlist']
        ]" />

        <div class="text-center max-w-2xl mx-auto my-8 sm:my-12">
            <span class="text-[10px] uppercase tracking-[0.25em] text-gold-dark font-medium block mb-2">
                Private Archive
            </span>
            <h1 class="font-serif text-3xl sm:text-4xl text-charcoal font-normal mb-3">
                Your Saved Creations
            </h1>
            <p class="text-xs text-charcoal-muted leading-relaxed font-light">
                Pieces reserved in your personal ledger for future commissions or private consultation.
            </p>
        </div>

        @if($wishlist->items->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($wishlist->items as $item)
                    <div class="relative">
                        <x-product-card :product="$item->product" />
                    </div>
                @endforeach
            </div>
        @else
            <x-empty-state 
                title="Your Wishlist is Empty"
                description="Explore our fine collections and tap the heart icon on any masterwork to preserve it in your personal archive."
                actionText="Explore Fine Jewellery"
                :actionUrl="route('products.index')" />
        @endif

    </div>

</x-layouts.app>
