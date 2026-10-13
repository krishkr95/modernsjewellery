{{-- ============================================================
     BLUESTONE EXACT MATCH — BOUTIQUE STORE LOCATOR MODAL
     ============================================================ --}}
<div x-data
     x-show="$store.storeModal.open"
     x-cloak
     class="relative z-50 font-sans"
     aria-labelledby="store-modal-title" 
     role="dialog" 
     aria-modal="true">

    <div x-show="$store.storeModal.open"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="$store.storeModal.close()"
         class="fixed inset-0 bg-[#0a2240]/80 backdrop-blur-sm transition-opacity"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            
            <div x-show="$store.storeModal.open"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:scale-95"
                 class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-xl border border-gray-100">
                
                <!-- Modal Header -->
                <div class="bg-[#0a2240] px-6 py-5 text-white flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-amber-400/20 text-amber-300 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-white">Find a BlueStone Store Near You</h3>
                            <p class="text-[11px] text-gray-300">180+ Stores across 75+ cities in India</p>
                        </div>
                    </div>
                    <button @click="$store.storeModal.close()" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- City Filter Pills -->
                <div class="p-4 border-b border-gray-100 bg-gray-50 flex items-center gap-2 overflow-x-auto scrollbar-none">
                    <template x-for="city in ['Mumbai', 'Delhi', 'Bengaluru']" :key="city">
                        <button type="button" 
                                @click="$store.storeModal.selectedCity = city"
                                :class="$store.storeModal.selectedCity === city ? 'bg-[#0a2240] text-white font-bold' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200'"
                                class="px-4 py-1.5 rounded-full text-xs transition-colors whitespace-nowrap"
                                x-text="city"></button>
                    </template>
                </div>

                <!-- Store List -->
                <div class="p-6 max-h-[380px] overflow-y-auto space-y-4">
                    <template x-for="store in $store.storeModal.stores.filter(s => s.city === $store.storeModal.selectedCity)" :key="store.name">
                        <div class="p-4 rounded-xl border border-gray-200 hover:border-amber-400 hover:shadow-md transition-all bg-white">
                            <h4 class="font-bold text-[#0a2240] text-sm mb-1" x-text="store.name"></h4>
                            <p class="text-xs text-gray-600 mb-2 leading-relaxed" x-text="store.address"></p>
                            <div class="flex items-center justify-between text-xs pt-2 border-t border-gray-100">
                                <span class="text-gray-500" x-text="'🕒 ' + store.timing"></span>
                                <a :href="'tel:' + store.phone" class="font-bold text-[#f15d4c] hover:underline" x-text="'📞 ' + store.phone"></a>
                            </div>
                        </div>
                    </template>
                </div>

            </div>

        </div>
    </div>
</div>
