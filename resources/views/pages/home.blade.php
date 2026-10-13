<x-layouts.app
    title="Modern Jewellery House | Fine Jewellery & Contemporary Atelier"
    description="Explore 100% certified jewellery online at Modern Jewellery House. Hallmarked gold rings, certified diamond solitaires, earrings, pendants, and heirloom collections."
    :schemaJsonLd="$schemaJsonLd ?? null">

    {{-- ============================================================
         1. HAUTE VIDEO LANDING HERO (CINEMATIC ATELIER FILM BACKGROUND)
         Ultra-luxury full-width video background with sound & film controls
         ============================================================ --}}
    <x-home.video-hero />

    {{-- ============================================================
         2. FLIPKART-STYLE MAIN HOMEPAGE BANNER SLIDER
         Managed directly via Admin Panel & fully responsive
         ============================================================ --}}
    <x-home.hero-banner :banners="$heroBanners ?? collect()" />

    {{-- ============================================================
         2. SHOP BY CATEGORY — BURGUNDY BENTO MOSAIC GRID
         Exact replica of the BlueStone burgundy bento grid
         ============================================================ --}}
    <x-home.shop-by-category />

    {{-- ============================================================
         3. THREE PROMOTIONAL OFFER CARDS
         Big Gold Upgrade | 100% Off Making Charges | 10% Off Solitaires
         ============================================================ --}}
    <x-home.offer-banners :banners="$offerBanners ?? collect()" />

    {{-- ============================================================
         4. HANDPICKED FOR YOU — CURATED EDITORIAL CAMPAIGNS
         Top row (4 cards) | Bottom row (5 cards)
         ============================================================ --}}
    <x-home.handpicked-collections />

    {{-- ============================================================
         5. RECOMMENDED FOR YOU — CATEGORY STORY CIRCLES
         Horizontal circular story avatar reel with gold rings
         ============================================================ --}}
    <x-home.recommended-categories />

    {{-- ============================================================
         6. MASSIVE 4-COLUMN PRODUCT LISTING GRID
         24 certified ring designs with prices in ₹ & discount tags
         ============================================================ --}}
    <x-home.bestsellers-tabs :featuredProducts="$featuredProducts" :newArrivals="$newArrivals" />

    {{-- ============================================================
         7. INSTAGRAM REELS & SHORTS (RIGHT-TO-LEFT SMOOTH SLIDER)
         Continuous smooth right-to-left marquee of vertical 9:16 shorts
         ============================================================ --}}
    <x-home.instagram-shorts-slider />

    {{-- ============================================================
         8. ATELIER EDITORIAL HIGHLIGHTS
         Curated visual highlights of diamonds, colliers & craftsmanship
         ============================================================ --}}
    <x-home.atelier-highlights />

</x-layouts.app>
