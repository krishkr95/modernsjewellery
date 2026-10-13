@props([
    'title' => 'No Creations Found',
    'description' => 'We could not find pieces matching your desired criteria. Explore our full high jewellery collection or speak directly with our concierge.',
    'actionText' => 'Discover Fine Jewellery',
    'actionUrl' => route('products.index'),
])

<div class="text-center py-20 px-6 max-w-lg mx-auto border border-dashed border-border-subtle bg-ivory/50">
    <!-- Subtle diamond icon ornament -->
    <div class="w-12 h-12 mx-auto mb-4 border border-border-subtle rounded-full flex items-center justify-center text-gold">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M12 3l8 6-8 12-8-12 8-6z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M4 9h16M9 9l3 12 3-12"/>
        </svg>
    </div>
    
    <h3 class="font-serif text-xl sm:text-2xl text-charcoal font-normal tracking-wide mb-3">
        {{ $title }}
    </h3>
    
    <p class="text-xs text-charcoal-muted leading-relaxed font-light mb-8 max-w-md mx-auto">
        {{ $description }}
    </p>

    @if($actionText && $actionUrl)
        <x-button :href="$actionUrl" variant="outline" size="md">
            {{ $actionText }}
        </x-button>
    @endif
</div>
