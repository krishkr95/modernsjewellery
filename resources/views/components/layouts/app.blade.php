@props([
    'title' => "Modern's Jewellery House | High Jewellery & Haute Lapidary",
    'description' => "Modern's Jewellery House is a contemporary luxury jewellery brand combining timeless Old-World craftsmanship with modern architectural design.",
    'canonical' => null,
    'robots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
    'ogTitle' => null,
    'ogDescription' => null,
    'ogImage' => null,
    'ogType' => 'website',
    'schemaJsonLd' => null,
    'preloadImage' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-ivory-light overflow-x-hidden">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Primary Technical SEO -->
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="robots" content="{{ $robots }}">
    <link rel="canonical" href="{{ $canonical ?? url()->current() }}">

    <!-- Open Graph Metadata -->
    <meta property="og:site_name" content="Modern's Jewellery House">
    <meta property="og:title" content="{{ $ogTitle ?? $title }}">
    <meta property="og:description" content="{{ $ogDescription ?? $description }}">
    <meta property="og:url" content="{{ $canonical ?? url()->current() }}">
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:image" content="{{ $ogImage ?? asset('assets/images/hero-luxury.jpg') }}">
    <meta property="og:image:alt" content="{{ $ogTitle ?? $title }}">
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $ogTitle ?? $title }}">
    <meta name="twitter:description" content="{{ $ogDescription ?? $description }}">
    <meta name="twitter:image" content="{{ $ogImage ?? asset('assets/images/hero-luxury.jpg') }}">

    <!-- Performance Preload for Hero Media -->
    @if($preloadImage)
        <link rel="preload" as="image" href="{{ $preloadImage }}" fetchpriority="high">
    @endif

    <!-- Google Fonts Preconnect & Display Swap -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Schema.org JSON-LD Structured Data -->
    @if($schemaJsonLd)
        @if(isset($schemaJsonLd['@context']))
            <script type="application/ld+json">
            {!! json_encode($schemaJsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
            </script>
        @else
            @foreach($schemaJsonLd as $singleSchema)
                @if(!empty($singleSchema))
                    <script type="application/ld+json">
                    {!! json_encode($singleSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
                    </script>
                @endif
            @endforeach
        @endif
    @endif

    <!-- Global Accessibility & Motion Styles -->
    <style>
        :focus-visible {
            outline: 2px solid #C59B4E !important;
            outline-offset: 3px !important;
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.001ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.001ms !important;
                scroll-behavior: auto !important;
            }
        }
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }
        .focus\:not-sr-only:focus {
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 99999;
            width: auto;
            height: auto;
            padding: 0.75rem 1.5rem;
            margin: 0;
            overflow: visible;
            clip: auto;
            white-space: normal;
            background-color: #141C2B;
            color: #ECC274;
            border: 1px solid #ECC274;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(0,0,0,0.4);
        }
    </style>

    <!-- Styles & Scripts via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>
<body class="flex flex-col min-h-screen text-charcoal bg-ivory-light selection:bg-gold-light selection:text-noir overflow-x-hidden w-full max-w-full"
      x-data="globalMaisonApp()"
      x-init="initMaison()">

    <!-- Accessibility Skip Link -->
    <a href="#main-content" class="sr-only focus:not-sr-only">
        Skip to main content &rarr;
    </a>

    <!-- Main Header -->
    <x-header />

    <!-- Mobile Navigation Drawer -->
    <x-mobile-navigation />

    <!-- Live Search Overlay -->
    <x-search-interface />

    <!-- Shopping Bag Slide-out Drawer -->
    <x-cart-drawer />

    <!-- Global Toast Notifications -->
    <x-toast-notification />

    <!-- Page Body -->
    <main id="main-content" class="flex-1 focus:outline-none" tabindex="-1">
        {{ $slot }}
    </main>

    <!-- Luxury Editorial Footer -->
    <x-footer />

    @auth
        <!-- Global Profile Avatar Edit Modal -->
        <x-profile-avatar-modal />
    @endauth

    <!-- Global Maison Scripts for Guest Wishlist Sync & Recently Viewed -->
    <script>
        function globalMaisonApp() {
            return {
                isAuthenticated: {{ Auth::check() ? 'true' : 'false' }},
                initMaison() {
                    // If user is authenticated, sync any pending guest wishlist items
                    if (this.isAuthenticated) {
                        try {
                            const guestWishlist = JSON.parse(localStorage.getItem('mjh_guest_wishlist') || '[]');
                            if (guestWishlist.length > 0) {
                                fetch('{{ route('wishlist.sync') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify({ product_ids: guestWishlist })
                                }).then(() => {
                                    localStorage.removeItem('mjh_guest_wishlist');
                                }).catch(() => {});
                            }
                        } catch (e) {}
                    }
                }
            }
        }
    </script>

    @stack('scripts')

</body>
</html>
