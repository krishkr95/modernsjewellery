@if($drawerCart && $drawerCart->items->count() > 0)
    <!-- Items List -->
    <div class="flex-1 overflow-y-auto p-6 space-y-6 divide-y divide-border-subtle/60" id="drawer-items-container">
        @foreach($drawerCart->items as $item)
            <div class="pt-6 first:pt-0 flex space-x-4 group" id="drawer-item-{{ $item->id }}">
                <!-- Product Thumbnail -->
                <div class="w-20 h-24 bg-ivory-light border border-border-subtle/80 flex-shrink-0 overflow-hidden relative">
                    <img src="{{ $item->product->primaryImage ? asset('storage/' . $item->product->primaryImage->image_path) : asset('assets/images/placeholder-jewel.jpg') }}" 
                         alt="{{ $item->product->name }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>

                <!-- Product Details -->
                <div class="flex-1 min-w-0 flex flex-col justify-between">
                    <div>
                        <div class="flex items-start justify-between">
                            <a href="{{ route('products.show', $item->product->slug) }}" 
                               class="font-serif text-sm text-charcoal hover:text-gold-dark transition-colors line-clamp-1 font-normal">
                                {{ $item->product->name }}
                            </a>
                            <button type="button" 
                                    @click="removeItem({{ $item->id }})"
                                    class="text-charcoal-muted hover:text-[#8A3324] text-xs transition-colors ml-2"
                                    title="Remove piece">
                                &#x2715;
                            </button>
                        </div>

                        <!-- Variant / Size & Engraving -->
                        <div class="text-[10px] uppercase tracking-wider text-charcoal-muted mt-1 space-y-0.5">
                            @if($item->variant && $item->variant->size)
                                <p>Size: <span class="text-charcoal">{{ $item->variant->size }}</span></p>
                            @endif
                            @if($item->custom_engraving)
                                <p class="italic text-gold-dark font-serif">Engraving: &ldquo;{{ $item->custom_engraving }}&rdquo;</p>
                            @endif
                        </div>
                    </div>

                    <!-- Quantity Adjuster and Item Subtotal -->
                    <div class="flex items-center justify-between pt-2">
                        <div class="inline-flex items-center border border-border-subtle bg-white">
                            <button type="button" 
                                    @click="updateItemQty({{ $item->id }}, {{ $item->quantity - 1 }})"
                                    class="px-2 py-0.5 text-charcoal-muted hover:text-charcoal hover:bg-ivory-light text-xs font-serif transition-colors">
                                -
                            </button>
                            <span class="px-2.5 py-0.5 text-[11px] font-medium text-charcoal font-sans" id="drawer-qty-{{ $item->id }}">
                                {{ $item->quantity }}
                            </span>
                            <button type="button" 
                                    @click="updateItemQty({{ $item->id }}, {{ $item->quantity + 1 }})"
                                    class="px-2 py-0.5 text-charcoal-muted hover:text-charcoal hover:bg-ivory-light text-xs font-serif transition-colors">
                                +
                            </button>
                        </div>

                        <span class="font-normal font-serif text-sm text-charcoal" id="drawer-price-{{ $item->id }}">
                            &#36;{{ number_format($item->total_price, 2) }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Drawer Footer (Subtotal, View Bag, Checkout CTAs) -->
    <div class="p-6 border-t border-border-subtle bg-ivory space-y-4" id="drawer-footer">
        <div class="space-y-1.5">
            <div class="flex items-center justify-between text-xs tracking-wider uppercase text-charcoal">
                <span>Subtotal</span>
                <span class="font-medium font-serif text-lg" id="drawer-subtotal">
                    &#36;{{ number_format($drawerCart->subtotal, 2) }}
                </span>
            </div>
            @if($drawerCart->discount_amount > 0)
                <div class="flex items-center justify-between text-xs tracking-wider uppercase text-[#8A3324]">
                    <span>Promotional Privilege</span>
                    <span class="font-serif text-sm">-&#36;{{ number_format($drawerCart->discount_amount, 2) }}</span>
                </div>
            @endif
        </div>

        <p class="text-[10px] text-charcoal-muted font-light">
            Insured courier & hallmark verification included with every commission.
        </p>

        <!-- Dual CTAs: CHECKOUT and VIEW BAG -->
        <div class="space-y-2 pt-2">
            <a href="{{ route('checkout.index') }}" 
               class="w-full text-center block btn-luxury-primary text-xs py-3.5 tracking-[0.2em]">
                CHECKOUT
            </a>

            <a href="{{ route('cart.index') }}" 
               class="w-full text-center block bg-ivory border border-border-subtle hover:border-charcoal text-[11px] uppercase tracking-[0.2em] font-medium text-charcoal py-3 transition-colors">
                VIEW BAG
            </a>
        </div>
    </div>
@else
    <div class="py-20 text-center px-6 flex-1 flex flex-col items-center justify-center" id="drawer-empty-state">
        <div class="w-14 h-14 mx-auto mb-4 border border-border-subtle rounded-full flex items-center justify-center text-charcoal-muted bg-ivory-light">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
        </div>
        <h4 class="font-serif text-lg text-charcoal font-normal mb-2">Your Bag is Empty</h4>
        <p class="text-xs text-charcoal-muted font-light leading-relaxed mb-6 max-w-xs mx-auto">
            No haute lapidary pieces have been placed in your shopping bag yet.
        </p>
        <a href="{{ route('shop') }}" 
           @click="$store.cartDrawer.close()"
           class="btn-luxury-primary text-[10px] py-3 px-6">
            Explore Catalogue
        </a>
    </div>
@endif