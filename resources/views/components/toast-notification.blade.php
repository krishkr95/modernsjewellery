<div x-data
     class="fixed bottom-6 right-6 z-50 flex flex-col space-y-3 pointer-events-none max-w-sm w-full">

    {{-- Blade Session Flash Toast --}}
    @if(session('toast'))
        <div x-data="{ show: true }"
             x-show="show"
             x-init="setTimeout(() => show = false, 5000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-3"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-3"
             class="pointer-events-auto bg-noir text-ivory border border-gold/40 shadow-xl p-4 flex items-start space-x-3">
            <span class="w-1.5 h-1.5 rounded-full bg-gold mt-1.5 flex-shrink-0"></span>
            <div class="flex-1 text-xs tracking-wider leading-relaxed">
                {{ is_array(session('toast')) ? session('toast')['message'] : session('toast') }}
            </div>
            <button @click="show = false" class="text-ivory-dark/60 hover:text-ivory transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    @endif

    {{-- Alpine Reactive Toasts --}}
    <template x-for="item in $store.toast.items" :key="item.id">
        <div x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-3"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-3"
             class="pointer-events-auto bg-noir text-ivory border border-gold/40 shadow-xl p-4 flex items-start space-x-3">
            <span class="w-1.5 h-1.5 rounded-full bg-gold mt-1.5 flex-shrink-0"></span>
            <div class="flex-1 text-xs tracking-wider leading-relaxed" x-text="item.message"></div>
            <button @click="$store.toast.remove(item.id)" class="text-ivory-dark/60 hover:text-ivory transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </template>
</div>
