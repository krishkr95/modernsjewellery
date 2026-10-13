@props([
    'name',
    'side' => 'right', // 'right' or 'left'
    'title' => null,
])

<div x-data="{ open: false }"
     x-show="open"
     x-on:open-drawer.window="if ($event.detail === '{{ $name }}') open = true"
     x-on:close-drawer.window="if ($event.detail === '{{ $name }}') open = false"
     x-on:keydown.escape.window="open = false"
     style="display: none;"
     class="fixed inset-0 z-50 overflow-hidden">

    <!-- Backdrop -->
    <div x-show="open"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false"
         class="fixed inset-0 bg-noir/70 backdrop-blur-sm transition-opacity"></div>

    <!-- Panel -->
    <div class="fixed inset-y-0 {{ $side === 'right' ? 'right-0' : 'left-0' }} max-w-full flex">
        <aside x-show="open"
               x-transition:enter="transform transition ease-in-out duration-300"
               x-transition:enter-start="{{ $side === 'right' ? 'translate-x-full' : '-translate-x-full' }}"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transform transition ease-in-out duration-200"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="{{ $side === 'right' ? 'translate-x-full' : '-translate-x-full' }}"
               class="w-screen max-w-md bg-ivory-light border-{{ $side === 'right' ? 'l' : 'r' }} border-border-subtle shadow-2xl flex flex-col justify-between">
            
            <div class="p-6 border-b border-border-subtle flex items-center justify-between">
                @if($title)
                    <h3 class="font-serif text-lg text-charcoal uppercase tracking-widest font-normal">{{ $title }}</h3>
                @endif
                <button @click="open = false" class="p-2 text-charcoal-muted hover:text-charcoal transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto p-6">
                {{ $slot }}
            </div>

            @if(isset($footer))
                <div class="p-6 border-t border-border-subtle bg-ivory">
                    {{ $footer }}
                </div>
            @endif
        </aside>
    </div>
</div>
