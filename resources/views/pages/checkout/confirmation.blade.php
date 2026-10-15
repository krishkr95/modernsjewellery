<x-layouts.app title="Order Confirmed — {{ $order->order_number }} | Modern Jewellery House">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20 text-center">
        
        <!-- Elegant Maison Checkmark Icon -->
        <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-6 rounded-full bg-gold/15 text-gold-dark flex items-center justify-center border border-gold/40">
            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-gold-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <!-- Headline & Editorial Message -->
        <span class="text-[10px] uppercase tracking-[0.3em] text-gold-dark font-medium block mb-2">
            Haute Joaillerie Acquisition Complete
        </span>
        <h1 class="font-serif text-3xl sm:text-5xl text-charcoal font-normal tracking-tight mb-3">
            Order Confirmed.
        </h1>
        <p class="text-xs sm:text-sm text-charcoal-muted font-light max-w-lg mx-auto leading-relaxed mb-8">
            Thank you for entrusting Modern Jewellery House. Your bespoke order has been registered in our atelier ledger and verified via Razorpay.
        </p>

        <!-- Order Metadata Ribbon -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-6 bg-ivory border border-border-subtle text-left mb-10 max-w-2xl mx-auto">
            <div>
                <span class="text-[10px] uppercase tracking-wider text-charcoal-muted block">Order Number</span>
                <span class="font-mono text-sm sm:text-base font-semibold text-charcoal">{{ $order->order_number }}</span>
            </div>
            <div>
                <span class="text-[10px] uppercase tracking-wider text-charcoal-muted block">Expected Delivery</span>
                <span class="font-serif text-sm sm:text-base text-charcoal">
                    {{ $order->expected_delivery_at ? $order->expected_delivery_at->format('M d, Y') : '3–5 Business Days' }}
                </span>
            </div>
            <div>
                <span class="text-[10px] uppercase tracking-wider text-charcoal-muted block">Total Paid</span>
                <span class="font-serif text-sm sm:text-base font-medium text-gold-dark">{{ $order->formatted_total }}</span>
            </div>
        </div>

        <!-- Primary CTA: TRACK ORDER -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-14">
            <a href="{{ route('orders.track', $order->order_number) }}" 
               class="btn-luxury-primary text-xs py-4 px-8 tracking-[0.25em] w-full sm:w-auto">
                TRACK ORDER
            </a>
            <a href="{{ route('shop') }}" 
               class="bg-ivory border border-border-subtle hover:border-charcoal text-[11px] uppercase tracking-[0.2em] font-medium text-charcoal py-3.5 px-6 transition-colors w-full sm:w-auto">
                Explore More Creations
            </a>
        </div>

        <!-- Order Summary Card -->
        <div class="bg-ivory border border-border-subtle p-6 sm:p-8 text-left space-y-6">
            <h3 class="font-serif text-xl text-charcoal font-normal border-b border-border-subtle/80 pb-4">
                Creation Summary
            </h3>

            <!-- Items List -->
            <div class="divide-y divide-border-subtle/70">
                @foreach($order->items as $item)
                    <div class="py-4 first:pt-0 flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <img src="{{ $item->product ? $item->product->primary_image_url : asset('assets/images/hero-luxury.jpg') }}" 
                                 alt="{{ $item->product_name }}" 
                                 class="w-16 h-20 object-cover bg-[#F7F5F0] border border-border-subtle">

                            <div>
                                <h4 class="font-serif text-base text-charcoal font-normal">
                                    {{ $item->product_name }}
                                </h4>
                                <p class="text-xs text-charcoal-muted font-light">
                                    Edition: {{ $item->variant_title ?? 'Atelier Standard' }} (Qty: {{ $item->quantity }})
                                </p>
                                @if($item->custom_engraving)
                                    <p class="text-[11px] text-gold-dark italic">
                                        Atelier Engraving: “{{ $item->custom_engraving }}”
                                    </p>
                                @endif
                            </div>
                        </div>
                        <span class="font-serif text-base text-charcoal">
                            &#36;{{ number_format($item->subtotal, 2) }}
                        </span>
                    </div>
                @endforeach
            </div>

            <!-- Financials & Address -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4 border-t border-border-subtle/80 text-xs">
                <!-- Delivery Destination -->
                <div class="space-y-1 text-charcoal-muted font-light">
                    <span class="text-[10px] uppercase tracking-wider font-medium text-charcoal block mb-1">
                        Armored Delivery Address
                    </span>
                    <p class="text-charcoal font-medium">{{ $order->shipping_address['full_name'] ?? 'Valued Patron' }}</p>
                    <p>{{ $order->shipping_address['address_line1'] ?? '' }}</p>
                    @if(!empty($order->shipping_address['address_line2']))
                        <p>{{ $order->shipping_address['address_line2'] }}</p>
                    @endif
                    <p>{{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['state'] ?? '' }} — {{ $order->pincode ?? $order->shipping_address['pincode'] ?? '' }}</p>
                    <p>Phone: {{ $order->customer_phone }}</p>
                </div>

                <!-- Financial Ledger -->
                <div class="space-y-2 uppercase tracking-wider text-charcoal">
                    <div class="flex justify-between">
                        <span class="text-charcoal-muted">Subtotal</span>
                        <span class="font-serif text-sm">&#36;{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    @if($order->discount_amount > 0)
                        <div class="flex justify-between text-[#8A3324]">
                            <span>Promotional Privilege</span>
                            <span class="font-serif text-sm">-&#36;{{ number_format($order->discount_amount, 2) }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-charcoal-muted">Armored Courier Transit</span>
                        <span class="text-gold-dark font-sans text-[11px]">COMPLIMENTARY</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-charcoal-muted">Estimated Tax (8%)</span>
                        <span class="font-serif text-sm">&#36;{{ number_format($order->tax_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between border-t border-border-subtle pt-2 text-sm font-medium">
                        <span>Total Paid</span>
                        <span class="font-serif text-xl font-normal text-charcoal">{{ $order->formatted_total }}</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</x-layouts.app>
