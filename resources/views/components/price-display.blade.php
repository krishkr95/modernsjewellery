@props([
    'price',
    'comparePrice' => null,
    'size' => 'base' // sm, base, lg, xl
])

@php
    $sizeClasses = match($size) {
        'sm' => 'text-xs',
        'lg' => 'text-lg sm:text-xl',
        'xl' => 'text-2xl sm:text-3xl font-serif',
        default => 'text-sm font-medium',
    };
@endphp

<div class="flex items-baseline space-x-2.5 font-sans">
    <span class="{{ $sizeClasses }} text-charcoal tracking-wide">
        ${{ number_format($price, 2) }}
    </span>

    @if($comparePrice && $comparePrice > $price)
        <span class="text-xs text-charcoal-muted line-through tracking-wider">
            ${{ number_format($comparePrice, 2) }}
        </span>
    @endif
</div>
