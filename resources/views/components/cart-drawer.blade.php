@php
    $drawerCart = \App\Http\Controllers\CartController::getActiveCart(request());
@endphp

<div x-show="$store.cartDrawer.open"
     style="display: none;"
     class="fixed inset-0 z-50 overflow-hidden"
     x-data="cartDrawerManager()"
     x-init="initDrawer()"
     @keydown.escape.window="$store.cartDrawer.close()">

    <!-- Backdrop with luxury blur -->
    <div x-show="$store.cartDrawer.open"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="$store.cartDrawer.close()"
         class="fixed inset-0 bg-noir/75 backdrop-blur-sm transition-opacity"></div>

    <!-- Right Drawer Panel -->
    <div class="fixed inset-y-0 right-0 max-w-full flex">
        <aside x-show="$store.cartDrawer.open"
               x-transition:enter="transform transition ease-out duration-300 sm:duration-400"
               x-transition:enter-start="translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transform transition ease-in duration-200"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="translate-x-full"
               class="w-screen max-w-md bg-ivory border-l border-border-subtle shadow-2xl flex flex-col justify-between z-10">

            <!-- Drawer Header -->
            <div class="p-6 border-b border-border-subtle flex items-center justify-between bg-ivory">
                <div class="flex items-center space-x-2">
                    <h3 class="font-serif text-lg tracking-wider uppercase text-charcoal font-normal">
                        Your Shopping Bag
                    </h3>
                    <span class="text-xs font-mono text-gold-dark px-2 py-0.5 bg-ivory-light border border-border-subtle rounded-full"
                          x-text="'(' + itemCount + ')'">
                        ({{ $drawerCart->items->count() }})
                    </span>
                </div>

                <button type="button" 
                        @click="$store.cartDrawer.close()"
                        class="p-2 -mr-2 text-charcoal-muted hover:text-charcoal transition-colors focus:outline-none"
                        aria-label="Close Shopping Bag">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Drawer Dynamic Body -->
            <div class="flex-1 flex flex-col overflow-hidden relative" id="drawer-dynamic-body" x-html="bodyHtml">
                @include('components.cart-drawer-content', ['drawerCart' => $drawerCart])
            </div>

        </aside>
    </div>

    <!-- Script for Live Drawer AJAX Updates -->
    <script>
        function cartDrawerManager() {
            return {
                bodyHtml: '',
                itemCount: {{ $drawerCart->items->count() }},
                loading: false,

                initDrawer() {
                    this.$watch('$store.cartDrawer.open', (isOpen) => {
                        if (isOpen) {
                            this.fetchDrawer();
                        }
                    });

                    window.addEventListener('cart-updated', () => {
                        this.fetchDrawer();
                    });
                },

                fetchDrawer() {
                    this.loading = true;
                    fetch('{{ route('cart.drawer') }}', {
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                    .then(r => r.json())
                    .then(d => {
                        this.loading = false;
                        if (d.html) {
                            this.bodyHtml = d.html;
                            this.itemCount = d.cart_count || 0;
                            const badgeEl = document.getElementById('header-bag-count');
                            if (badgeEl) badgeEl.innerText = d.cart_count || 0;
                        }
                    })
                    .catch(err => {
                        this.loading = false;
                        console.error('Failed to load cart drawer:', err);
                    });
                },

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
                            this.fetchDrawer();
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
                        if (d.success) {
                            this.fetchDrawer();
                        }
                    })
                    .catch(e => console.error(e));
                }
            };
        }
    </script>
</div>