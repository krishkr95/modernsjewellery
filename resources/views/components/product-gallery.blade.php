@props([
    'images' => [],
    'productName' => 'Jewellery Piece'
])

<div x-data="{ 
        activeImage: '{{ $images->first() ? $images->first()->url : asset('assets/images/hero-luxury.jpg') }}',
        activeThumb: 0
     }" 
     class="flex flex-col-reverse md:flex-row gap-4">
    
    <!-- Vertical Thumbnail Rail -->
    @if($images->count() > 1)
        <div class="flex md:flex-col gap-3 overflow-x-auto md:overflow-y-auto max-h-[600px] py-1 no-scrollbar">
            @foreach($images as $index => $img)
                <button type="button"
                        @click="activeImage = '{{ $img->url }}'; activeThumb = {{ $index }}"
                        :class="activeThumb === {{ $index }} ? 'border-charcoal opacity-100' : 'border-border-subtle opacity-70 hover:opacity-100'"
                        class="w-16 h-16 sm:w-20 sm:h-20 flex-shrink-0 border bg-[#F5F2EC] overflow-hidden transition-all duration-200">
                    <img src="{{ $img->url }}" 
                         alt="{{ $img->alt_text ?? $productName }}" 
                         class="w-full h-full object-cover">
                </button>
            @endforeach
        </div>
    @endif


    <!-- Main Large Image View -->
    <div class="flex-1 relative aspect-square bg-[#F5F2EC] overflow-hidden border border-border-subtle">
        <img :src="activeImage" 
             alt="{{ $productName }}" 
             class="w-full h-full object-cover object-center transition-all duration-500">
             
        <div class="absolute bottom-4 right-4 bg-ivory-light/90 px-3 py-1 text-[10px] uppercase tracking-widest text-charcoal border border-border-subtle">
            Haute Atelier Studio
        </div>
    </div>
</div>
