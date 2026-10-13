@props([
    'paginator'
])

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between border-t border-border-subtle py-8 mt-12 text-xs tracking-[0.16em] uppercase">
        <div class="flex-1 flex justify-start">
            @if ($paginator->onFirstPage())
                <span class="text-charcoal-muted/40 cursor-not-allowed">
                    Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="text-charcoal hover:text-gold transition-colors">
                    Previous
                </a>
            @endif
        </div>

        <div class="hidden sm:flex items-center space-x-4">
            @foreach ($paginator->links()->elements as $element)
                @if (is_string($element))
                    <span class="text-charcoal-muted px-2">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-8 h-8 rounded-full border border-charcoal bg-charcoal text-ivory flex items-center justify-center font-medium">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="w-8 h-8 rounded-full border border-transparent hover:border-border-subtle flex items-center justify-center text-charcoal hover:text-gold transition-all">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        <div class="flex-1 flex justify-end">
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="text-charcoal hover:text-gold transition-colors">
                    Next
                </a>
            @else
                <span class="text-charcoal-muted/40 cursor-not-allowed">
                    Next
                </span>
            @endif
        </div>
    </nav>
@endif
