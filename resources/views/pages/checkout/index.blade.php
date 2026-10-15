<x-layouts.app title="Secure Atelier Checkout | Modern Jewellery House">

    <!-- Preload Razorpay Checkout Library -->
    @push('head')
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    @endpush

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-14" 
         x-data="checkoutManager({
            subtotal: {{ $subtotal }},
            discount: {{ $discount }},
            shipping: {{ $shipping }},
            tax: {{ $tax }},
            total: {{ $total }}
         })">
        
        <!-- Breadcrumbs -->
        <x-breadcrumbs :items="[
            ['label' => 'Shopping Bag', 'url' => route('cart.index')],
            ['label' => 'Secure Checkout']
        ]" />

        <!-- Editorial Header -->
        <div class="my-8 sm:my-10">
            <span class="text-[10px] uppercase tracking-[0.25em] text-gold-dark font-medium block mb-1">
                Confidential Atelier Transaction
            </span>
            <h1 class="font-serif text-3xl sm:text-5xl text-charcoal font-normal">
                Secure Checkout
            </h1>
            <p class="text-xs text-charcoal-muted font-light mt-1.5 uppercase tracking-widest">
                Protected by 256-Bit Encryption • Insured Armored Courier
            </p>
        </div>

        <!-- Failure / Error Banner if Payment Fails -->
        <div x-show="errorMessage" 
             x-transition 
             class="mb-8 p-4 bg-[#FBF0EE] border border-[#8A3324]/40 text-[#8A3324] flex items-start space-x-3 rounded-[1px]" 
             style="display: none;">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5 text-[#8A3324]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <div class="flex-1 text-xs">
                <h4 class="font-medium uppercase tracking-wider text-sm mb-1">Your payment could not be completed</h4>
                <p x-text="errorMessage" class="font-light leading-relaxed"></p>
                <button type="button" 
                        @click="errorMessage = ''" 
                        class="mt-2 text-[10px] uppercase tracking-widest font-medium underline hover:text-charcoal">
                    Dismiss and Retry Payment
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
            
            <!-- LEFT COLUMN: Structured Checkout Form (Col 1 to 7) -->
            <div class="lg:col-span-7">
                <form id="checkout-form" @submit.prevent="submitCheckout($event)" class="space-y-10">
                    
                    <!-- 1. SECTION: CONTACT -->
                    <div class="bg-ivory border border-border-subtle p-6 sm:p-8 space-y-5">
                        <div class="flex items-center space-x-3 border-b border-border-subtle/80 pb-4">
                            <span class="w-6 h-6 rounded-full bg-charcoal text-ivory text-xs font-mono flex items-center justify-center font-normal">1</span>
                            <h2 class="font-serif text-lg sm:text-xl text-charcoal font-normal">
                                Contact Information
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Email -->
                            <div class="sm:col-span-2">
                                <label for="email" class="block text-[10px] uppercase tracking-[0.2em] font-medium text-charcoal mb-1">
                                    Email Address for Acquisition Dossier *
                                </label>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       required
                                       value="{{ old('email', $user?->email ?? '') }}"
                                       placeholder="client@luxury.com"
                                       class="w-full bg-ivory-light border border-border-subtle px-4 py-2.5 text-xs text-charcoal placeholder:text-charcoal-muted/50 focus:outline-none focus:border-charcoal">
                            </div>

                            <!-- Phone -->
                            <div class="sm:col-span-2">
                                <label for="phone" class="block text-[10px] uppercase tracking-[0.2em] font-medium text-charcoal mb-1">
                                    Mobile Phone (Mandatory for Armored Delivery Handover) *
                                </label>
                                <input type="tel" 
                                       name="phone" 
                                       id="phone" 
                                       required
                                       value="{{ old('phone', $user?->phone ?? '') }}"
                                       placeholder="+91 98765 43210"
                                       class="w-full bg-ivory-light border border-border-subtle px-4 py-2.5 text-xs text-charcoal placeholder:text-charcoal-muted/50 focus:outline-none focus:border-charcoal">
                                <span class="text-[10px] text-charcoal-muted font-light mt-0.5 block">
                                    Used solely for courier coordination and delivery OTP verification.
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- 2. SECTION: DELIVERY ADDRESS -->
                    <div class="bg-ivory border border-border-subtle p-6 sm:p-8 space-y-5">
                        <div class="flex items-center space-x-3 border-b border-border-subtle/80 pb-4">
                            <span class="w-6 h-6 rounded-full bg-charcoal text-ivory text-xs font-mono flex items-center justify-center font-normal">2</span>
                            <h2 class="font-serif text-lg sm:text-xl text-charcoal font-normal">
                                Delivery Address (India Insured Courier)
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Full Name -->
                            <div class="sm:col-span-2">
                                <label for="name" class="block text-[10px] uppercase tracking-[0.2em] font-medium text-charcoal mb-1">
                                    Recipient Full Name *
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       required
                                       value="{{ old('name', $user?->name ?? '') }}"
                                       placeholder="e.g. Lady Vivienne Westwood"
                                       class="w-full bg-ivory-light border border-border-subtle px-4 py-2.5 text-xs text-charcoal placeholder:text-charcoal-muted/50 focus:outline-none focus:border-charcoal">
                            </div>

                            <!-- Address Line 1 -->
                            <div class="sm:col-span-2">
                                <label for="address_line1" class="block text-[10px] uppercase tracking-[0.2em] font-medium text-charcoal mb-1">
                                    Street Address / Residence / Building *
                                </label>
                                <input type="text" 
                                       name="address_line1" 
                                       id="address_line1" 
                                       required
                                       placeholder="Apartment, Suite, Unit, Villa Name"
                                       class="w-full bg-ivory-light border border-border-subtle px-4 py-2.5 text-xs text-charcoal placeholder:text-charcoal-muted/50 focus:outline-none focus:border-charcoal">
                            </div>

                            <!-- Address Line 2 -->
                            <div class="sm:col-span-2">
                                <label for="address_line2" class="block text-[10px] uppercase tracking-[0.2em] font-medium text-charcoal mb-1">
                                    Landmark / Area (Optional)
                                </label>
                                <input type="text" 
                                       name="address_line2" 
                                       id="address_line2" 
                                       placeholder="Near Royal Opera House, Marine Drive"
                                       class="w-full bg-ivory-light border border-border-subtle px-4 py-2.5 text-xs text-charcoal placeholder:text-charcoal-muted/50 focus:outline-none focus:border-charcoal">
                            </div>

                            <!-- City -->
                            <div>
                                <label for="city" class="block text-[10px] uppercase tracking-[0.2em] font-medium text-charcoal mb-1">
                                    City *
                                </label>
                                <input type="text" 
                                       name="city" 
                                       id="city" 
                                       required
                                       placeholder="Mumbai"
                                       class="w-full bg-ivory-light border border-border-subtle px-4 py-2.5 text-xs text-charcoal placeholder:text-charcoal-muted/50 focus:outline-none focus:border-charcoal">
                            </div>

                            <!-- State -->
                            <div>
                                <label for="state" class="block text-[10px] uppercase tracking-[0.2em] font-medium text-charcoal mb-1">
                                    State / Province *
                                </label>
                                <input type="text" 
                                       name="state" 
                                       id="state" 
                                       required
                                       placeholder="Maharashtra"
                                       class="w-full bg-ivory-light border border-border-subtle px-4 py-2.5 text-xs text-charcoal placeholder:text-charcoal-muted/50 focus:outline-none focus:border-charcoal">
                            </div>

                            <!-- Pincode (Indian 6-digit Pincode validated) -->
                            <div class="sm:col-span-2">
                                <label for="pincode" class="block text-[10px] uppercase tracking-[0.2em] font-medium text-charcoal mb-1">
                                    Indian Postal Pincode (6 Digits) *
                                </label>
                                <input type="text" 
                                       name="pincode" 
                                       id="pincode" 
                                       required
                                       maxlength="6"
                                       pattern="^[1-9][0-9]{5}$"
                                       placeholder="400001"
                                       class="w-full sm:w-1/2 bg-ivory-light border border-border-subtle px-4 py-2.5 text-xs font-mono tracking-widest text-charcoal placeholder:text-charcoal-muted/50 focus:outline-none focus:border-charcoal">
                                <span class="text-[10px] text-charcoal-muted font-light mt-0.5 block">
                                    Must be a valid 6-digit Indian PIN code for armored transport clearance.
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- 3. SECTION: SHIPPING -->
                    <div class="bg-ivory border border-border-subtle p-6 sm:p-8 space-y-4">
                        <div class="flex items-center space-x-3 border-b border-border-subtle/80 pb-4">
                            <span class="w-6 h-6 rounded-full bg-charcoal text-ivory text-xs font-mono flex items-center justify-center font-normal">3</span>
                            <h2 class="font-serif text-lg sm:text-xl text-charcoal font-normal">
                                Shipping Method
                            </h2>
                        </div>

                        <label class="flex items-start justify-between p-4 border border-charcoal bg-ivory-light cursor-pointer">
                            <div class="flex items-start space-x-3">
                                <input type="radio" checked readonly class="mt-0.5 text-charcoal focus:ring-gold-dark">
                                <div>
                                    <span class="text-xs font-medium uppercase tracking-wider text-charcoal block">
                                        Complimentary Armored Courier & White-Glove Handover
                                    </span>
                                    <span class="text-[11px] text-charcoal-muted font-light block mt-0.5">
                                        Fully insured door-to-door transit. Tamper-evident seal & mandatory adult photo-ID signature.
                                    </span>
                                </div>
                            </div>
                            <span class="text-xs font-medium text-gold-dark tracking-wider uppercase font-sans">
                                FREE
                            </span>
                        </label>
                    </div>

                    <!-- 4. SECTION: PAYMENT -->
                    <div class="bg-ivory border border-border-subtle p-6 sm:p-8 space-y-5">
                        <div class="flex items-center space-x-3 border-b border-border-subtle/80 pb-4">
                            <span class="w-6 h-6 rounded-full bg-charcoal text-ivory text-xs font-mono flex items-center justify-center font-normal">4</span>
                            <h2 class="font-serif text-lg sm:text-xl text-charcoal font-normal">
                                Payment Method (Razorpay Secure)
                            </h2>
                        </div>

                        <div class="p-4 border border-border-subtle bg-ivory-light space-y-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <span class="w-2 h-2 rounded-full bg-gold"></span>
                                    <span class="text-xs font-medium uppercase tracking-wider text-charcoal">
                                        Razorpay Luxury Payment Gateway
                                    </span>
                                </div>
                                <span class="text-[10px] uppercase tracking-widest text-charcoal-muted font-mono">
                                    PCI-DSS Level 1
                                </span>
                            </div>
                            <p class="text-xs text-charcoal-muted font-light leading-relaxed">
                                Seamlessly supports all major Credit & Debit Cards (Visa, MasterCard, Amex, Diners), UPI Instant Transfer, NetBanking, and Maison Concierge Wire.
                            </p>
                            <div class="flex items-center space-x-3 pt-2 text-[10px] text-charcoal-muted font-light">
                                <span>🔒 256-Bit Cryptographic SSL</span>
                                <span>•</span>
                                <span>HMAC-SHA256 Server Verification</span>
                                <span>•</span>
                                <span>Zero Fraud Guarantee</span>
                            </div>
                        </div>

                        <!-- Special Instructions -->
                        <div>
                            <label for="customer_notes" class="block text-[10px] uppercase tracking-[0.2em] font-medium text-charcoal mb-1">
                                Delivery Instructions or Gift Note (Optional):
                            </label>
                            <textarea name="customer_notes" 
                                      id="customer_notes" 
                                      rows="2" 
                                      placeholder="e.g. Leave with private residence concierge or gift card message..."
                                      class="w-full bg-ivory-light border border-border-subtle px-4 py-2 text-xs text-charcoal placeholder:text-charcoal-muted/50 focus:outline-none focus:border-charcoal"></textarea>
                        </div>

                        <!-- Submit CTA -->
                        <div class="pt-4 border-t border-border-subtle/80">
                            <button type="submit" 
                                    :disabled="processing"
                                    class="w-full btn-luxury-primary text-xs tracking-[0.25em] py-4.5 flex items-center justify-center space-x-2 transition-all">
                                <span x-show="!processing">PLACE ORDER & PAY SECURELY</span>
                                <span x-show="processing" class="inline-flex items-center space-x-2">
                                    <svg class="animate-spin h-4 w-4 text-ivory" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                    </svg>
                                    <span>CONNECTING TO RAZORPAY...</span>
                                </span>
                            </button>
                        </div>
                    </div>

                </form>
            </div>

            <!-- RIGHT COLUMN: ORDER SUMMARY (Col 8 to 12) -->
            <div class="lg:col-span-5 bg-ivory border border-border-subtle p-6 sm:p-8 space-y-6 shadow-sm lg:sticky lg:top-28">
                
                <h3 class="font-serif text-xl text-charcoal font-normal border-b border-border-subtle/80 pb-4">
                    Order Summary ({{ $cart->items->count() }} {{ Str::plural('Piece', $cart->items->count()) }})
                </h3>

                <!-- Mini Item List -->
                <div class="space-y-4 max-h-80 overflow-y-auto pr-1 divide-y divide-border-subtle/60 no-scrollbar">
                    @foreach($cart->items as $item)
                        <div class="pt-4 first:pt-0 flex items-center space-x-4">
                            <div class="relative flex-shrink-0">
                                <img src="{{ $item->product ? $item->product->primary_image_url : asset('assets/images/hero-luxury.jpg') }}" 
                                     alt="{{ $item->product ? $item->product->name : 'Jewellery Piece' }}" 
                                     class="w-16 h-20 object-cover bg-[#F7F5F0] border border-border-subtle">

                                <span class="absolute -top-1.5 -right-1.5 bg-charcoal text-ivory text-[9px] w-4 h-4 rounded-full flex items-center justify-center font-sans font-medium">
                                    {{ $item->quantity }}
                                </span>
                            </div>

                            <div class="flex-1 min-w-0">
                                <h4 class="font-serif text-sm text-charcoal truncate">
                                    {{ $item->product->name }}
                                </h4>
                                <p class="text-[11px] text-charcoal-muted font-light mt-0.5">
                                    {{ $item->variant->title ?? 'Atelier Edition' }}
                                </p>
                                @if($item->custom_engraving)
                                    <p class="text-[10px] text-gold-dark italic">
                                        “{{ $item->custom_engraving }}”
                                    </p>
                                @endif
                                <span class="text-xs font-serif text-charcoal block mt-1">
                                    &#36;{{ number_format($item->total_price, 2) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Financial Breakdown -->
                <div class="border-t border-border-subtle pt-4 space-y-2.5 text-xs tracking-wider uppercase text-charcoal">
                    <div class="flex items-center justify-between">
                        <span class="text-charcoal-muted">Subtotal</span>
                        <span class="font-serif text-sm font-medium">&#36;{{ number_format($subtotal, 2) }}</span>
                    </div>

                    @if($discount > 0)
                        <div class="flex items-center justify-between text-[#8A3324]">
                            <span>Promotional Privilege</span>
                            <span class="font-serif text-sm font-medium">-&#36;{{ number_format($discount, 2) }}</span>
                        </div>
                    @endif

                    <div class="flex items-center justify-between">
                        <span class="text-charcoal-muted">Armored Courier Transit</span>
                        <span class="text-gold-dark text-[11px] font-sans font-medium">COMPLIMENTARY</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-charcoal-muted">Luxury Goods Tax (8%)</span>
                        <span class="font-serif text-sm font-medium">&#36;{{ number_format($tax, 2) }}</span>
                    </div>

                    <div class="border-t border-border-subtle pt-3 flex items-baseline justify-between text-charcoal">
                        <span class="text-sm font-medium">Total Amount</span>
                        <span class="font-serif text-2xl font-normal text-charcoal">
                            &#36;{{ number_format($total, 2) }}
                        </span>
                    </div>
                </div>

                <!-- Guaranteed Accreditations -->
                <div class="border-t border-border-subtle/80 pt-4 space-y-2 text-[11px] text-charcoal-muted font-light">
                    <p class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-gold-dark flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>Official GIA gemological certification dossier included</span>
                    </p>
                    <p class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-gold-dark flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span>Cryptographically authenticated payment verification</span>
                    </p>
                </div>

            </div>

        </div>

    </div>

    <!-- Live Razorpay Checkout Flow Script -->
    <script>
        function checkoutManager(params) {
            return {
                processing: false,
                errorMessage: '',

                submitCheckout(e) {
                    this.processing = true;
                    this.errorMessage = '';

                    const form = document.getElementById('checkout-form');
                    const formData = new FormData(form);

                    // Client validation for Indian 6-digit Pincode
                    const pincode = formData.get('pincode');
                    if (!/^[1-9][0-9]{5}$/.test(pincode)) {
                        this.processing = false;
                        this.errorMessage = 'Please enter a valid 6-digit Indian PIN code (e.g. 400001, 110001).';
                        return;
                    }

                    // 1. Process Order on Server
                    fetch('{{ route('checkout.process') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(r => r.json().then(data => ({ status: r.status, body: data })))
                    .then(({ status, body }) => {
                        if (status !== 200 || !body.success) {
                            this.processing = false;
                            this.errorMessage = body.message || 'Unable to initialize order. Please verify your details.';
                            return;
                        }

                        // 2. Launch Razorpay Secure Checkout
                        this.launchRazorpay(body);
                    })
                    .catch(err => {
                        this.processing = false;
                        this.errorMessage = 'A network error occurred while initiating your order. Please retry.';
                    });
                },

                launchRazorpay(orderPayload) {
                    const self = this;

                    // If simulated test mode without Razorpay library, handle fallback gracefully
                    if (typeof Razorpay === 'undefined' || orderPayload.razorpay_key === 'rzp_test_luxuryhouse' || !orderPayload.razorpay_key) {
                        // Simulate payment verification for local development test credentials
                        setTimeout(() => {
                            self.verifyPayment({
                                order_id: orderPayload.order_id,
                                razorpay_order_id: orderPayload.razorpay_order_id,
                                razorpay_payment_id: 'pay_sim_' + Math.random().toString(36).substring(2, 10),
                                razorpay_signature: 'simulated_luxury_signature'
                            });
                        }, 1200);
                        return;
                    }

                    const options = {
                        key: orderPayload.razorpay_key,
                        amount: orderPayload.amount,
                        currency: orderPayload.currency || 'INR',
                        name: 'Modern Jewellery House',
                        description: 'Acquisition Order ' + orderPayload.order_number,
                        image: '{{ asset('assets/images/hero-poster.jpg') }}',
                        order_id: orderPayload.razorpay_order_id,
                        prefill: {
                            name: orderPayload.customer.name,
                            email: orderPayload.customer.email,
                            contact: orderPayload.customer.phone
                        },
                        theme: {
                            color: '#1E1E1E'
                        },
                        modal: {
                            ondismiss: function() {
                                self.processing = false;
                                self.errorMessage = 'Your payment could not be completed because the session was cancelled. You may retry your payment whenever you are ready.';
                            }
                        },
                        handler: function(response) {
                            // Server-side cryptographic signature verification
                            self.verifyPayment({
                                order_id: orderPayload.order_id,
                                razorpay_order_id: response.razorpay_order_id,
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_signature: response.razorpay_signature
                            });
                        }
                    };

                    try {
                        const rzp = new Razorpay(options);
                        rzp.on('payment.failed', function(response) {
                            self.processing = false;
                            self.errorMessage = 'Your payment could not be completed: ' + (response.error.description || 'Transaction declined by bank.');
                        });
                        rzp.open();
                    } catch (e) {
                        // Fallback simulation for local dev sandbox
                        self.verifyPayment({
                            order_id: orderPayload.order_id,
                            razorpay_order_id: orderPayload.razorpay_order_id,
                            razorpay_payment_id: 'pay_sim_' + Math.random().toString(36).substring(2, 10),
                            razorpay_signature: 'simulated_luxury_signature'
                        });
                    }
                },

                verifyPayment(verifyData) {
                    fetch('{{ route('checkout.verify') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(verifyData)
                    })
                    .then(r => r.json().then(data => ({ status: r.status, body: data })))
                    .then(({ status, body }) => {
                        this.processing = false;
                        if (status === 200 && body.success) {
                            // Redirect to Order Confirmation
                            window.location.href = body.redirect_url;
                        } else {
                            this.errorMessage = body.message || 'Payment signature authentication failed. Please contact the maison concierge.';
                        }
                    })
                    .catch(err => {
                        this.processing = false;
                        this.errorMessage = 'Payment authentication timeout. If your account was debited, the webhook will automatically reconcile your order shortly.';
                    });
                }
            };
        }
    </script>
</x-layouts.app>
