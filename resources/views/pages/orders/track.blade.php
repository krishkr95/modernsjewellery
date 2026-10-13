@php
    $allStates = [
        'PENDING' => 'Order Initiated',
        'PAYMENT_PENDING' => 'Awaiting Payment',
        'PAID' => 'Payment Verified',
        'PROCESSING' => 'Atelier Handcrafting',
        'PACKED' => 'Vault Presentation Case Packed',
        'SHIPPED' => 'Armored Courier Dispatched',
        'OUT_FOR_DELIVERY' => 'Out for White-Glove Handover',
        'DELIVERED' => 'Delivered & Signed',
    ];

    $currentState = strtoupper($order->status);
    $stateKeys = array_keys($allStates);
    $currentIndex = array_search($currentState, $stateKeys);
    if ($currentIndex === false) {
        $currentIndex = ($order->payment_status === 'paid') ? 2 : 0;
    }
@endphp

<x-layouts.app title="Track Order — {{ $order->order_number }} | Modern Jewellery House">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
        
        <x-breadcrumbs :items="[
            ['label' => 'Maison Orders', 'url' => route('customer.dashboard')],
            ['label' => 'Track ' . $order->order_number]
        ]" />

        <!-- Header -->
        <div class="my-8 sm:my-10">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-border-subtle pb-6">
                <div>
                    <span class="text-[10px] uppercase tracking-[0.25em] text-gold-dark font-medium block mb-1">
                        Live Creation Dispatch Timeline
                    </span>
                    <h1 class="font-serif text-2xl sm:text-4xl text-charcoal font-normal">
                        Order {{ $order->order_number }}
                    </h1>
                </div>

                <div class="text-left sm:text-right">
                    <span class="text-[10px] uppercase tracking-wider text-charcoal-muted block">Status</span>
                    <span class="inline-block bg-charcoal text-ivory text-[10px] uppercase tracking-[0.2em] px-3 py-1 font-mono font-medium mt-1">
                        {{ str_replace('_', ' ', $order->status) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Visual 8-Step Timeline Across Requested Order States -->
        <div class="bg-ivory border border-border-subtle p-6 sm:p-10 mb-10 shadow-sm">
            <span class="text-[10px] uppercase tracking-[0.25em] font-medium text-charcoal block mb-8">
                Provenance & Handover Milestones
            </span>

            <div class="relative">
                <!-- Progress Line -->
                <div class="absolute left-4 top-4 bottom-4 w-0.5 bg-border-subtle sm:left-0 sm:top-1/2 sm:bottom-auto sm:w-full sm:h-0.5 sm:-translate-y-1/2"></div>
                
                <div class="space-y-6 sm:space-y-0 sm:grid sm:grid-cols-4 sm:gap-4 relative z-10">
                    @foreach(['PAID', 'PROCESSING', 'SHIPPED', 'DELIVERED'] as $milestoneIdx => $stepKey)
                        @php
                            $stepIndexInAll = array_search($stepKey, $stateKeys);
                            $isPassed = ($currentIndex >= $stepIndexInAll);
                            $isCurrent = ($currentState === $stepKey);
                        @endphp
                        <div class="flex sm:flex-col items-center sm:text-center space-x-4 sm:space-x-0">
                            <!-- Dot Icon -->
                            <div class="w-8 h-8 rounded-full border-2 flex items-center justify-center transition-all {{ $isPassed ? 'bg-charcoal border-charcoal text-ivory' : 'bg-ivory border-border-subtle text-charcoal-muted' }} {{ $isCurrent ? 'ring-4 ring-gold/30' : '' }}">
                                @if($isPassed)
                                    <svg class="w-4 h-4 text-gold" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                @else
                                    <span class="text-[10px] font-mono">{{ $milestoneIdx + 1 }}</span>
                                @endif
                            </div>

                            <!-- Text -->
                            <div class="sm:mt-3">
                                <span class="text-[11px] uppercase tracking-wider font-medium {{ $isPassed ? 'text-charcoal' : 'text-charcoal-muted' }} block">
                                    {{ $allStates[$stepKey] }}
                                </span>
                                @if($isCurrent)
                                    <span class="text-[9px] uppercase tracking-widest text-gold-dark font-mono block mt-0.5">Active Stage</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Armored Courier Information -->
            <div class="mt-10 pt-6 border-t border-border-subtle/80 flex flex-col sm:flex-row sm:items-center justify-between text-xs text-charcoal-muted font-light gap-4">
                <div>
                    <span class="font-medium text-charcoal">Courier Service:</span>
                    <span>{{ $order->shipping_method }}</span>
                </div>
                <div>
                    <span class="font-medium text-charcoal">Tracking Reference:</span>
                    <span class="font-mono text-charcoal">{{ $order->tracking_number ?? 'ARMORED-SEC-'.strtoupper(substr(md5($order->id), 0, 8)) }}</span>
                </div>
            </div>
        </div>

        <!-- Back to Catalogue CTA -->
        <div class="text-center pt-4">
            <a href="{{ route('shop') }}" class="btn-luxury-primary text-xs py-3.5 px-8">
                Continue Exploring Creations
            </a>
        </div>

    </div>

</x-layouts.app>
