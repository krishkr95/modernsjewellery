{{-- ============================================================
     BLUESTONE EXACT MATCH FOOTER
     Palette: Deep Navy (#0a2240), Coral CTA (#f15d4c), Soft Muted Text
     Comprehensive Directory, Certifications & Trust Badges
     ============================================================ --}}
<footer class="bg-[#07182e] text-white border-t border-white/10 font-sans select-none">

    <!-- Top Newsletter & App Strip -->
    <div class="border-b border-white/10 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-[1700px] mx-auto flex flex-col lg:flex-row items-center justify-between gap-8">
            
            <!-- Left: Newsletter Subscription -->
            <div class="max-w-xl text-center lg:text-left">
                <span class="text-xs uppercase tracking-widest text-[#f15d4c] font-bold block mb-1">
                    BE THE FIRST TO KNOW
                </span>
                <h3 class="font-serif text-2xl sm:text-3xl font-normal text-white mb-2">
                    Subscribe for Exclusive Previews &amp; Secret Offers
                </h3>
                <p class="text-xs text-gray-400">
                    Get VIP access to new jewellery collections, flash sales, and special maker privileges.
                </p>
            </div>

            <!-- Newsletter Input Form -->
            <div class="w-full max-w-md"
                 x-data="{
                     email: '',
                     subscribed: false,
                     submit() {
                         if (this.email) {
                             this.subscribed = true;
                             Alpine.store('toast').show('Thank you for subscribing to Modern Jewellery House VIP privileges!', 'success');
                             this.email = '';
                         }
                     }
                 }">
                <form @submit.prevent="submit()" class="relative flex items-center">
                    <input type="email" 
                           x-model="email"
                           required
                           placeholder="Enter your email address" 
                           class="w-full pl-5 pr-32 py-3 bg-white/10 border border-white/20 rounded-full text-xs text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-300">
                    <button type="submit" 
                            class="absolute right-1 top-1/2 -translate-y-1/2 px-6 py-2 bg-[#f15d4c] hover:bg-[#d94b3a] text-white text-xs font-bold uppercase tracking-wider rounded-full shadow-md transition-colors">
                        SUBSCRIBE
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- Main Directory Columns -->
    <div class="max-w-[1700px] mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 lg:gap-12 pb-12 border-b border-white/10 text-xs">
            
            <!-- Col 1: About Modern Jewellery House -->
            <div>
                <h4 class="font-bold text-white uppercase tracking-wider text-[11px] mb-4 text-amber-300">About Us</h4>
                <ul class="space-y-2.5 text-gray-400">
                    <li><a href="#" class="hover:text-white transition-colors">Our Story &amp; Vision</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Master Craftsmanship</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">10+1 Monthly Savings Scheme</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Boutique Salons</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Careers at Modern Jewellery House</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Press &amp; Media</a></li>
                </ul>
            </div>

            <!-- Col 2: Customer Delights & Service -->
            <div>
                <h4 class="font-bold text-white uppercase tracking-wider text-[11px] mb-4 text-amber-300">Customer Delight</h4>
                <ul class="space-y-2.5 text-gray-400">
                    <li><a href="{{ route('customer.dashboard') }}" class="hover:text-white transition-colors">Track Your Order</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">30-Day Free Returns</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Lifetime Exchange &amp; Buyback</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Free Insured Courier</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Today's Gold Rate (22K &amp; 24K)</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Jewellery Insurance</a></li>
                </ul>
            </div>

            <!-- Col 3: Jewellery Education -->
            <div>
                <h4 class="font-bold text-white uppercase tracking-wider text-[11px] mb-4 text-amber-300">Jewellery Guide</h4>
                <ul class="space-y-2.5 text-gray-400">
                    <li><a href="#" class="hover:text-white transition-colors">The 4Cs of Diamonds</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Solitaire Buying Guide</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Ring Size Measuring Tool</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Gold Purity (18Kt vs 22Kt)</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">BIS Hallmarking Explained</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Care &amp; Cleaning Instructions</a></li>
                </ul>
            </div>

            <!-- Col 4: Top Collections -->
            <div>
                <h4 class="font-bold text-white uppercase tracking-wider text-[11px] mb-4 text-amber-300">Popular Categories</h4>
                <ul class="space-y-2.5 text-gray-400">
                    <li><a href="{{ route('shop', ['category' => 'rings']) }}" class="hover:text-white transition-colors">Diamond Rings</a></li>
                    <li><a href="{{ route('shop', ['category' => 'earrings']) }}" class="hover:text-white transition-colors">Gold Earrings</a></li>
                    <li><a href="{{ route('shop', ['search' => 'solitaire']) }}" class="hover:text-white transition-colors">Preset Solitaires</a></li>
                    <li><a href="{{ route('shop', ['search' => 'mangalsutra']) }}" class="hover:text-white transition-colors">Modern Mangalsutras</a></li>
                    <li><a href="{{ route('shop', ['category' => 'bracelets']) }}" class="hover:text-white transition-colors">Tennis Bracelets</a></li>
                    <li><a href="{{ route('shop', ['category' => 'coins']) }}" class="hover:text-white transition-colors">Lakshmi Gold Coins</a></li>
                </ul>
            </div>

            <!-- Col 5: Contact Concierge & Certifications -->
            <div>
                <h4 class="font-bold text-white uppercase tracking-wider text-[11px] mb-4 text-amber-300">Concierge Desk</h4>
                <div class="space-y-3 text-gray-300">
                    <p class="text-xs">
                        Toll Free Helpline:<br>
                        <a href="tel:18004190066" class="text-amber-300 font-bold text-sm hover:underline">1800-419-0066</a>
                    </p>
                    <p class="text-xs">
                        WhatsApp Assistance:<br>
                        <span class="text-emerald-400 font-medium">+91 91084 10066</span>
                    </p>
                    <p class="text-xs text-gray-400">
                        Operational: 9:00 AM - 10:00 PM (All 7 Days)
                    </p>
                </div>

                <div class="mt-6 pt-4 border-t border-white/10">
                    <span class="text-[10px] text-gray-400 uppercase font-bold block mb-2">100% Certified By</span>
                    <div class="flex items-center gap-3 text-white/60 text-xs font-serif font-bold">
                        <span class="border border-white/20 px-2 py-0.5 rounded">BIS 916</span>
                        <span class="border border-white/20 px-2 py-0.5 rounded">IGI</span>
                        <span class="border border-white/20 px-2 py-0.5 rounded">GIA</span>
                        <span class="border border-white/20 px-2 py-0.5 rounded">SGL</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Popular Searches SEO Links (BlueStone Footer Style) -->
        <div class="py-6 border-b border-white/10 text-[11px] text-gray-400 leading-loose">
            <span class="font-bold text-white uppercase mr-2 text-[10px] tracking-wider">Popular Searches:</span>
            <a href="{{ route('shop', ['category' => 'rings']) }}" class="hover:text-white">Gold Rings</a> &bull;
            <a href="{{ route('shop', ['category' => 'earrings']) }}" class="hover:text-white">Diamond Earrings</a> &bull;
            <a href="{{ route('shop', ['search' => 'mangalsutra']) }}" class="hover:text-white">Mangalsutra Designs</a> &bull;
            <a href="{{ route('shop', ['search' => 'solitaire']) }}" class="hover:text-white">Solitaire Engagement Rings</a> &bull;
            <a href="{{ route('shop', ['category' => 'bracelets']) }}" class="hover:text-white">Gold Bangles</a> &bull;
            <a href="{{ route('shop', ['search' => 'chain']) }}" class="hover:text-white">Gold Chains for Men</a> &bull;
            <a href="{{ route('shop', ['search' => 'evil eye']) }}" class="hover:text-white">Evil Eye Pendants</a> &bull;
            <a href="{{ route('shop', ['search' => 'couple band']) }}" class="hover:text-white">Couple Bands</a> &bull;
            <a href="{{ route('shop', ['category' => 'coins']) }}" class="hover:text-white">24Kt Gold Coins</a> &bull;
            <a href="{{ route('shop', ['search' => 'nose pin']) }}" class="hover:text-white">Diamond Nose Pins</a> &bull;
            <a href="{{ route('shop', ['search' => 'watch charm']) }}" class="hover:text-white">Smart Watch Charms</a>
        </div>

        <!-- Bottom Copyright & Security Badges -->
        <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-gray-400">
            <div class="flex items-center gap-3">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Modern Jewellery House Logo" class="w-10 h-10 rounded-full object-cover border border-amber-400/40 shadow-sm flex-shrink-0">
                <div>
                    <p class="text-white font-bold text-xs uppercase tracking-wider font-serif">Modern Jewellery House</p>
                    <p>© {{ date('Y') }} Modern Jewellery House Atelier. All rights reserved.</p>
                    <p class="text-[10px] text-gray-400 mt-0.5">Government Recognized Hallmark Jewellers | Reg No: HM/C-7590214819</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3 text-[11px]">
                <a href="#" class="hover:text-white">Privacy Policy</a>
                <span>&bull;</span>
                <a href="#" class="hover:text-white">Terms &amp; Conditions</a>
                <span>&bull;</span>
                <a href="#" class="hover:text-white">Security &amp; Encryption</a>
            </div>
        </div>

    </div>

</footer>
