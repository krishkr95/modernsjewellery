@props([
    'items' => []
])

<nav aria-label="Breadcrumb" class="py-4 text-[11px] uppercase tracking-[0.18em] text-charcoal-muted">
    <ol class="flex items-center space-x-2">
        <li>
            <a href="{{ route('home') }}" class="hover:text-charcoal transition-colors">Maison</a>
        </li>
        @foreach($items as $item)
            <li class="flex items-center space-x-2">
                <span class="text-border-subtle font-light">/</span>
                @if(isset($item['url']) && !$loop->last)
                    <a href="{{ $item['url'] }}" class="hover:text-charcoal transition-colors">
                        {{ $item['label'] }}
                    </a>
                @else
                    <span class="text-charcoal font-medium" aria-current="page">
                        {{ $item['label'] }}
                    </span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
