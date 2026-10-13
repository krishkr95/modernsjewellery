<x-layouts.app title="Private Client Registration | Modern Jewellery House">

    <div class="max-w-md mx-auto px-4 py-16 sm:py-24">
        
        <div class="text-center mb-8">
            <span class="text-[10px] uppercase tracking-[0.25em] text-gold-dark font-medium block mb-2">
                Maison Membership
            </span>
            <h1 class="font-serif text-3xl text-charcoal font-normal">
                Register with the House
            </h1>
            <p class="text-xs text-charcoal-muted mt-2 font-light">
                Enjoy bespoke client privileges, saved archives, and white-glove communications.
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

            <form action="{{ route('register.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-[11px] uppercase tracking-widest text-charcoal font-medium mb-1">
                        Full Name
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus
                           class="w-full bg-ivory-light border border-border-subtle px-4 py-3 text-xs tracking-wider text-charcoal focus:outline-none focus:border-charcoal">
                </div>

                <div>
                    <label for="email" class="block text-[11px] uppercase tracking-widest text-charcoal font-medium mb-1">
                        Email Address
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email') }}" 
                           required
                           class="w-full bg-ivory-light border border-border-subtle px-4 py-3 text-xs tracking-wider text-charcoal focus:outline-none focus:border-charcoal">
                </div>

                <div>
                    <label for="phone" class="block text-[11px] uppercase tracking-widest text-charcoal font-medium mb-1">
                        Telephone (For Courier Updates)
                    </label>
                    <input type="tel" 
                           name="phone" 
                           id="phone" 
                           value="{{ old('phone') }}" 
                           placeholder="+1 (555) 000-0000"
                           class="w-full bg-ivory-light border border-border-subtle px-4 py-3 text-xs tracking-wider text-charcoal focus:outline-none focus:border-charcoal">
                </div>

                <div>
                    <label for="password" class="block text-[11px] uppercase tracking-widest text-charcoal font-medium mb-1">
                        Password
                    </label>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           required
                           class="w-full bg-ivory-light border border-border-subtle px-4 py-3 text-xs tracking-wider text-charcoal focus:outline-none focus:border-charcoal">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-[11px] uppercase tracking-widest text-charcoal font-medium mb-1">
                        Confirm Password
                    </label>
                    <input type="password" 
                           name="password_confirmation" 
                           id="password_confirmation" 
                           required
                           class="w-full bg-ivory-light border border-border-subtle px-4 py-3 text-xs tracking-wider text-charcoal focus:outline-none focus:border-charcoal">
                </div>

                <div class="pt-2">
                    <label class="flex items-start space-x-2 text-xs text-charcoal-muted cursor-pointer">
                        <input type="checkbox" name="terms" required class="mt-0.5 border-border-subtle text-charcoal focus:ring-0">
                        <span class="leading-relaxed">I agree to the Maison terms of commission, private charter, and insurance protocol.</span>
                    </label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full btn-luxury-primary text-xs py-3.5">
                        Create Private Account
                    </button>
                </div>
            </form>

            <div class="mt-6 pt-6 border-t border-border-subtle text-center text-xs text-charcoal-muted">
                <span>Already registered?</span>
                <a href="{{ route('login') }}" class="text-charcoal hover:text-gold font-medium ml-1">
                    Sign in here
                </a>
            </div>
        </div>

    </div>

</x-layouts.app>
