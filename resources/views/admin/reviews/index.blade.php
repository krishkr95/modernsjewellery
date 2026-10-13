<x-layouts.admin title="Customer Reviews &amp; Imagery Moderation | Modern Jewellery House">

    <div class="space-y-6" x-data="{ 
        viewMode: 'list', // 'list' (primary desktop list type) or 'imagery' (gallery wall)
        zoomModal: false,
        activeImage: null,
        activeImageId: null,
        activeProduct: '',
        activePatron: '',
        activeRating: 5,
        activeComment: ''
    }">
        
        <!-- ========================================================
             ATELIER HEADER & TITLE
             ======================================================== -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-2">
            <div>
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="w-5 h-px bg-[#DFB76C]"></span>
                    <span class="text-[10px] uppercase tracking-widest font-bold text-amber-700 dark:text-amber-400">
                        Patron Relations &bull; Curation Bureau
                    </span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
                    <span>Customer Reviews &amp; Imagery Moderation</span>
                    <span class="text-xs px-2.5 py-1 rounded-full font-bold bg-amber-500/10 text-amber-700 dark:text-amber-300 border border-amber-500/20">
                        {{ $totalCount }} Submissions
                    </span>
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1 max-w-2xl font-normal leading-relaxed">
                    Examine verified patron testimonials, star ratings, and real customer product photography in a high-density moderation list.
                </p>
            </div>

            <!-- View Switcher (List Type vs Imagery Wall) -->
            <div class="flex items-center gap-1.5 p-1 bg-slate-200/60 dark:bg-slate-800/80 rounded-xl border border-slate-300/50 dark:border-white/10 flex-shrink-0">
                <button type="button" 
                        @click="viewMode = 'list'"
                        :class="viewMode === 'list' ? 'bg-white dark:bg-[#141C2B] text-slate-900 dark:text-white shadow-xs font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 font-semibold'"
                        class="flex items-center gap-2 px-3.5 py-1.5 rounded-lg text-xs transition-all cursor-pointer">
                    <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                    <span>List View (Table)</span>
                </button>
                <button type="button" 
                        @click="viewMode = 'imagery'"
                        :class="viewMode === 'imagery' ? 'bg-white dark:bg-[#141C2B] text-slate-900 dark:text-white shadow-xs font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 font-semibold'"
                        class="flex items-center gap-2 px-3.5 py-1.5 rounded-lg text-xs transition-all cursor-pointer">
                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Imagery Wall ({{ $totalImagesCount }})</span>
                </button>
            </div>
        </div>

        <!-- ========================================================
             ROW 1: 4 LUXURY KPI METRIC CARDS
             ======================================================== -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <!-- KPI 1: Average Rating Score -->
            <div class="kpi-card p-4 sm:p-5" style="border-left: 4px solid #DFB76C !important;">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Patron Satisfaction</span>
                    <div class="w-8 h-8 rounded-xl bg-amber-500/10 dark:bg-amber-500/20 border border-amber-500/30 flex items-center justify-center text-amber-600 dark:text-amber-400 text-sm">
                        ★
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tnum font-sans">
                        {{ $averageRating }}
                    </span>
                    <span class="text-xs font-semibold text-slate-400">/ 5.0 Score</span>
                </div>
                <div class="flex items-center gap-1.5 text-amber-500 text-xs mt-1">
                    ★★★★★
                    <span class="text-[11px] text-slate-400 dark:text-slate-500 font-mono ml-1">({{ $totalCount }} total reviews)</span>
                </div>
            </div>

            <!-- KPI 2: Pending Moderation -->
            <div class="kpi-card p-4 sm:p-5" style="border-left: 4px solid #F59E0B !important;">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pending Moderation</span>
                    <div class="w-8 h-8 rounded-xl bg-orange-500/10 dark:bg-orange-500/20 border border-orange-500/30 flex items-center justify-center text-orange-600 dark:text-orange-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tnum font-sans">
                        {{ $pendingCount }}
                    </span>
                    <span class="text-xs font-semibold {{ $pendingCount > 0 ? 'text-amber-600 dark:text-amber-400 font-bold' : 'text-slate-400' }}">
                        {{ $pendingCount > 0 ? 'Requires Action' : 'All Clear' }}
                    </span>
                </div>
                <p class="text-[11px] text-slate-400 dark:text-slate-500 mt-1">
                    {{ $pendingCount > 0 ? 'Reviews awaiting team verification' : 'Zero unreviewed items in queue' }}
                </p>
            </div>

            <!-- KPI 3: Customer Real Photos -->
            <div class="kpi-card p-4 sm:p-5" style="border-left: 4px solid #10B981 !important;">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Customer Photos</span>
                    <div class="w-8 h-8 rounded-xl bg-emerald-500/10 dark:bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tnum font-sans">
                        {{ $totalImagesCount }}
                    </span>
                    <span class="text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                        Across {{ $withImagesCount }} reviews
                    </span>
                </div>
                <p class="text-[11px] text-slate-400 dark:text-slate-500 mt-1">
                    Real unboxing and wearing jewelry photos
                </p>
            </div>

            <!-- KPI 4: Approved & Featured -->
            <div class="kpi-card p-4 sm:p-5" style="border-left: 4px solid #8B5CF6 !important;">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Storefront Live</span>
                    <div class="w-8 h-8 rounded-xl bg-purple-500/10 dark:bg-purple-500/20 border border-purple-500/30 flex items-center justify-center text-purple-600 dark:text-purple-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tnum font-sans">
                        {{ $approvedCount }}
                    </span>
                    <span class="text-xs font-semibold text-purple-600 dark:text-purple-400">
                        {{ $featuredCount }} Featured
                    </span>
                </div>
                <p class="text-[11px] text-slate-400 dark:text-slate-500 mt-1">
                    Live across product pages &amp; homepage
                </p>
            </div>

        </div>

        <!-- ========================================================
             TOOLBAR: STATUS TABS, RATING FILTER & SEARCH
             ======================================================== -->
        <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-3 pt-2">
            
            <!-- Status Tabs -->
            <div class="flex items-center gap-1.5 overflow-x-auto scrollbar-none pb-1 text-xs font-semibold">
                <a href="{{ route('admin.reviews.index', array_merge(request()->except('status', 'page'))) }}" 
                   class="px-3.5 py-1.5 rounded-full transition-all whitespace-nowrap {{ !request('status') ? 'bg-[#0a2240] text-amber-300 font-bold shadow-sm' : 'bg-white dark:bg-[#141C2B] text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-white/10 hover:bg-slate-50 dark:hover:bg-white/5' }}">
                    All Submissions ({{ $totalCount }})
                </a>
                
                <a href="{{ route('admin.reviews.index', array_merge(request()->except('status', 'page'), ['status' => 'pending'])) }}" 
                   class="px-3.5 py-1.5 rounded-full transition-all whitespace-nowrap flex items-center gap-1.5 {{ request('status') === 'pending' ? 'bg-[#0a2240] text-amber-300 font-bold shadow-sm' : 'bg-white dark:bg-[#141C2B] text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-white/10 hover:bg-slate-50 dark:hover:bg-white/5' }}">
                    @if($pendingCount > 0)
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    @endif
                    <span>Pending Moderation ({{ $pendingCount }})</span>
                </a>

                <a href="{{ route('admin.reviews.index', array_merge(request()->except('status', 'page'), ['status' => 'approved'])) }}" 
                   class="px-3.5 py-1.5 rounded-full transition-all whitespace-nowrap {{ request('status') === 'approved' ? 'bg-[#0a2240] text-amber-300 font-bold shadow-sm' : 'bg-white dark:bg-[#141C2B] text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-white/10 hover:bg-slate-50 dark:hover:bg-white/5' }}">
                    Approved Public ({{ $approvedCount }})
                </a>

                <a href="{{ route('admin.reviews.index', array_merge(request()->except('status', 'page'), ['status' => 'with_images'])) }}" 
                   class="px-3.5 py-1.5 rounded-full transition-all whitespace-nowrap flex items-center gap-1.5 {{ request('status') === 'with_images' ? 'bg-[#0a2240] text-amber-300 font-bold shadow-sm' : 'bg-white dark:bg-[#141C2B] text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-white/10 hover:bg-slate-50 dark:hover:bg-white/5' }}">
                    <span>📸 With Photos ({{ $withImagesCount }})</span>
                </a>

                <a href="{{ route('admin.reviews.index', array_merge(request()->except('status', 'page'), ['status' => 'featured'])) }}" 
                   class="px-3.5 py-1.5 rounded-full transition-all whitespace-nowrap {{ request('status') === 'featured' ? 'bg-[#0a2240] text-amber-300 font-bold shadow-sm' : 'bg-white dark:bg-[#141C2B] text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-white/10 hover:bg-slate-50 dark:hover:bg-white/5' }}">
                    ★ Featured Showcase ({{ $featuredCount }})
                </a>
            </div>

            <!-- Filter Controls: Rating & Search -->
            <form method="GET" action="{{ route('admin.reviews.index') }}" class="flex items-center gap-2">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif

                <!-- Rating Dropdown -->
                <select name="rating" 
                        onchange="this.form.submit()"
                        class="bg-white dark:bg-[#141C2B] border border-slate-200 dark:border-white/10 rounded-xl px-3 py-1.5 text-xs text-slate-800 dark:text-slate-200 font-medium outline-none focus:border-amber-500 shadow-2xs">
                    <option value="">All Ratings (1 - 5 Stars)</option>
                    <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Stars ★★★★★</option>
                    <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Stars ★★★★☆</option>
                    <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Stars ★★★☆☆</option>
                    <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Stars ★★☆☆☆</option>
                    <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Star ★☆☆☆☆</option>
                </select>

                <!-- Search Input -->
                <div class="relative w-52 sm:w-60">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Search piece, patron, SKU..." 
                           class="w-full bg-white dark:bg-[#141C2B] border border-slate-200 dark:border-white/10 rounded-xl pl-9 pr-7 py-1.5 text-xs text-slate-900 dark:text-white placeholder-slate-400 outline-none focus:border-amber-500 shadow-2xs">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
                    </svg>
                    @if(request('search'))
                        <a href="{{ route('admin.reviews.index', request()->only('status', 'rating')) }}" class="absolute right-2.5 top-1.5 text-xs text-slate-400 hover:text-slate-600">✕</a>
                    @endif
                </div>
            </form>

        </div>

        <!-- ========================================================
             VIEW 1: LUXURY LIST TYPE TABLE (Primary Desktop View)
             ======================================================== -->
        <div x-show="viewMode === 'list'" class="content-card p-4 sm:p-6 shadow-sm overflow-hidden">
            <div class="table-responsive-container">
                <table class="admin-table" style="min-width: 960px;">
                    <thead>
                        <tr>
                            <th style="width: 220px;">Creation (Piece)</th>
                            <th style="width: 180px;">Client Dossier</th>
                            <th style="width: 110px;">Rating</th>
                            <th>Review Commentary</th>
                            <th style="width: 140px;">Customer Photos</th>
                            <th style="width: 110px;">Status</th>
                            <th style="width: 120px; text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $rev)
                            @php
                                $productImg = $rev->product?->primaryImage ? asset($rev->product->primaryImage->image_path) : asset('assets/images/hero-luxury.jpg');
                                $initial = strtoupper(substr($rev->reviewer_name, 0, 1));
                            @endphp
                            <tr class="hover:bg-slate-50/80 dark:hover:bg-white/5 transition-colors">
                                
                                <!-- 1. Creation / Product Column -->
                                <td style="vertical-align: middle;">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $productImg }}" 
                                             alt="{{ $rev->product?->name }}" 
                                             class="w-11 h-11 rounded-lg object-cover border border-slate-200 dark:border-white/10 flex-shrink-0 shadow-2xs">
                                        <div class="min-w-0 max-w-[150px]">
                                            <a href="{{ $rev->product ? route('products.show', $rev->product->slug) : '#' }}" 
                                               target="_blank" 
                                               class="font-serif font-bold text-xs text-slate-900 dark:text-white hover:text-amber-600 dark:hover:text-amber-400 line-clamp-1">
                                                {{ $rev->product->name ?? 'Archived Creation' }}
                                            </a>
                                            <div class="flex items-center gap-1.5 mt-0.5">
                                                <span class="text-[9.5px] font-mono font-bold text-slate-500 dark:text-slate-400">
                                                    {{ $rev->product->sku ?? 'NO-SKU' }}
                                                </span>
                                                @if($rev->product)
                                                    <a href="{{ route('products.show', $rev->product->slug) }}" 
                                                       target="_blank" 
                                                       class="text-[9px] text-amber-600 dark:text-amber-400 hover:underline">
                                                        ↗
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- 2. Client Dossier Column -->
                                <td style="vertical-align: middle;">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full bg-[#0a2240] text-amber-300 font-bold flex items-center justify-center text-[11px] shadow-2xs flex-shrink-0">
                                            {{ $initial }}
                                        </div>
                                        <div class="min-w-0">
                                            <span class="font-bold text-xs text-slate-900 dark:text-white block truncate">
                                                {{ $rev->reviewer_name }}
                                            </span>
                                            @if($rev->customer_email || $rev->user?->email)
                                                <span class="text-[10px] text-slate-400 block font-mono truncate">
                                                    {{ $rev->customer_email ?? $rev->user?->email }}
                                                </span>
                                            @endif
                                            @if($rev->is_verified_buyer)
                                                <span class="inline-flex items-center gap-0.5 text-[9px] text-emerald-600 dark:text-emerald-400 font-bold">
                                                    <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Verified
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <!-- 3. Rating Column -->
                                <td style="vertical-align: middle;">
                                    <div class="flex items-center text-amber-400 text-xs">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span>{{ $i <= $rev->rating ? '★' : '☆' }}</span>
                                        @endfor
                                    </div>
                                    <span class="text-[10px] font-bold text-slate-500 dark:text-slate-400 font-mono block mt-0.5">
                                        {{ $rev->rating }}.0 / 5
                                    </span>
                                </td>

                                <!-- 4. Review Commentary Column -->
                                <td style="vertical-align: middle; max-width: 280px;">
                                    @if($rev->title)
                                        <span class="font-serif font-bold text-xs text-slate-900 dark:text-white block truncate mb-0.5">
                                            “{{ $rev->title }}”
                                        </span>
                                    @endif
                                    <p class="text-xs text-slate-600 dark:text-slate-300 line-clamp-2 leading-relaxed">
                                        {{ $rev->comment }}
                                    </p>
                                    <span class="text-[9.5px] text-slate-400 font-mono block mt-1">
                                        {{ $rev->created_at->format('d M Y • h:i A') }}
                                    </span>
                                </td>

                                <!-- 5. Customer Photos Column -->
                                <td style="vertical-align: middle;">
                                    @if($rev->images->isNotEmpty())
                                        <div class="flex items-center gap-1.5 flex-wrap">
                                            @foreach($rev->images as $img)
                                                <div class="group relative w-10 h-10 rounded-lg overflow-hidden border border-slate-200 dark:border-white/10 shadow-2xs flex-shrink-0">
                                                    <img src="{{ $img->image_url }}" 
                                                         alt="Client photo" 
                                                         @click="activeImage = '{{ $img->image_url }}'; activeImageId = {{ $img->id }}; activeProduct = '{{ addslashes($rev->product?->name ?? '') }}'; activePatron = '{{ addslashes($rev->reviewer_name) }}'; activeRating = {{ $rev->rating }}; activeComment = '{{ addslashes(Str::limit($rev->comment, 120)) }}'; zoomModal = true"
                                                         class="w-full h-full object-cover cursor-pointer hover:scale-110 transition-transform">
                                                    
                                                    <!-- Delete Single Image Form Overlay -->
                                                    <form action="{{ route('admin.reviews.images.destroy', $img) }}" 
                                                          method="POST" 
                                                          class="absolute inset-0 bg-red-950/80 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center"
                                                          onsubmit="return confirm('Permanently remove this specific customer photo?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="p-1 text-white hover:text-red-200 cursor-pointer" 
                                                                title="Delete this image">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endforeach
                                        </div>
                                        <span class="text-[9px] text-slate-400 block mt-1 font-mono">
                                            {{ $rev->images->count() }} photo{{ $rev->images->count() > 1 ? 's' : '' }} &bull; click zoom
                                        </span>
                                    @else
                                        <span class="text-slate-400 text-xs italic">No photos</span>
                                    @endif
                                </td>

                                <!-- 6. Status Column -->
                                <td style="vertical-align: middle;">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $rev->is_approved ? 'bg-emerald-50 text-emerald-700 border border-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-400 dark:border-emerald-500/20' : 'bg-amber-50 text-amber-700 border border-amber-200 dark:bg-amber-500/10 dark:text-amber-400 dark:border-amber-500/20 animate-pulse' }}">
                                        {{ $rev->is_approved ? 'Approved' : 'Pending' }}
                                    </span>
                                    @if($rev->is_featured)
                                        <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-purple-50 text-purple-700 border border-purple-200 dark:bg-purple-500/10 dark:text-purple-400 dark:border-purple-500/20 block mt-1 w-max">
                                            ★ Featured
                                        </span>
                                    @endif
                                </td>

                                <!-- 7. Actions Column -->
                                <td style="vertical-align: middle; text-align: right;">
                                    <div class="inline-flex items-center gap-1.5">
                                        @if(!$rev->is_approved)
                                            <form action="{{ route('admin.reviews.approve', $rev) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="px-2 py-1 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-[11px] font-bold transition-all shadow-2xs cursor-pointer"
                                                        title="Approve for public storefront">
                                                    Approve
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.reviews.reject', $rev) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="px-2 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-amber-50 hover:text-amber-700 text-slate-600 dark:text-slate-300 text-[11px] font-semibold transition-all cursor-pointer"
                                                        title="Unapprove review">
                                                    Hide
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('admin.reviews.feature', $rev) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    title="{{ $rev->is_featured ? 'Remove from featured' : 'Feature on homepage' }}"
                                                    class="p-1.5 rounded-lg border {{ $rev->is_featured ? 'bg-purple-50 text-purple-700 border-purple-200 dark:bg-purple-500/20 dark:text-purple-300' : 'bg-white dark:bg-slate-800 text-slate-500 dark:text-slate-400 border-slate-200 dark:border-white/10 hover:text-purple-600' }} text-xs font-bold transition-all cursor-pointer">
                                                ★
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.reviews.destroy', $rev) }}" 
                                              method="POST" 
                                              class="inline" 
                                              onsubmit="return confirm('Permanently delete review #{{ $rev->id }} and all customer photos?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-1.5 rounded-lg text-rose-500 hover:text-white hover:bg-rose-600 border border-rose-200 dark:border-rose-500/20 transition-all cursor-pointer"
                                                    title="Delete review">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">
                                    <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-white/5 flex items-center justify-center mx-auto mb-2 text-xl">
                                        💎
                                    </div>
                                    <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">No customer reviews found</p>
                                    <p class="text-xs text-slate-400 mt-0.5">Try adjusting your status or search criteria.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($reviews->hasPages())
                <div class="pt-4 border-t border-slate-100 dark:border-white/5 mt-4">
                    {{ $reviews->links() }}
                </div>
            @endif
        </div>

        <!-- ========================================================
             VIEW 2: DEDICATED CUSTOMER IMAGERY HUB (Wall Mode)
             ======================================================== -->
        <div x-show="viewMode === 'imagery'" style="display: none;" class="space-y-4">
            
            <div class="flex items-center justify-between pb-2">
                <div>
                    <h3 class="font-serif font-bold text-lg text-slate-900 dark:text-white">
                        Visual Imagery Moderation Wall
                    </h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400">
                        Inspect client unboxing and jewelry wear photos directly. Click any image to examine detail or delete inappropriate submissions.
                    </p>
                </div>
                <span class="text-xs font-mono font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 px-3 py-1.5 rounded-lg border border-slate-200 dark:border-white/10">
                    Total: {{ $totalImagesCount }} Customer Photos
                </span>
            </div>

            <!-- Imagery Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @forelse($customerImages as $cImg)
                    <div class="content-card p-2 group relative overflow-hidden transition-all hover:scale-[1.02] flex flex-col justify-between">
                        
                        <!-- Photo Thumbnail Box -->
                        <div class="relative aspect-square rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-900">
                            <img src="{{ $cImg->image_url }}" 
                                 alt="Customer photo" 
                                 class="w-full h-full object-cover">
                            
                            <!-- Hover Action Overlay -->
                            <div class="absolute inset-0 bg-slate-950/70 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                <!-- Zoom Button -->
                                <button type="button" 
                                        @click="activeImage = '{{ $cImg->image_url }}'; activeImageId = {{ $cImg->id }}; activeProduct = '{{ addslashes($cImg->review?->product?->name ?? '') }}'; activePatron = '{{ addslashes($cImg->review?->reviewer_name ?? 'Patron') }}'; activeRating = {{ $cImg->review?->rating ?? 5 }}; activeComment = '{{ addslashes(Str::limit($cImg->review?->comment ?? '', 120)) }}'; zoomModal = true"
                                        class="p-2 rounded-lg bg-white/20 hover:bg-white text-white hover:text-slate-900 transition-all cursor-pointer"
                                        title="Examine full-size">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/>
                                    </svg>
                                </button>

                                <!-- Direct Delete Button -->
                                <form action="{{ route('admin.reviews.images.destroy', $cImg) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Delete this specific customer photo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="p-2 rounded-lg bg-red-600/80 hover:bg-red-600 text-white transition-all cursor-pointer"
                                            title="Delete customer photo">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Information Footer -->
                        <div class="mt-2 px-1">
                            <span class="font-bold text-[11px] text-slate-900 dark:text-white truncate block">
                                {{ $cImg->review?->product?->name ?? 'Jewelry Piece' }}
                            </span>
                            <div class="flex items-center justify-between text-[10px] text-slate-400 mt-0.5">
                                <span class="truncate">{{ $cImg->review?->reviewer_name }}</span>
                                <span class="text-amber-500 font-bold font-mono">★ {{ $cImg->review?->rating }}</span>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full content-card p-12 text-center text-slate-400">
                        <p class="text-sm">No customer photos have been uploaded yet.</p>
                    </div>
                @endforelse
            </div>

            <!-- Imagery Pagination -->
            @if($customerImages->hasPages())
                <div class="pt-4">
                    {{ $customerImages->links() }}
                </div>
            @endif

        </div>

        <!-- ========================================================
             FULLSCREEN ATELIER ZOOM LIGHTBOX MODAL
             ======================================================== -->
        <div x-show="zoomModal" 
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-md"
             style="display: none;"
             @keydown.escape.window="zoomModal = false">
            
            <div class="relative w-full max-w-3xl bg-white dark:bg-[#141C2B] rounded-2xl shadow-2xl border border-slate-200 dark:border-white/10 overflow-hidden" 
                 @click.away="zoomModal = false">
                
                <!-- Modal Header -->
                <div class="p-4 sm:p-5 border-b border-slate-100 dark:border-white/10 flex items-center justify-between">
                    <div>
                        <h4 class="font-serif font-bold text-sm sm:text-base text-slate-900 dark:text-white" x-text="activeProduct"></h4>
                        <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                            <span>Uploaded by <strong class="text-slate-700 dark:text-slate-200" x-text="activePatron"></strong></span>
                            <span>&bull;</span>
                            <span class="text-amber-500 font-bold" x-text="activeRating + ' Stars ★'"></span>
                        </div>
                    </div>
                    <button type="button" 
                            @click="zoomModal = false"
                            class="p-2 text-slate-400 hover:text-slate-700 dark:hover:text-white rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Main Full Resolution Image -->
                <div class="p-4 bg-slate-950 flex items-center justify-center max-h-[60vh]">
                    <img :src="activeImage" 
                         alt="Customer unboxing or wear photo" 
                         class="max-w-full max-h-[55vh] object-contain rounded-lg">
                </div>

                <!-- Modal Footer with Commentary and Delete Option -->
                <div class="p-4 sm:p-5 border-t border-slate-100 dark:border-white/10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <p class="text-xs text-slate-600 dark:text-slate-300 italic font-serif flex-1 line-clamp-2" x-text="'“' + activeComment + '”'"></p>
                    
                    <div class="flex items-center gap-3 flex-shrink-0 ml-auto">
                        <button type="button" 
                                @click="zoomModal = false"
                                class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 transition-colors cursor-pointer">
                            Close
                        </button>
                        
                        <template x-if="activeImageId">
                            <form :action="'{{ url('admin/reviews/images') }}/' + activeImageId" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Delete this specific customer photo permanently?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-4 py-2 rounded-xl text-xs font-bold bg-rose-600 hover:bg-rose-700 text-white transition-colors cursor-pointer flex items-center gap-1.5 shadow-xs">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    <span>Delete Photo</span>
                                </button>
                            </form>
                        </template>
                    </div>
                </div>

            </div>
        </div>

    </div>

</x-layouts.admin>