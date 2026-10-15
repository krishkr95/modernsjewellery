<x-layouts.app title="Shopping Bag | Modern Jewellery House">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-14" x-data="cartPageManager()">
        
        <x-breadcrumbs :items="[
            ['label' => 'Maison Bag']
        ]" />

        <div class="my-8 sm:my-10">
            <span class="text-[10px] uppercase tracking-[0.25em] text-gold-dark font-medium block mb-1">
                Atelier Acquisition
            </span>
            <h1 class="font-serif text-3xl sm:text-5xl text-charcoal font-normal">
                Your Shopping Bag
            </h1>
            <p class="text-xs text-charcoal-muted font-light mt-1.5 uppercase tracking-widest">
                Complimentary armored courier & signature presentation case included
            </p>
        </div>

        @if($cart->items->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
                
                <!-- Items Table / List (Col 1 to 8) -->
                <div class="lg:col-span-8 divide-y divide-border-subtle border-y border-border-subtle">
                    @foreach($cart->items as $item)
                        <div class="py-6 sm:py-8 flex flex-col sm:flex-row gap-6 items-start sm:items-center justify-between" id="cart-row-{{ $item->id }}">
                            
                            <!-- Thumbnail & Title -->
                            <div class="flex items-center space-x-5 min-w-0">
                                <a href="{{ route('products.show', $item->product->slug) }}" class="flex-shrink-0">
                                    <img src="{{ $item->product ? $item->product->primary_image_url : asset('assets/images/hero-luxury.jpg') }}" 
                                         alt="{{ $item->product ? $item->product->name : 'Jewellery Piece' }}" 
                                         class="w-20 h-24 sm:w-24 sm:h-28 object-cover bg-[#F7F5F0] border border-border-subtle">
                                </a>


                                <div class="space-y-1">
                                    <span class="text-[9px] uppercase tracking-[0.2em] text-gold-dark font-medium block">
                                        {{ $item->product->category->name ?? 'Fine Jewellery' }}
                                    </span>
                                    <h3 class="font-serif text-base sm:text-lg text-charcoal font-normal hover:text-gold-dark transition-colors">
                                        <a href="{{ route('products.show', $item->product->slug) }}">
                                            {{ $item->product->name }}
                                        </a>
                                    </h3>
                                    <p class="text-xs text-charcoal-muted font-light">
                                        Edition: <span class="text-charcoal">{{ $item->variant->title ?? 'Standard Edition' }}</span>
                                    </p>
                                    @if($item->custom_engraving)
                                        <p class="text-[11px] text-gold-dark italic">
                                            Engraving: “{{ $item->custom_engraving }}”
                                        </p>
                                    @endif
                                    <p class="text-[11px] text-charcoal-muted font-mono pt-1">
                                        SKU: {{ $item->variant->sku ?? $item->product->sku }}
                                    </p>
                                </div>
                            </div>

                            <!-- Quantity & Pricing -->
                            <div class="flex items-center justify-between sm:justify-end space-x-8 w-full sm:w-auto pt-2 sm:pt-0">
                                
                                <!-- Stepper -->
                                <div class="inline-flex items-center border border-border-subtle bg-ivory">
                                    <button type="button" 
                                            @click="updateItemQty({{ $item->id }}, {{ $item->quantity - 1 }})"
                                            class="px-2.5 py-1 text-charcoal-muted hover:text-charcoal hover:bg-ivory-light text-sm font-serif">
                                        −
                                    </button>
                                    <span class="px-3 py-1 text-xs font-medium text-charcoal" id="page-qty-{{ $item->id }}">
                                        {{ $item->quantity }}
                                    </span>
                                    <button type="button" 
                                            @click="updateItemQty({{ $item->id }}, {{ $item->quantity + 1 }})"
                                            class="px-2.5 py-1 text-charcoal-muted hover:text-charcoal hover:bg-ivory-light text-sm font-serif">
                                        +
                                    </button>
                                </div>

                                <!-- Line Total -->
                                <div class="text-right min-w-[90px]">
                                    <span class="font-serif text-base sm:text-lg text-charcoal block" id="page-price-{{ $item->id }}">
                                        &#36;{{ number_format($item->total_price, 2) }}
                                    </span>
                                    <span class="text-[10px] text-charcoal-muted font-light block">
                                        &#36;{{ number_format($item->unit_price, 2) }} each
                                    </span>
                                </div>

                                <!-- Remove -->
                                <button type="button" 
                                        @click="removeItem({{ $item->id }})"
                                        class="p-2 text-charcoal-muted hover:text-[#8A3324] transition-colors"
                                        title="Remove creation">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>

                        </div>
                    @endforeach
                </div>

                <!-- Summary & Order Computation Card (Col 9 to 12) -->
                <div class="lg:col-span-4 bg-ivory border border-border-subtle p-6 sm:p-8 space-y-6 shadow-sm sticky top-28">
                    
                    <h3 class="font-serif text-xl text-charcoal font-normal border-b border-border-subtle/80 pb-4">
                        Acquisition Summary
                    </h3>

                    <!-- Pricing Breakdown -->
                    <div class="space-y-3 text-xs tracking-wider uppercase text-charcoal">
                        <div class="flex items-center justify-between">
                            <span class="text-charcoal-muted">Subtotal</span>
                            <span class="font-serif text-sm font-medium" id="page-subtotal">&#36;{{ number_format($cart->subtotal, 2) }}</span>
                        </div>

                        <!-- Promotional Discount -->
                        @if($cart->discount_amount > 0)
                            <div class="flex items-center justify-between text-[#8A3324]">
                                <span>Promotional Privilege ({{ $cart->coupon_code }})</span>
                                <span class="font-serif text-sm font-medium">-&#36;{{ number_format($cart->discount_amount, 2) }}</span>
                            </div>
                        @endif

                        <div class="flex items-center justify-between">
                            <span class="text-charcoal-muted">Armored Courier Shipping</span>
                            <span class="text-gold-dark font-sans text-[11px] font-medium">COMPLIMENTARY</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-charcoal-muted">Estimated Tax (8%)</span>
                            @php
                                $taxEst = round(max(0, $cart->subtotal - (float) $cart->discount_amount) * 0.08, 2);
                            @endphp
                            <span class="font-serif text-sm font-medium">&#36;{{ number_format($taxEst, 2) }}</span>
                        </div>

                        <div class="border-t border-border-subtle pt-3 flex items-baseline justify-between text-charcoal">
                            <span class="text-sm font-medium">Estimated Total</span>
                            @php
                                $totalEst = max(0, $cart->subtotal - (float) $cart->discount_amount + $taxEst);
                            @endphp
                            <span class="font-serif text-2xl font-normal text-charcoal" id="page-total">
                                &#36;{{ number_format($totalEst, 2) }}
                            </span>
                        </div>
                    </div>

                    <!-- Coupon / Promotional Form -->
                    <div class="pt-2 border-t border-border-subtle/70">
                        @if($cart->coupon_code)
                            <div class="flex items-center justify-between p-3 bg-ivory-light border border-border-subtle text-xs">
                                <div>
                                    <span class="text-[10px] uppercase tracking-wider text-gold-dark block">Active Privilege:</span>
                                    <span class="font-mono font-medium text-charcoal">{{ $cart->coupon_code }}</span>
                                </div>
                                <form action="{{ route('cart.coupon.remove') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[10px] uppercase tracking-wider text-[#8A3324] hover:underline font-medium">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        @else
                            <form action="{{ route('cart.coupon') }}" method="POST" class="space-y-2">
                                @csrf
                                <label for="coupon_code" class="block text-[10px] uppercase tracking-[0.2em] font-medium text-charcoal">
                                    Promotional Code:
                                </label>
                                <div class="flex space-x-2">
                                    <input type="text" 
                                           name="code" 
                                           id="coupon_code"
                                           placeholder="e.g. MAISON10"
                                           class="flex-1 bg-ivory-light border border-border-subtle px-3 py-2 text-xs uppercase tracking-wider text-charcoal placeholder:text-charcoal-muted/50 focus:outline-none focus:border-charcoal">
                                    <button type="submit" class="py-2 px-4 bg-charcoal text-ivory text-[10px] uppercase tracking-widest hover:bg-gold-dark hover:text-noir transition-colors">
                                        Apply
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>

                    <!-- Checkout CTA -->
                    <div class="pt-2 space-y-3">
                        <a href="{{ route('checkout.index') }}" 
                           class="w-full text-center block btn-luxury-primary text-xs py-4 tracking-[0.22em]">
                            PROCEED TO CHECKOUT
                        </a>

                        <a href="{{ route('shop') }}" 
                           class="w-full text-center block text-[11px] uppercase tracking-[0.2em] font-medium text-charcoal-muted hover:text-charcoal py-2 transition-colors">
                            Continue Browsing Catalogue
                        </a>
                    </div>

                    <!-- Trust Signals -->
                    <div class="pt-4 border-t border-border-subtle/70 space-y-2 text-[11px] text-charcoal-muted font-light">
                        <div class="flex items-center space-x-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                            <span>Door-to-door armored transit insurance</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                            <span>30-Day complimentary return or exchange</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-gold"></span>
                            <span>GIA gemological verification dossier</span>
                        </div>
                    </div>

                </div>

            </div>
        @else
            <!-- Empty Bag State -->
            <x-empty-state 
                title="Your Shopping Bag is Empty" 
                description="Explore our haute lapidary archives and discover creations shaped from certified 18k recycled gold and GIA natural diamonds."
                actionText="Explore Fine Jewellery"
                :actionUrl="route('shop')" />
        @endif

    </div>

    <!-- Script for Live Cart Page AJAX Steppers -->
    <script>
        function cartPageManager() {
            return {
                updateItemQty(itemId, newQty) {
                    if (newQty < 1) {
                        this.removeItem(itemId);
                        return;
                    }

                    fetch('/bag/items/' + itemId, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ quantity: newQty })
                    })
                    .then(r => r.json())
                    .then(d => {
                        if (d.success) {
                            window.location.reload();
                        } else if (d.message) {
                            if (window.Alpine && window.Alpine.store('toast')) {
                                window.Alpine.store('toast').show(d.message, 'error');
                            }
                        }
                    })
                    .catch(e => console.error(e));
                },

                removeItem(itemId) {
                    fetch('/bag/items/' + itemId, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(r => r.json())
                    .then(d => {
                        window.location.reload();
                    })
                    .catch(e => console.error(e));
                }
            };
        }
    </script>
</x-layouts.app>
