<x-layouts.app title="Private Client Portal | Modern Jewellery House">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        
        <x-breadcrumbs :items="[
            ['label' => 'Private Client Portal']
        ]" />

        <!-- Welcome Banner -->
        <div class="my-8 pb-8 border-b border-border-subtle flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center space-x-5">
                <!-- User Avatar with Edit Trigger -->
                <div class="relative group cursor-pointer" onclick="window.dispatchEvent(new CustomEvent('open-avatar-modal'))">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full p-0.5 bg-gradient-to-tr from-[#B38728] via-[#FBF5B7] to-[#DAA520] shadow-md">
                        <img src="{{ $user->avatar_url }}" 
                             alt="{{ $user->name }}" 
                             class="w-full h-full rounded-full object-cover">
                    </div>
                    <div class="absolute inset-0 rounded-full bg-charcoal/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-ivory">
                        <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>

                <div>
                    <span class="text-[10px] uppercase tracking-[0.25em] text-gold-dark font-medium block mb-1">
                        Client Ledger
                    </span>
                    <h1 class="font-serif text-2xl sm:text-4xl text-charcoal font-normal">
                        Welcome, {{ $user->name }}
                    </h1>
                    <p class="text-xs text-charcoal-muted mt-1">
                        Member since {{ $user->created_at->format('F Y') }} • Client Status: <span class="text-gold-dark font-medium uppercase tracking-wider">Private Circle</span>
                    </p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-avatar-modal'))" class="btn-luxury-outline text-[11px] px-4 py-2.5 flex items-center space-x-1.5 cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Change Photo</span>
                </button>
                <a href="{{ route('customer.wishlist') }}" class="btn-luxury-outline text-[11px] px-4 py-2.5">
                    Saved Archive
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-luxury-primary text-[11px] px-4 py-2.5">
                        Sign Out
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <!-- Left 2 Cols: Orders & History -->
            <div class="lg:col-span-2 space-y-8">
                <div>
                    <h2 class="font-serif text-xl sm:text-2xl text-charcoal font-normal mb-4">
                        Acquisition History & Active Commissions
                    </h2>

                    @if($orders->count() > 0)
                        <div class="divide-y divide-border-subtle border border-border-subtle bg-ivory">
                            @foreach($orders as $order)
                                <div class="p-6 space-y-3">
                                    <div class="flex items-center justify-between text-xs tracking-wider uppercase">
                                        <span class="font-mono text-charcoal font-medium">{{ $order->order_number }}</span>
                                        <span class="px-2.5 py-1 text-[10px] bg-charcoal text-ivory">{{ ucfirst($order->status) }}</span>
                                    </div>
                                    <div class="text-xs text-charcoal-muted">
                                        Commissioned on {{ $order->created_at->format('M d, Y') }} • Total: <strong class="text-charcoal font-serif text-sm">${{ number_format($order->total_amount, 2) }}</strong>
                                    </div>
                                    <div class="text-xs text-charcoal-muted font-light">
                                        {{ $order->items->count() }} item(s): {{ $order->items->pluck('product_name')->join(', ') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-8 border border-dashed border-border-subtle bg-ivory/40 text-center">
                            <p class="text-xs text-charcoal-muted font-light mb-4">
                                You do not currently have any active orders or past commissions.
                            </p>
                            <a href="{{ route('products.index') }}" class="btn-luxury-outline text-[11px] px-6 py-2.5">
                                Explore Fine Collections
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Saved Pieces Snapshot -->
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-serif text-xl sm:text-2xl text-charcoal font-normal">
                            Saved in Your Wishlist
                        </h2>
                        <a href="{{ route('customer.wishlist') }}" class="text-xs uppercase tracking-widest text-gold-dark hover:text-charcoal">
                            View All →
                        </a>
                    </div>

                    @if($wishlist->count() > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            @foreach($wishlist as $wItem)
                                <a href="{{ route('products.show', $wItem->product->slug) }}" class="group block border border-border-subtle bg-ivory p-3">
                                    <img src="{{ $wItem->product ? $wItem->product->primary_image_url : asset('assets/images/hero-luxury.jpg') }}" 
                                         alt="{{ $wItem->product ? $wItem->product->name : 'Jewellery Piece' }}" 
                                         class="w-full aspect-square object-cover mb-2">

                                    <h4 class="font-serif text-xs text-charcoal truncate">{{ $wItem->product->name }}</h4>
                                    <p class="text-[11px] text-charcoal-muted mt-1 font-medium">${{ number_format($wItem->product->base_price, 2) }}</p>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-charcoal-muted font-light">No saved creations yet.</p>
                    @endif
                </div>
            </div>

            <!-- Right Column: Profile & Concierge -->
            <div class="space-y-6">
                <!-- Concierge Card -->
                <div class="bg-noir text-ivory p-6 border border-border-dark space-y-4">
                    <span class="text-[10px] uppercase tracking-[0.25em] text-gold font-medium block">
                        Dedicated Liaison
                    </span>
                    <h3 class="font-serif text-xl text-ivory font-normal">
                        Your Maison Concierge
                    </h3>
                    <p class="text-xs text-ivory-dark/70 font-light leading-relaxed">
                        For bespoke ring commissions, gemological consultations, or courier tracking adjustments, our senior liaisons are at your command.
                    </p>
                    <div class="pt-2 text-xs text-gold space-y-1">
                        <p>Telephone: +1 (800) 492-9180</p>
                        <p>Direct Wire: concierge@modernjewelleryhouse.com</p>
                    </div>
                </div>

                <!-- Account Credentials & Address -->
                <div class="bg-ivory border border-border-subtle p-6 space-y-4 text-xs">
                    <div class="flex items-center justify-between pb-2 border-b border-border-subtle">
                        <h4 class="font-serif text-lg text-charcoal font-normal">
                            Private Account Details
                        </h4>
                        <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-avatar-modal'))" class="text-[11px] text-gold-dark hover:text-charcoal font-medium uppercase tracking-wider cursor-pointer">
                            Edit Photo
                        </button>
                    </div>

                    <div class="flex items-center space-x-4 pt-1">
                        <div class="relative group cursor-pointer" onclick="window.dispatchEvent(new CustomEvent('open-avatar-modal'))">
                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-14 h-14 rounded-full object-cover border-2 border-gold shadow-sm">
                            <div class="absolute inset-0 rounded-full bg-charcoal/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-ivory">
                                <svg class="w-4 h-4 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="font-bold text-charcoal text-sm">{{ $user->name }}</p>
                            <span class="text-[10px] text-gold-dark font-medium uppercase tracking-wider block">Private Client Portrait</span>
                        </div>
                    </div>

                    <div class="space-y-1.5 pt-2 border-t border-border-subtle">
                        <p><strong class="text-charcoal font-medium">Email:</strong> {{ $user->email }}</p>
                        <p><strong class="text-charcoal font-medium">Phone:</strong> {{ $user->phone ?? 'Not specified' }}</p>
                    </div>

                    <p class="text-[11px] text-charcoal-muted pt-1 font-light">
                        To update billing credentials or delivery vaults, please contact your concierge.
                    </p>
                </div>
            </div>

        </div>

    </div>

</x-layouts.app>
