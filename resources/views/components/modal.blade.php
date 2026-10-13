@props([
    'name',
    'title' => null,
])

<div x-data="{ show: false }"
     x-show="show"
     x-on:open-modal.window="if ($event.detail === '{{ $name }}') show = true"
     x-on:close-modal.window="if ($event.detail === '{{ $name }}') show = false"
     x-on:keydown.escape.window="show = false"
     style="display: none;"
     class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center">

    <!-- Backdrop -->
    <div x-show="show" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="show = false" 
         class="fixed inset-0 bg-noir/70 backdrop-blur-sm transition-opacity"></div>

    <!-- Modal Panel -->
    <div x-show="show"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="relative bg-ivory-light border border-border-subtle shadow-2xl max-w-lg w-full p-6 sm:p-8 z-10 transition-all">

        <!-- Header -->
        <div class="flex items-center justify-between pb-4 border-b border-border-subtle mb-6">
            @if($title)
                <h3 class="font-serif text-xl text-charcoal font-normal tracking-wide">{{ $title }}</h3>
            @endif
            <button @click="show = false" class="text-charcoal-muted hover:text-charcoal p-1 transition-colors" aria-label="Close modal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Content -->
        <div>
            {{ $slot }}
        </div>
    </div>
</div>
