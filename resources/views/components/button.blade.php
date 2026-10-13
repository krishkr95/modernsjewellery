@props([
    'variant' => 'primary', // primary, outline, gold, ghost
    'size' => 'md', // sm, md, lg
    'href' => null,
    'type' => 'button',
])

@php
    $baseClasses = "inline-flex items-center justify-center font-sans tracking-[0.16em] uppercase font-medium transition-all duration-300 focus:outline-none";

    $sizeClasses = match($size) {
        'sm' => 'text-[11px] px-4 py-2.5',
        'lg' => 'text-xs px-9 py-4',
        default => 'text-xs px-7 py-3.5',
    };

    $variantClasses = match($variant) {
        'outline' => 'bg-transparent text-charcoal border border-charcoal hover:bg-charcoal hover:text-ivory',
        'gold' => 'bg-gold text-charcoal border border-gold hover:bg-noir hover:text-ivory hover:border-noir',
        'ghost' => 'bg-transparent text-charcoal hover:text-gold underline underline-offset-8',
        default => 'bg-noir text-ivory border border-noir hover:bg-gold hover:text-noir hover:border-gold',
    };

    $classes = "{$baseClasses} {$sizeClasses} {$variantClasses}";
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
