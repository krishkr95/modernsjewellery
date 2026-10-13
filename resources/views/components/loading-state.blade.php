@props([
    'text' => 'Curating creations...'
])

<div class="flex flex-col items-center justify-center p-12 space-y-4">
    <!-- Restrained gold spinner with dual-ring precision -->
    <div class="relative w-10 h-10">
        <div class="w-10 h-10 border border-border-subtle rounded-full"></div>
        <div class="w-10 h-10 border-t-2 border-gold rounded-full animate-spin absolute top-0 left-0"></div>
    </div>
    <p class="text-xs uppercase tracking-[0.22em] text-charcoal-muted font-light">
        {{ $text }}
    </p>
</div>
