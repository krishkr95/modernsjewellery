@props([
    'categories' => [],
])

<nav class="hidden lg:flex items-center justify-center space-x-10 text-[12px] tracking-[0.2em] uppercase font-medium text-charcoal">
    <a href="{{ route('products.index') }}" 
       class="relative py-2 text-charcoal hover:text-gold-dark transition-colors duration-200 group">
        All Creations
        <span class="absolute bottom-0 left-0 w-0 h-[1.5px] bg-gold transition-all duration-300 group-hover:w-full"></span>
    </a>

    <a href="{{ route('products.index', ['category' => 'rings']) }}" 
       class="relative py-2 text-charcoal hover:text-gold-dark transition-colors duration-200 group">
        Rings
        <span class="absolute bottom-0 left-0 w-0 h-[1.5px] bg-gold transition-all duration-300 group-hover:w-full"></span>
    </a>

    <a href="{{ route('products.index', ['category' => 'necklaces']) }}" 
       class="relative py-2 text-charcoal hover:text-gold-dark transition-colors duration-200 group">
        Necklaces
        <span class="absolute bottom-0 left-0 w-0 h-[1.5px] bg-gold transition-all duration-300 group-hover:w-full"></span>
    </a>

    <a href="{{ route('products.index', ['category' => 'earrings']) }}" 
       class="relative py-2 text-charcoal hover:text-gold-dark transition-colors duration-200 group">
        Earrings
        <span class="absolute bottom-0 left-0 w-0 h-[1.5px] bg-gold transition-all duration-300 group-hover:w-full"></span>
    </a>

    <a href="{{ route('products.index', ['category' => 'bracelets']) }}" 
       class="relative py-2 text-charcoal hover:text-gold-dark transition-colors duration-200 group">
        Bracelets
        <span class="absolute bottom-0 left-0 w-0 h-[1.5px] bg-gold transition-all duration-300 group-hover:w-full"></span>
    </a>

    <a href="{{ route('products.index', ['category' => 'high-jewellery']) }}" 
       class="relative py-2 text-charcoal hover:text-gold-dark transition-colors duration-200 group">
        High Jewellery
        <span class="absolute bottom-0 left-0 w-0 h-[1.5px] bg-gold transition-all duration-300 group-hover:w-full"></span>
    </a>

    <a href="{{ route('products.index', ['collection' => 'heritage-noir']) }}" 
       class="relative py-2 text-gold-dark hover:text-charcoal transition-colors duration-200 group">
        Collections
        <span class="absolute bottom-0 left-0 w-0 h-[1.5px] bg-charcoal transition-all duration-300 group-hover:w-full"></span>
    </a>
</nav>
