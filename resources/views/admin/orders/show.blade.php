<x-layouts.admin title="Order #{{ $order->order_number }} | Modern Jewellery House">
<div class="space-y-6" x-data="{ showInvoiceModal: false }">

    <!-- Top Header Bar with Breadcrumbs & Actions -->
    <div class="content-card p-4 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-3.5">
        <div>
            <div class="flex items-center space-x-2 text-[11px] sm:text-xs text-slate-400 mb-1">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-amber-600 transition-colors">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.orders.index') }}" class="hover:text-amber-600 transition-colors">All Orders</a>
                <span>/</span>
                <span class="text-slate-800 dark:text-slate-200 font-bold tnum">#{{ $order->order_number }}</span>
            </div>
            <div class="flex items-center space-x-2.5 flex-wrap gap-y-1.5">
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white tracking-tight font-sans">Order #{{ $order->order_number }}</h1>
                @if($order->status === 'DELIVERED')
                    <span class="order-pill pill-delivered">
                        <span style="width:5px;height:5px;border-radius:50%;background:#10B981;"></span> Delivered
                    </span>
                @elseif($order->status === 'PROCESSING')
                    <span class="order-pill pill-processing">
                        <span style="width:5px;height:5px;border-radius:50%;background:#F59E0B;"></span> Processing
                    </span>
                @elseif($order->status === 'CANCELLED')
                    <span class="order-pill pill-cancel">
                        <span style="width:5px;height:5px;border-radius:50%;background:#EF4444;"></span> Cancelled
                    </span>
                @elseif($order->status === 'SHIPPED')
                    <span class="order-pill" style="background:#F3E8FF;color:#9333EA;border:1px solid #D8B4FE;">
                        <span style="width:5px;height:5px;border-radius:50%;background:#9333EA;"></span> Shipped
                    </span>
                @elseif($order->status === 'REFUNDED')
                    <span class="order-pill" style="background:#F1F5F9;color:#64748B;border:1px solid #CBD5E1;">
                        <span style="width:5px;height:5px;border-radius:50%;background:#64748B;"></span> Refunded
                    </span>
                @else
                    <span class="order-pill pill-pending">
                        <span style="width:5px;height:5px;border-radius:50%;background:#3B82F6;"></span> Pending
                    </span>
                @endif
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold tracking-wider uppercase bg-amber-500/10 dark:bg-amber-500/20 text-amber-700 dark:text-amber-400 border border-amber-500/20">
                    VIP Patron Order
                </span>
            </div>
            <p class="text-[11px] sm:text-xs text-slate-400 mt-1">Placed on {{ $order->created_at->format('l, jS F Y \a\t h:i A') }} &bull; Modern Jewellery House Atelier</p>
        </div>

        <div class="flex items-center gap-2 flex-wrap">
            <a href="{{ route('admin.orders.index') }}" 
               class="sub-btn px-3.5 py-2 text-xs font-semibold flex items-center gap-1.5 text-slate-700 dark:text-slate-300">
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Back</span>
            </a>

            <!-- View / Print Professional Bill Receipt Button -->
            <button type="button" @click="showInvoiceModal = true" 
                    class="btn-gold px-3.5 py-2 text-xs font-bold flex items-center gap-1.5 shadow-md">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>View &amp; Print Bill Receipt</span>
            </button>

            <!-- Instant Print Button -->
            <button onclick="window.print()" 
                    class="sub-btn px-3.5 py-2 text-xs font-semibold flex items-center gap-1.5 text-slate-700 dark:text-slate-300">
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                <span>Direct Print</span>
            </button>
        </div>
    </div>

    <!-- Main Grid: Items & Calculation vs Customer & Fulfillment -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 items-start">
        
        <!-- Left 2 Columns: Items & Financial Breakdown -->
        <div class="lg:col-span-2 space-y-5">
            
            <!-- Items Card -->
            <div class="content-card p-4 sm:p-6">
                <div class="flex items-center justify-between pb-3.5 border-b border-slate-100 dark:border-white/5">
                    <div>
                        <h3 class="text-sm sm:text-base font-bold text-slate-900 dark:text-white font-serif">Acquired Fine Jewellery Pieces ({{ $order->items->count() }})</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Allocated from Modern Jewellery House High-Security Vault</p>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold text-amber-800 dark:text-amber-300 bg-amber-50 dark:bg-amber-950/40 border border-amber-300/40">
                        Vault Allocated
                    </span>
                </div>

                <div class="divide-y divide-slate-100 dark:divide-white/5 mt-1">
                    @foreach($order->items as $item)
                        @php
                            $imgSrc = $item->product?->primary_image_url ?? ($item->product && $item->product->primaryImage ? $item->product->primaryImage->url : asset('assets/images/aurelia-solitaire-diamond-ring-1.jpg'));
                        @endphp
                        <div class="py-3.5 flex items-start sm:items-center space-x-3.5">
                            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl overflow-hidden flex-shrink-0 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-white/10 p-0.5 flex items-center justify-center">
                                <img src="{{ $imgSrc }}" 
                                     alt="{{ $item->product_name }}" 
                                     onerror="this.onerror=null;this.src='{{ asset('assets/images/aurelia-solitaire-diamond-ring-1.jpg') }}'"
                                     class="w-full h-full object-cover rounded-lg">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-slate-900 dark:text-white text-xs sm:text-sm truncate">{{ $item->product_name }}</h4>
                                <div class="text-[11px] text-slate-400 space-y-0.5 mt-0.5">
                                    <p>SKU: <span class="font-bold text-slate-700 dark:text-slate-300 tnum">{{ $item->product_sku ?: 'MJH-VAULT-001' }}</span></p>
                                    @if($item->variant_title)
                                        <p>Specification: <span class="text-slate-700 dark:text-slate-300 font-semibold">{{ $item->variant_title }}</span></p>
                                    @endif
                                    @if($item->custom_engraving)
                                        <p class="text-amber-700 dark:text-amber-400 italic font-serif">Bespoke Engraving: &ldquo;{{ $item->custom_engraving }}&rdquo;</p>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <p class="text-[11px] text-slate-400 whitespace-nowrap tnum">₹ {{ number_format($item->unit_price, 2) }} &times; {{ $item->quantity }}</p>
                                <p class="text-xs sm:text-sm font-bold text-slate-900 dark:text-amber-400 mt-0.5 whitespace-nowrap tnum">₹ {{ number_format($item->total_price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Financial Calculation Section in Rupee (₹) -->
                <div class="mt-5 pt-4 border-t border-slate-100 dark:border-white/5 space-y-2 text-xs">
                    <div class="flex justify-between text-slate-500 dark:text-slate-400">
                        <span>Subtotal (Vault Value):</span>
                        <span class="font-bold text-slate-800 dark:text-slate-200 tnum">₹ {{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    @if($order->discount_amount > 0)
                        <div class="flex justify-between text-emerald-600 dark:text-emerald-400">
                            <span>Privilege Concession ({{ $order->coupon_code }}):</span>
                            <span class="font-bold tnum">- ₹ {{ number_format($order->discount_amount, 2) }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between text-slate-500 dark:text-slate-400">
                        <span>Armored Courier &amp; Transit Lloyds Insurance:</span>
                        <span class="font-bold text-slate-800 dark:text-slate-200 tnum">{{ $order->shipping_cost > 0 ? '₹ ' . number_format($order->shipping_cost, 2) : 'Complimentary White-Glove' }}</span>
                    </div>
                    @if($order->tax_amount > 0)
                        <div class="flex justify-between text-slate-500 dark:text-slate-400">
                            <span>GST (3% - CGST 1.5% + SGST 1.5%):</span>
                            <span class="font-bold text-slate-800 dark:text-slate-200 tnum">₹ {{ number_format($order->tax_amount, 2) }}</span>
                        </div>
                    @endif
                    <div class="pt-3 border-t border-slate-200/80 dark:border-white/10 flex justify-between items-center text-sm font-bold">
                        <span class="text-slate-900 dark:text-white">Total Settled Amount:</span>
                        <span class="text-base sm:text-lg font-bold text-amber-700 dark:text-amber-400 tnum">₹ {{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Client Packaging & Special Directives -->
            @if($order->notes || $order->is_gift)
                <div class="content-card p-4 sm:p-5 text-xs" style="border-left: 4px solid #DFB76C;">
                    <h4 class="font-bold text-slate-900 dark:text-white uppercase tracking-wider text-[11px] mb-2 flex items-center space-x-2">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Patron Packaging Directives</span>
                    </h4>
                    @if($order->is_gift)
                        <p class="text-amber-700 dark:text-amber-400 font-semibold">Signature Velvet Presentation Box &amp; Certified Authenticity Card requested.</p>
                        @if($order->gift_message)
                            <p class="text-slate-600 dark:text-slate-300 italic font-serif mt-1.5 p-3 rounded-xl bg-slate-100/60 dark:bg-white/[0.02] border border-slate-200/60 dark:border-white/5">&ldquo;{{ $order->gift_message }}&rdquo;</p>
                        @endif
                    @endif
                    @if($order->notes)
                        <p class="text-slate-600 dark:text-slate-300 mt-2"><span class="font-bold text-slate-800 dark:text-slate-200">Private Delivery Instructions:</span> {{ $order->notes }}</p>
                    @endif
                </div>
            @endif

        </div>

        <!-- Right Column: Status Controls & Customer Dossier -->
        <div class="space-y-5">

            <!-- Fulfillment Management -->
            <div class="content-card p-4 sm:p-5">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-white/5">
                    <h3 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white font-serif">
                        Fulfillment Orchestration
                    </h3>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Live Sync</span>
                </div>

                <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="mt-3.5 space-y-3.5">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1">Fulfillment Stage</label>
                        <select name="status" class="sub-input w-full px-3 py-2 text-xs font-semibold">
                            <option value="PENDING" {{ $order->status === 'PENDING' ? 'selected' : '' }}>Pending Verification</option>
                            <option value="PROCESSING" {{ $order->status === 'PROCESSING' ? 'selected' : '' }}>Processing & Assembly</option>
                            <option value="SHIPPED" {{ $order->status === 'SHIPPED' ? 'selected' : '' }}>Dispatched / Armored Courier</option>
                            <option value="DELIVERED" {{ $order->status === 'DELIVERED' ? 'selected' : '' }}>Delivered & Handed Over</option>
                            <option value="CANCELLED" {{ $order->status === 'CANCELLED' ? 'selected' : '' }}>Cancelled & Vault Restocked</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1">Armored Courier Tracking ID</label>
                        <input type="text" name="tracking_number" value="{{ $order->tracking_number }}" placeholder="e.g. BRINKS-BOM-998412"
                               class="sub-input w-full px-3 py-2 text-xs font-bold tnum">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1">Internal Audit Notes</label>
                        <textarea name="admin_notes" rows="2" placeholder="Private internal note..."
                                  class="sub-input w-full px-3 py-2 text-xs">{{ $order->admin_notes }}</textarea>
                    </div>

                    <button type="submit" class="btn-gold w-full py-2.5 text-xs font-bold uppercase tracking-wider">
                        Update Fulfillment Status
                    </button>
                </form>
            </div>

            <!-- Customer Profile Card -->
            <div class="content-card p-4 sm:p-5">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-white/5">
                    <h3 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white font-serif">
                        Patron Dossier
                    </h3>
                    <span class="text-[10px] font-bold text-amber-700 dark:text-amber-400 uppercase">Tier: Royal Club</span>
                </div>

                <div class="mt-3.5 flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-sm bg-amber-500/10 dark:bg-amber-500/20 border border-amber-500/30 text-amber-700 dark:text-amber-300 flex-shrink-0"
                         style="box-shadow: 2px 2px 6px rgba(166,175,195,0.3), -2px -2px 6px #FFFFFF;">
                        {{ strtoupper(substr($order->user ? $order->user->name : ($order->shipping_address['name'] ?? 'C'), 0, 2)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <h4 class="font-bold text-slate-900 dark:text-white text-xs sm:text-sm truncate">
                            {{ $order->user ? $order->user->name : ($order->shipping_address['name'] ?? 'Private Collector') }}
                        </h4>
                        <p class="text-[11px] text-slate-400 truncate mt-0.5">{{ $order->customer_email }}</p>
                    </div>
                </div>

                <div class="mt-3.5 pt-3.5 border-t border-slate-100 dark:border-white/5 space-y-2 text-xs text-slate-600 dark:text-slate-300">
                    @if($order->customer_phone)
                        <div class="flex items-center space-x-2">
                            <svg class="w-3.5 h-3.5 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span class="font-bold tnum">{{ $order->customer_phone }}</span>
                        </div>
                    @endif
                    @if($order->user)
                        <div class="pt-1">
                            <a href="{{ route('admin.customers.show', $order->user) }}" class="text-xs font-bold text-amber-700 dark:text-amber-400 hover:underline flex items-center space-x-1">
                                <span>Inspect Full Patron Profile</span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Shipping Destination Card -->
            <div class="content-card p-4 sm:p-5">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-white/5">
                    <h3 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white font-serif">
                        Shipping Residence
                    </h3>
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>

                <div class="mt-3 text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                    @if(is_array($order->shipping_address))
                        <p class="font-bold text-slate-900 dark:text-white text-xs sm:text-sm mb-1">{{ $order->shipping_address['name'] ?? '' }}</p>
                        <p>{{ $order->shipping_address['address_line1'] ?? ($order->shipping_address['address'] ?? '') }}</p>
                        @if(!empty($order->shipping_address['address_line2']))
                            <p>{{ $order->shipping_address['address_line2'] }}</p>
                        @endif
                        <p>{{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['state'] ?? '' }} {{ $order->shipping_address['pincode'] ?? '' }}</p>
                        <p class="font-bold text-amber-700 dark:text-amber-400 mt-1 uppercase tracking-wider text-[11px]">{{ $order->shipping_address['country'] ?? 'India' }}</p>
                    @else
                        <p>{{ $order->shipping_address }}</p>
                    @endif
                </div>
            </div>

        </div>

    </div>

    <!-- ================= PROFESSIONAL BILL RECEIPT MODAL & PRINT CONTAINER ================= -->
    <div x-show="showInvoiceModal" x-cloak
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/75 backdrop-blur-sm flex items-center justify-center p-3 sm:p-6"
         @click.self="showInvoiceModal = false">
        
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl max-w-2xl w-full border border-slate-200 dark:border-white/10 overflow-hidden flex flex-col max-h-[92vh]">
            
            <!-- Modal Action Bar (Screen Only) -->
            <div class="no-print p-4 border-b border-slate-200 dark:border-white/10 flex items-center justify-between bg-slate-50 dark:bg-slate-800/50">
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-700 dark:text-amber-400">Authentic Bill Receipt</span>
                    <span class="text-xs text-slate-400">&bull;</span>
                    <span class="text-xs font-mono font-bold text-slate-700 dark:text-slate-300">#{{ $order->order_number }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" onclick="window.print()" class="btn-gold px-3.5 py-1.5 text-xs font-bold flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        <span>Print Bill</span>
                    </button>
                    <button type="button" @click="showInvoiceModal = false" class="sub-btn p-1.5 text-slate-400 hover:text-slate-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            <!-- Scrollable Receipt Body -->
            <div class="overflow-y-auto p-4 sm:p-6 text-slate-900 bg-white" id="printable-bill-receipt">
                
                <!-- Brand Header -->
                <div class="text-center pb-4 border-b-2 border-slate-900 space-y-1">
                    <div class="flex items-center justify-center gap-2 mb-1">
                        <svg width="24" height="24" viewBox="0 0 48 48" fill="none" class="text-amber-600">
                            <circle cx="24" cy="24" r="16" stroke="#DFB76C" stroke-width="2"/>
                            <path d="M18 18C22 14 26 14 30 18C34 22 34 26 30 30C26 34 22 34 18 30C14 26 14 22 18 18Z" stroke="#B8860B" stroke-width="2.5"/>
                        </svg>
                        <h2 class="text-lg sm:text-xl font-bold font-serif tracking-wide text-slate-950 uppercase" style="letter-spacing: 0.06em;">MODERN JEWELLERY HOUSE</h2>
                    </div>
                    <p class="text-[10px] font-semibold text-slate-600 uppercase tracking-wider">Certified Diamond &amp; Gold Atelier &bull; BIS Hallmarked 750 / 916</p>
                    <p class="text-[10px] text-slate-500">Showroom: 142/A, Zaveri Bazaar &amp; Bandra West, Mumbai 400050 &bull; Tel: +91 98200 12345</p>
                    <p class="text-[10px] font-mono text-slate-600">GSTIN: 27AAECM5918K1ZM &bull; State Code: 27 (Maharashtra)</p>
                </div>

                <!-- Invoice Meta 2-Col Grid -->
                <div class="grid grid-cols-2 gap-4 py-3 border-b border-slate-200 text-xs">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tax Invoice Details</p>
                        <p class="font-bold text-slate-900 mt-0.5">Invoice No: <span class="font-mono">MJH-INV-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span></p>
                        <p class="text-slate-600 mt-0.5">Order Ref: <span class="font-mono font-semibold">#{{ $order->order_number }}</span></p>
                        <p class="text-slate-600 mt-0.5">Date: {{ $order->created_at->format('d M Y, h:i A') }}</p>
                        <p class="text-slate-600 mt-0.5">Payment: <span class="font-bold text-emerald-700">PAID ({{ strtoupper($order->payment_method ?? 'ONLINE / PREPAID') }})</span></p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Billed &amp; Shipped To</p>
                        <p class="font-bold text-slate-900 mt-0.5">{{ $order->user ? $order->user->name : ($order->shipping_address['name'] ?? 'Private Patron') }}</p>
                        @if($order->customer_phone)
                            <p class="text-slate-600 mt-0.5">Contact: {{ $order->customer_phone }}</p>
                        @endif
                        <p class="text-slate-600 mt-0.5 truncate">{{ $order->customer_email }}</p>
                        <p class="text-slate-600 mt-0.5 text-[11px] leading-tight">
                            @if(is_array($order->shipping_address))
                                {{ $order->shipping_address['address_line1'] ?? '' }}, {{ $order->shipping_address['city'] ?? '' }} {{ $order->shipping_address['pincode'] ?? '' }}
                            @else
                                {{ $order->shipping_address }}
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Itemized Compact Table -->
                <table class="w-full text-xs mt-3 border-collapse">
                    <thead>
                        <tr class="border-b border-slate-300 text-slate-600 font-bold uppercase text-[10px]">
                            <th class="py-1.5 text-left w-8">#</th>
                            <th class="py-1.5 text-left">Piece Description &amp; Hallmarking</th>
                            <th class="py-1.5 text-center w-16">HSN</th>
                            <th class="py-1.5 text-center w-10">Qty</th>
                            <th class="py-1.5 text-right w-20">Rate (₹)</th>
                            <th class="py-1.5 text-right w-24">Amount (₹)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($order->items as $idx => $item)
                            <tr>
                                <td class="py-2 text-slate-400 font-mono">{{ $idx + 1 }}</td>
                                <td class="py-2 pr-2">
                                    <p class="font-bold text-slate-900 text-xs leading-tight">{{ $item->product_name }}</p>
                                    <p class="text-[10px] text-slate-500 font-mono mt-0.5">
                                        SKU: {{ $item->product_sku ?: 'MJH-VAULT-001' }}
                                        @if($item->variant_title) &bull; {{ $item->variant_title }} @endif
                                        @if($item->custom_engraving) &bull; Engraved: &ldquo;{{ $item->custom_engraving }}&rdquo; @endif
                                    </p>
                                </td>
                                <td class="py-2 text-center text-[10px] font-mono text-slate-500">7113</td>
                                <td class="py-2 text-center font-bold text-slate-800">{{ $item->quantity }}</td>
                                <td class="py-2 text-right font-mono text-slate-700">{{ number_format($item->unit_price, 2) }}</td>
                                <td class="py-2 text-right font-mono font-bold text-slate-900">{{ number_format($item->total_price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Financial Calculation Summary Box -->
                <div class="mt-4 pt-3 border-t-2 border-slate-200 flex justify-end text-xs">
                    <div class="w-64 space-y-1.5 font-sans">
                        <div class="flex justify-between text-slate-600">
                            <span>Subtotal:</span>
                            <span class="font-mono font-semibold">₹ {{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        @if($order->discount_amount > 0)
                            <div class="flex justify-between text-emerald-700 font-semibold">
                                <span>Privilege Discount:</span>
                                <span class="font-mono">- ₹ {{ number_format($order->discount_amount, 2) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between text-slate-600">
                            <span>Armored Courier &amp; Transit:</span>
                            <span class="font-mono">{{ $order->shipping_cost > 0 ? '₹ ' . number_format($order->shipping_cost, 2) : 'Complimentary' }}</span>
                        </div>
                        @if($order->tax_amount > 0)
                            <div class="flex justify-between text-slate-600 text-[11px]">
                                <span>CGST (1.5%):</span>
                                <span class="font-mono">₹ {{ number_format($order->tax_amount / 2, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-slate-600 text-[11px]">
                                <span>SGST (1.5%):</span>
                                <span class="font-mono">₹ {{ number_format($order->tax_amount / 2, 2) }}</span>
                            </div>
                        @endif
                        <div class="pt-2 border-t-2 border-slate-900 flex justify-between items-baseline font-bold text-sm text-slate-950">
                            <span>Total Net Settled:</span>
                            <span class="font-mono text-base text-amber-900">₹ {{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Guarantee & Signatory Seal Footer -->
                <div class="mt-6 pt-4 border-t border-slate-200 grid grid-cols-2 gap-4 text-[10px] text-slate-500 items-end">
                    <div>
                        <p class="font-bold uppercase tracking-wider text-slate-700 mb-1">Authenticity &amp; Hallmark Guarantee</p>
                        <p class="leading-relaxed">All gemstones and gold pieces are 100% natural, certified, and compliant with Bureau of Indian Standards (BIS) hallmarking guidelines.</p>
                        <p class="mt-1 font-semibold text-slate-600">Thank you for acquiring from Modern Jewellery House.</p>
                    </div>
                    <div class="text-right flex flex-col items-end">
                        <div class="w-24 h-12 border border-dashed border-amber-600/40 rounded flex items-center justify-center text-[9px] text-amber-700 font-bold uppercase mb-1">
                            ATELIER SEAL
                        </div>
                        <p class="font-bold text-slate-900 uppercase">For MODERN JEWELLERY HOUSE</p>
                        <p class="text-[9px] text-slate-500">Authorized Signatory</p>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

<!-- Print Stylesheet -->
<style>
@media print {
    body * {
        visibility: hidden !important;
    }
    #printable-bill-receipt, #printable-bill-receipt * {
        visibility: visible !important;
    }
    #printable-bill-receipt {
        position: fixed !important;
        left: 0 !important;
        top: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
        padding: 24px !important;
        background: #ffffff !important;
        color: #000000 !important;
        box-shadow: none !important;
        border: none !important;
        z-index: 99999 !important;
    }
    .no-print {
        display: none !important;
    }
}
</style>
</x-layouts.admin>