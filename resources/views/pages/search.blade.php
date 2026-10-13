<x-layouts.app :title="'Search Results: ' . $query . ' | Modern Jewellery House'">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        
        <x-breadcrumbs :items="[
            ['label' => 'Search Archives'],
            ['label' => $query ? '“' . $query . '”' : 'All Query Results']
        ]" />

        <div class="my-8">
            <h1 class="font-serif text-3xl sm:text-4xl text-charcoal font-normal">
                Results for <span class="italic">“{{ $query }}”</span>
            </h1>
            <p class="text-xs text-charcoal-muted uppercase tracking-widest mt-1">
                {{ $products->count() }} {{ Str::plural('piece', $products->count()) }} discovered
            </p>
        </div>

        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @else
            <x-empty-state 
                title="No Matching Creations"
                description="We could not find any fine jewellery matching your search terms. Consider trying broader terms such as 'diamond', 'ring', or 'gold'."
                actionText="Explore Full Catalogue"
                :actionUrl="route('products.index')" />
        @endif

    </div>

</x-layouts.app>
