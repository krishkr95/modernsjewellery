{{-- ============================================================
     BLUESTONE EXACT MATCH — VIDEO CALL & TRY AT HOME APPOINTMENT
     Palette: Deep Navy (#0a2240), Emerald Video Badge, Amber Gold
     Interactive Booking Modal Trigger
     ============================================================ --}}
<section id="salon-appointment" class="py-16 sm:py-20 bg-[#0a2240] text-white relative overflow-hidden font-sans">
    <!-- Subtle Background Shimmer Graphic -->
    <div class="absolute -right-24 -bottom-24 w-96 h-96 rounded-full bg-amber-400/10 blur-3xl pointer-events-none"></div>

    <div class="max-w-[1700px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <div class="lg:col-span-7">
                <span class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-400/20 text-emerald-300 border border-emerald-400/30 rounded-full text-xs font-semibold uppercase tracking-wider mb-4">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Virtual Video Concierge &bull; Free Service</span>
                </span>
                
                <h2 class="font-serif text-3xl sm:text-5xl text-white font-normal leading-tight tracking-tight mb-4">
                    Experience BlueStone from the Comfort of Your Home
                </h2>
                
                <p class="font-sans text-sm sm:text-base text-gray-300 leading-relaxed max-w-xl mb-8">
                    Can't visit our store? Book a 1-on-1 personalized live video call with our certified gemologists. See your favorite rings, bangles, and solitaires up close in 4K resolution before making your decision.
                </p>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                    <button type="button" 
                            @click="$store.videoCallModal.toggle()"
                            class="inline-flex items-center justify-center gap-3 px-8 py-4 text-xs uppercase tracking-wider font-bold rounded-full bg-[#f15d4c] hover:bg-[#d94b3a] text-white shadow-lg hover:shadow-xl transition-all duration-300">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        <span>Book Free Video Call</span>
                    </button>
                    
                    <button type="button" 
                            @click="$store.storeModal.toggle()"
                            class="inline-flex items-center justify-center gap-2 px-8 py-4 text-xs uppercase tracking-wider font-bold rounded-full text-white border border-white/30 hover:border-amber-300 hover:bg-white/10 transition-all duration-300">
                        <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        <span>Find 180+ Stores Near You</span>
                    </button>
                </div>

                <div class="mt-8 flex flex-wrap items-center gap-6 text-xs text-gray-400">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        No Obligation to Buy
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        100% Certified Designs
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Try Up to 5 Designs at Home
                    </span>
                </div>
            </div>

            <!-- Right Visual Accent: Interactive Card -->
            <div class="lg:col-span-5">
                <div class="relative rounded-2xl overflow-hidden border-2 border-amber-300/30 shadow-2xl bg-[#07182e] group">
                    <img src="{{ asset('assets/images/bridal-hero.jpg') }}" 
                         alt="BlueStone Video Consultation" 
                         loading="lazy" decoding="async"
                         class="w-full h-[320px] sm:h-[380px] object-cover object-center opacity-90 group-hover:scale-105 transition-transform duration-700">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0a2240] via-[#0a2240]/40 to-transparent"></div>
                    
                    <div class="absolute bottom-6 left-6 right-6">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-2.5 py-1 bg-emerald-500 text-white rounded text-[10px] font-bold uppercase tracking-wider">Live Experts</span>
                            <span class="text-xs text-amber-200">★ 4.9/5 (18,400+ Calls)</span>
                        </div>
                        <h3 class="font-serif text-xl sm:text-2xl text-white font-normal">
                            Personal Jewellery Stylist on Call
                        </h3>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
