@props([
    'text' => 'Complimentary worldwide insured courier & bespoke gift presentation with every commission.',
    'link' => null,
    'linkText' => 'Learn More'
])

<div class="bg-noir text-ivory text-xs tracking-widest uppercase border-b border-border-dark/40 py-2.5 px-4 text-center transition-all duration-300">
    <div class="max-w-7xl mx-auto flex items-center justify-center space-x-3 text-[11px] font-normal">
        <span class="inline-block w-1.5 h-1.5 rounded-full bg-gold"></span>
        <span>{{ $text }}</span>
        @if($link)
            <a href="{{ $link }}" class="text-gold underline underline-offset-4 hover:text-ivory transition-colors">
                {{ $linkText }}
            </a>
        @endif
        <span class="inline-block w-1.5 h-1.5 rounded-full bg-gold"></span>
    </div>
</div>
