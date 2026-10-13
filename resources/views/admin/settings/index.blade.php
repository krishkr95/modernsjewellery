<x-layouts.admin title="System Settings | Modern Jewellery House">

<div class="space-y-6">

    <!-- Header -->
    <div class="content-card p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight font-sans">System & Maison Configuration</h1>
            <p class="text-xs text-slate-400 mt-1">Configure luxury commerce currency, Razorpay payments, SEO metadata, and concierge SMTP mailer.</p>
        </div>
        <div>
            <span class="px-3.5 py-1.5 bg-amber-500/10 border border-amber-500/20 text-amber-700 dark:text-amber-400 rounded-full text-[11px] font-bold tracking-wider uppercase">
                Super Admin Gate Protected
            </span>
        </div>
    </div>

    <!-- Settings Tabs -->
    <div class="flex space-x-3 pb-1 text-xs font-semibold overflow-x-auto scrollbar-none">
        @foreach(['general' => 'General Atelier', 'store' => 'Store & Currency', 'payment' => 'Razorpay Gateway', 'seo' => 'SEO Metadata', 'social' => 'Social & WhatsApp', 'email' => 'SMTP Mailer'] as $t => $label)
            <a href="{{ route('admin.settings.index', ['tab' => $t]) }}" 
               class="px-5 py-2.5 rounded-2xl whitespace-nowrap transition-all {{ $activeTab === $t ? 'gold-active-pill text-white font-bold' : 'sub-btn text-slate-600 dark:text-slate-300' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        <!-- Main Form Card (Col 2) -->
        <div class="lg:col-span-2 content-card p-6 sm:p-8 space-y-6 text-xs">
            
            <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="tab" value="{{ $activeTab }}">

                @if($activeTab === 'general')
                    <div class="pb-3 border-b border-slate-100 dark:border-slate-800">
                        <h3 class="font-bold text-slate-900 dark:text-white text-sm uppercase tracking-wider">General Brand Configuration</h3>
                        <p class="text-slate-400 text-xs mt-0.5">Primary brand metadata and private salon headquarters address</p>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Maison Brand Name</label>
                        <input type="text" name="site_name" value="{{ $settings['site_name'] }}" class="sub-input w-full px-3.5 py-2.5 text-xs font-semibold">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Concierge Email</label>
                            <input type="email" name="concierge_email" value="{{ $settings['concierge_email'] }}" class="sub-input w-full px-3.5 py-2.5 text-xs font-mono">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Concierge Hotline</label>
                            <input type="text" name="concierge_phone" value="{{ $settings['concierge_phone'] }}" class="sub-input w-full px-3.5 py-2.5 text-xs font-mono">
                        </div>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Private Salon Headquarters Address</label>
                        <textarea name="salon_address" rows="3" class="sub-input w-full px-3.5 py-2.5 text-xs leading-relaxed">{{ $settings['salon_address'] }}</textarea>
                    </div>

                @elseif($activeTab === 'store')
                    <div class="pb-3 border-b border-slate-100 dark:border-slate-800">
                        <h3 class="font-bold text-slate-900 dark:text-white text-sm uppercase tracking-wider">Store Financial Policies</h3>
                        <p class="text-slate-400 text-xs mt-0.5">Currency units and tax calculations for luxury items</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Default Currency Code</label>
                            <input type="text" name="currency_code" value="{{ $settings['currency_code'] }}" class="sub-input w-full px-3.5 py-2.5 text-xs font-mono font-bold">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Currency Symbol</label>
                            <input type="text" name="currency_symbol" value="{{ $settings['currency_symbol'] }}" class="sub-input w-full px-3.5 py-2.5 text-xs font-bold">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1.5">VAT / Tax Rate (%)</label>
                            <input type="number" step="0.01" name="tax_rate" value="{{ $settings['tax_rate'] ?? 5 }}" class="sub-input w-full px-3.5 py-2.5 text-xs font-mono">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Complimentary Shipping Threshold</label>
                            <input type="number" name="free_shipping_threshold" value="{{ $settings['free_shipping_threshold'] ?? 10000 }}" class="sub-input w-full px-3.5 py-2.5 text-xs font-mono">
                        </div>
                    </div>

                @elseif($activeTab === 'payment')
                    <div class="pb-3 border-b border-slate-100 dark:border-slate-800">
                        <h3 class="font-bold text-slate-900 dark:text-white text-sm uppercase tracking-wider">Razorpay Gateway Integration</h3>
                        <p class="text-slate-400 text-xs mt-0.5">Secure payment card processing API credentials</p>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Razorpay Key ID (Public)</label>
                        <input type="text" name="razorpay_key_id" value="{{ $settings['razorpay_key_id'] }}" class="sub-input w-full px-3.5 py-2.5 text-xs font-mono">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Razorpay Key Secret (Masked)</label>
                        <input type="password" name="razorpay_key_secret" value="{{ $settings['razorpay_key_secret'] }}" class="sub-input w-full px-3.5 py-2.5 text-xs font-mono">
                    </div>
                    <label class="flex items-center space-x-2.5 pt-1 cursor-pointer">
                        <input type="checkbox" name="razorpay_test_mode" value="1" {{ $settings['razorpay_test_mode'] ? 'checked' : '' }} class="rounded border-slate-300 text-amber-600 focus:ring-amber-500">
                        <span class="font-semibold text-slate-800 dark:text-slate-200">Enable Sandbox Simulator Mode</span>
                    </label>

                @elseif($activeTab === 'seo')
                    <div class="pb-3 border-b border-slate-100 dark:border-slate-800">
                        <h3 class="font-bold text-slate-900 dark:text-white text-sm uppercase tracking-wider">Global SEO Configuration</h3>
                        <p class="text-slate-400 text-xs mt-0.5">Search engine meta titles and descriptions for high discoverability</p>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Global Meta Title</label>
                        <input type="text" name="meta_title" value="{{ $settings['meta_title'] }}" class="sub-input w-full px-3.5 py-2.5 text-xs">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Global Meta Description</label>
                        <textarea name="meta_description" rows="3" class="sub-input w-full px-3.5 py-2.5 text-xs leading-relaxed">{{ $settings['meta_description'] }}</textarea>
                    </div>

                @elseif($activeTab === 'social')
                    <div class="pb-3 border-b border-slate-100 dark:border-slate-800">
                        <h3 class="font-bold text-slate-900 dark:text-white text-sm uppercase tracking-wider">Social Channels & Concierge</h3>
                        <p class="text-slate-400 text-xs mt-0.5">Direct client connection channels</p>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Instagram Official Profile URL</label>
                        <input type="url" name="social_instagram" value="{{ $settings['social_instagram'] }}" class="sub-input w-full px-3.5 py-2.5 text-xs font-mono">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1.5">WhatsApp Concierge Direct Number</label>
                        <input type="text" name="whatsapp_concierge" value="{{ $settings['whatsapp_concierge'] }}" class="sub-input w-full px-3.5 py-2.5 text-xs font-mono">
                    </div>

                @elseif($activeTab === 'email')
                    <div class="pb-3 border-b border-slate-100 dark:border-slate-800">
                        <h3 class="font-bold text-slate-900 dark:text-white text-sm uppercase tracking-wider">SMTP Mailer Settings</h3>
                        <p class="text-slate-400 text-xs mt-0.5">Outbound transactional mail server credentials</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1.5">SMTP Host</label>
                            <input type="text" name="smtp_host" value="{{ $settings['smtp_host'] }}" class="sub-input w-full px-3.5 py-2.5 text-xs font-mono">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1.5">SMTP Port</label>
                            <input type="number" name="smtp_port" value="{{ $settings['smtp_port'] }}" class="sub-input w-full px-3.5 py-2.5 text-xs font-mono">
                        </div>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Sender Email Address</label>
                        <input type="email" name="mail_from_address" value="{{ $settings['mail_from_address'] }}" class="sub-input w-full px-3.5 py-2.5 text-xs font-mono">
                    </div>
                @endif

                <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                    <button type="submit" class="btn-gold px-7 py-2.5 text-xs font-bold uppercase tracking-wider">
                        Save Configuration
                    </button>
                </div>
            </form>

        </div>

        <!-- Right Side: Info / Diagnostic Panel -->
        <div class="space-y-6">
            @if($activeTab === 'email')
                <div class="content-card p-6 text-xs space-y-4">
                    <h4 class="font-bold text-slate-900 dark:text-white text-sm">SMTP Diagnostic Test</h4>
                    <p class="text-slate-400">Trigger a live test email to verify your mail server configuration and SSL handshakes.</p>
                    
                    <form action="{{ route('admin.settings.test-email') }}" method="POST" class="space-y-3">
                        @csrf
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Recipient Address</label>
                            <input type="email" name="test_email" value="{{ auth()->user()->email ?? 'admin@modernjewelleryhouse.com' }}" required
                                   class="sub-input w-full px-3 py-2 text-xs font-mono">
                        </div>
                        <button type="submit" class="btn-gold w-full py-2.5 font-bold text-xs uppercase tracking-wider">
                            Dispatch Diagnostic Test
                        </button>
                    </form>
                </div>
            @endif

            <!-- Security Notice -->
            <div class="content-card p-6 text-xs space-y-3" style="border-left: 4px solid #DFB76C;">
                <div class="flex items-center space-x-2 text-amber-700 dark:text-amber-400 font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <span>Encrypted Key Vault</span>
                </div>
                <p class="text-slate-500 dark:text-slate-400 leading-relaxed">
                    All payment gateway secrets, API tokens, and webhook signers are encrypted at rest using AES-256-GCM under master application key envelopes.
                </p>
            </div>
        </div>

    </div>

</div>

</x-layouts.admin>
