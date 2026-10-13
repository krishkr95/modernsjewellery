<x-layouts.app title="Sign In | Modern Jewellery House">

    <div class="max-w-md mx-auto px-4 py-16 sm:py-24">
        
        <div class="text-center mb-8">
            <span class="text-[10px] uppercase tracking-[0.25em] text-gold-dark font-medium block mb-2">
                Private Access
            </span>
            <h1 class="font-serif text-3xl text-charcoal font-normal">
                Sign In to Your Account
            </h1>
            <p class="text-xs text-charcoal-muted mt-2 font-light">
                Access your orders, saved creations, and personal concierge.
            </p>
        </div>

        <div class="bg-ivory border border-border-subtle p-8 shadow-sm">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-xs text-red-700">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-[11px] uppercase tracking-widest text-charcoal font-medium mb-1.5">
                        Email Address
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus
                           class="w-full bg-ivory-light border border-border-subtle px-4 py-3 text-xs tracking-wider text-charcoal focus:outline-none focus:border-charcoal">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-[11px] uppercase tracking-widest text-charcoal font-medium">
                            Password
                        </label>
                    </div>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           required
                           class="w-full bg-ivory-light border border-border-subtle px-4 py-3 text-xs tracking-wider text-charcoal focus:outline-none focus:border-charcoal">
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center space-x-2 text-charcoal-muted cursor-pointer">
                        <input type="checkbox" name="remember" class="border-border-subtle text-charcoal focus:ring-0">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="text-charcoal-muted hover:text-charcoal transition-colors">
                        Forgot credentials?
                    </a>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full btn-luxury-primary text-xs py-3.5">
                        Enter Private Portal
                    </button>
                </div>
            </form>

            <div class="mt-6 pt-6 border-t border-border-subtle text-center text-xs text-charcoal-muted">
                <span>Not yet a member?</span>
                <a href="{{ route('register') }}" class="text-charcoal hover:text-gold font-medium ml-1">
                    Register with Maison
                </a>
            </div>
        </div>

        <!-- Demo credentials helper -->
        <div class="mt-6 p-4 border border-dashed border-border-subtle text-[11px] text-charcoal-muted space-y-1">
            <p class="font-medium text-charcoal uppercase tracking-wider text-[10px]">Development Credentials:</p>
            <p>Admin: <span class="font-mono text-charcoal">admin@modernjewelleryhouse.com</span> / <span class="font-mono text-charcoal">Secret@12345</span></p>
            <p>Client: <span class="font-mono text-charcoal">elena@modernjewelleryhouse.com</span> / <span class="font-mono text-charcoal">Secret@12345</span></p>
        </div>

    </div>

</x-layouts.app>
