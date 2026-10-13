<x-layouts.admin title="Banner & Promotion Management | Modern Jewellery House">
    <div x-data="{
        editModalOpen: false,
        imageModalOpen: false,
        imageModalUrl: '',
        imageModalTitle: '',
        createDesktopPreview: null,
        createMobilePreview: null,
        editDesktopPreview: null,
        editMobilePreview: null,
        selectedPlacement: 'home_hero',
        editingBanner: {
            id: null,
            title: '',
            subtitle: '',
            tagline: '',
            cta_text: '',
            cta_link: '',
            placement: 'home_hero',
            sort_order: 0,
            is_active: true,
            desktop_url: '',
            mobile_url: '',
            desktop_path: '',
            mobile_path: ''
        },
        activeFilter: 'all',
        previewTitle: 'UP TO 100% OFF IN MAKING CHARGES',
        previewSubtitle: 'On 3,000+ Certified Designs • Limited Period Offer',
        previewTagline: 'EXCLUSIVE ATELIER OFFER',
        previewCtaText: 'CLAIM OFFER',
        previewCtaLink: '/shop?offer=making-charges',
        openEdit(banner) {
            this.editDesktopPreview = null;
            this.editMobilePreview = null;
            this.editingBanner = {
                id: banner.id,
                title: banner.title || '',
                subtitle: banner.subtitle || '',
                tagline: banner.tagline || '',
                cta_text: banner.cta_text || '',
                cta_link: banner.cta_link || '',
                placement: banner.placement || 'home_hero',
                sort_order: banner.sort_order || 0,
                is_active: Boolean(banner.is_active),
                desktop_url: banner.desktop_image_url || '',
                mobile_url: banner.mobile_image_url || '',
                desktop_path: banner.image_desktop || '',
                mobile_path: banner.image_mobile || ''
            };
            this.editModalOpen = true;
        },
        openImageZoom(url, title) {
            this.imageModalUrl = url;
            this.imageModalTitle = title;
            this.imageModalOpen = true;
        }
    }" class="space-y-6">

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-4 border-b border-slate-200 dark:border-white/10 gap-3">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight flex items-center gap-2 flex-wrap">
                    <span>Homepage Banner &amp; Promotion Management</span>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 dark:bg-amber-950/40 text-amber-800 dark:text-amber-300 border border-amber-200 dark:border-amber-500/30">
                        Live Storefront Sync
                    </span>
                </h1>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    Upload, replace, and configure banners across all Homepage placement corridors (Flipkart Carousel, 3-Card Offer Grid, Announcements &amp; Features).
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('home') }}#hero-banner" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-[#0a2240] hover:bg-[#12396e] dark:bg-amber-500 dark:hover:bg-amber-600 text-amber-300 dark:text-slate-950 text-xs font-bold rounded-xl transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>View Live Storefront</span>
                </a>
            </div>
        </div>

        <!-- Corridor Filter Tabs -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs">
            <button @click="activeFilter = 'all'" 
                    :class="activeFilter === 'all' ? 'bg-[#0a2240] dark:bg-amber-500 text-white dark:text-slate-950 shadow-sm' : 'bg-white dark:bg-[#141C2B] text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200 dark:border-white/10'"
                    class="px-3.5 py-2 rounded-xl font-bold transition-all cursor-pointer">
                All Corridors ({{ $banners->count() }})
            </button>
            <button @click="activeFilter = 'home_hero'" 
                    :class="activeFilter === 'home_hero' ? 'bg-[#0a2240] dark:bg-amber-500 text-white dark:text-slate-950 shadow-sm' : 'bg-white dark:bg-[#141C2B] text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200 dark:border-white/10'"
                    class="px-3.5 py-2 rounded-xl font-bold transition-all flex items-center gap-1.5 cursor-pointer">
                <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                Flipkart Hero Slider ({{ $banners->where('placement', 'home_hero')->count() }})
            </button>
            <button @click="activeFilter = 'promo'" 
                    :class="activeFilter === 'promo' ? 'bg-[#0a2240] dark:bg-amber-500 text-white dark:text-slate-950 shadow-sm' : 'bg-white dark:bg-[#141C2B] text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200 dark:border-white/10'"
                    class="px-3.5 py-2 rounded-xl font-bold transition-all flex items-center gap-1.5 cursor-pointer">
                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                Offer 3-Card Grid ({{ $banners->where('placement', 'promo')->count() }})
            </button>
            <button @click="activeFilter = 'collection_feature'" 
                    :class="activeFilter === 'collection_feature' ? 'bg-[#0a2240] dark:bg-amber-500 text-white dark:text-slate-950 shadow-sm' : 'bg-white dark:bg-[#141C2B] text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200 dark:border-white/10'"
                    class="px-3.5 py-2 rounded-xl font-bold transition-all flex items-center gap-1.5 cursor-pointer">
                <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                Editorial Features ({{ $banners->where('placement', 'collection_feature')->count() }})
            </button>
            <button @click="activeFilter = 'announcement'" 
                    :class="activeFilter === 'announcement' ? 'bg-[#0a2240] dark:bg-amber-500 text-white dark:text-slate-950 shadow-sm' : 'bg-white dark:bg-[#141C2B] text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200 dark:border-white/10'"
                    class="px-3.5 py-2 rounded-xl font-bold transition-all flex items-center gap-1.5 cursor-pointer">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                Top Announcements ({{ $banners->where('placement', 'announcement')->count() }})
            </button>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 items-start">
            
            <!-- Left: Create & Upload Banner Form -->
            <div class="content-card bg-white dark:bg-[#141C2B] p-5 rounded-2xl border border-slate-200 dark:border-white/10 shadow-sm space-y-4 text-xs transition-colors">
                <div class="flex items-center justify-between border-b border-slate-100 dark:border-white/10 pb-3">
                    <h3 class="font-bold text-slate-900 dark:text-white uppercase tracking-wider flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Add / Publish New Banner</span>
                    </h3>
                    <span class="text-[10px] bg-amber-50 dark:bg-amber-950/40 text-amber-800 dark:text-amber-300 border border-amber-200 dark:border-amber-500/30 px-2 py-0.5 rounded font-mono font-bold">New Asset</span>
                </div>

                <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Placement Corridor *</label>
                        <select name="placement" 
                                x-model="selectedPlacement" 
                                required 
                                class="w-full bg-slate-50 dark:bg-[#0B0F19] text-slate-900 dark:text-white border border-slate-300 dark:border-white/10 rounded-xl px-3 py-2.5 text-xs focus:ring-2 focus:ring-[#D4AF37] focus:outline-none transition-colors">
                            <option value="home_hero">★ Main Top Hero Slider (Flipkart Carousel at Top)</option>
                            <option value="promo">★ Promotional Offer Cards (3-Card Offer Grid)</option>
                            <option value="collection_feature">◈ Editorial Campaign Feature (Handpicked Collections)</option>
                            <option value="announcement">📢 Top Header Announcement Bar (Top Ribbon)</option>
                        </select>
                        <div class="mt-1.5 p-2 rounded-lg bg-slate-100/70 dark:bg-slate-900/50 border border-slate-200/60 dark:border-white/5 text-[11px] text-slate-500 dark:text-slate-400">
                            <template x-if="selectedPlacement === 'home_hero'">
                                <span>Controls the large auto-sliding Flipkart banner at the very top of the homepage.</span>
                            </template>
                            <template x-if="selectedPlacement === 'promo'">
                                <span>Controls the 3 promotional offer cards (Slot 1: Left, Slot 2: Middle, Slot 3: Right). Set Sort Order to 1, 2, or 3.</span>
                            </template>
                            <template x-if="selectedPlacement === 'collection_feature'">
                                <span>Controls campaign features and handpicked collections on the homepage.</span>
                            </template>
                            <template x-if="selectedPlacement === 'announcement'">
                                <span>Controls the announcement banner shown at the top of the header across all pages.</span>
                            </template>
                        </div>
                    </div>

                    <!-- IMAGE UPLOAD FIELDS WITH LIVE PREVIEW -->
                    <div class="p-3.5 bg-amber-50/50 dark:bg-amber-950/20 rounded-xl border border-amber-200/60 dark:border-amber-500/20 space-y-3">
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <label class="block font-bold text-slate-800 dark:text-amber-200">Desktop Banner Image (Upload File)</label>
                                <span class="text-[9px] text-amber-800 dark:text-amber-300 font-medium">JPG, PNG, WEBP</span>
                            </div>
                            <div class="border-2 border-dashed border-amber-300 dark:border-amber-500/40 hover:border-amber-500 dark:hover:border-amber-400 rounded-xl p-3 bg-white dark:bg-[#0B0F19] transition-colors">
                                <input type="file" 
                                       name="image_desktop" 
                                       accept="image/*"
                                       @change="if ($event.target.files[0]) createDesktopPreview = URL.createObjectURL($event.target.files[0])"
                                       class="w-full text-xs text-slate-600 dark:text-slate-300 file:mr-2.5 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-[#0a2240] dark:file:bg-amber-500 file:text-white dark:file:text-slate-950 hover:file:bg-[#08182b] dark:hover:file:bg-amber-400 cursor-pointer">
                                <p class="text-[10px] text-slate-500 dark:text-slate-400 mt-2 flex items-center gap-1">
                                    <span>📸</span>
                                    <span>Recommended: Hero ~ 1920x600 (16:5), Offer Cards ~ 600x350 or 1:1.</span>
                                </p>
                            </div>

                            <div class="mt-2.5">
                                <label class="block font-semibold text-slate-600 dark:text-slate-400 text-[11px] mb-0.5">Or Image Asset Path / URL</label>
                                <input type="text" 
                                       name="image_desktop_url" 
                                       placeholder="assets/images/banner_making_charges.jpg" 
                                       class="w-full bg-white dark:bg-[#0B0F19] text-slate-900 dark:text-white border border-slate-300 dark:border-white/10 rounded-lg px-2.5 py-1.5 text-xs font-mono focus:ring-2 focus:ring-[#D4AF37] focus:outline-none">
                            </div>

                            <!-- Live file preview thumbnail -->
                            <template x-if="createDesktopPreview">
                                <div class="mt-2 relative rounded-xl overflow-hidden border border-amber-400 dark:border-amber-500/50 bg-slate-950 h-32 flex items-center justify-center shadow-inner">
                                    <img :src="createDesktopPreview" alt="Upload preview" class="w-full h-full object-contain">
                                    <span class="absolute bottom-1 right-1 bg-black/80 text-white text-[9px] px-2 py-0.5 rounded font-mono">Desktop Preview</span>
                                </div>
                            </template>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <label class="block font-bold text-slate-800 dark:text-amber-200">Mobile Banner Image (Optional)</label>
                                <span class="text-[9px] text-slate-500 dark:text-slate-400">Optimized for Phones</span>
                            </div>
                            <div class="border border-dashed border-slate-300 dark:border-white/15 rounded-xl p-2.5 bg-white dark:bg-[#0B0F19]">
                                <input type="file" 
                                       name="image_mobile" 
                                       accept="image/*"
                                       @change="if ($event.target.files[0]) createMobilePreview = URL.createObjectURL($event.target.files[0])"
                                       class="w-full text-xs text-slate-600 dark:text-slate-300 file:mr-2.5 file:py-1 file:px-2.5 file:rounded-md file:border-0 file:text-[11px] file:font-semibold file:bg-slate-700 dark:file:bg-slate-800 file:text-white hover:file:bg-slate-800 cursor-pointer">
                            </div>

                            <div class="mt-2">
                                <label class="block font-semibold text-slate-600 dark:text-slate-400 text-[11px] mb-0.5">Or Mobile Image Asset Path / URL</label>
                                <input type="text" 
                                       name="image_mobile_url" 
                                       placeholder="assets/images/banner_mobile.jpg" 
                                       class="w-full bg-white dark:bg-[#0B0F19] text-slate-900 dark:text-white border border-slate-300 dark:border-white/10 rounded-lg px-2.5 py-1.5 text-xs font-mono focus:ring-2 focus:ring-[#D4AF37] focus:outline-none">
                            </div>

                            <template x-if="createMobilePreview">
                                <div class="mt-2 relative rounded-xl overflow-hidden border border-slate-300 dark:border-white/10 bg-slate-950 h-28 flex items-center justify-center shadow-inner">
                                    <img :src="createMobilePreview" alt="Mobile preview" class="w-full h-full object-contain">
                                    <span class="absolute bottom-1 right-1 bg-black/80 text-white text-[9px] px-2 py-0.5 rounded font-mono">Mobile Preview</span>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Banner Title *</label>
                        <input type="text" name="title" required x-model="previewTitle" placeholder="e.g. UP TO 100% OFF IN MAKING CHARGES" class="w-full bg-slate-50 dark:bg-[#0B0F19] text-slate-900 dark:text-white border border-slate-300 dark:border-white/10 rounded-xl px-3 py-2 text-xs focus:ring-2 focus:ring-[#D4AF37] focus:outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Tagline / Badge</label>
                            <input type="text" name="tagline" x-model="previewTagline" placeholder="e.g. FESTIVE PRIVILEGE" class="w-full bg-slate-50 dark:bg-[#0B0F19] text-slate-900 dark:text-white border border-slate-300 dark:border-white/10 rounded-xl px-3 py-2 text-xs focus:ring-2 focus:ring-[#D4AF37] focus:outline-none">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Sort Order / Slot #</label>
                            <input type="number" name="sort_order" value="1" min="0" class="w-full bg-slate-50 dark:bg-[#0B0F19] text-slate-900 dark:text-white border border-slate-300 dark:border-white/10 rounded-xl px-3 py-2 text-xs focus:ring-2 focus:ring-[#D4AF37] focus:outline-none font-mono">
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Subtitle / Offer Details</label>
                        <input type="text" name="subtitle" x-model="previewSubtitle" placeholder="e.g. On 3000+ Certified Designs • Limited Period" class="w-full bg-slate-50 dark:bg-[#0B0F19] text-slate-900 dark:text-white border border-slate-300 dark:border-white/10 rounded-xl px-3 py-2 text-xs focus:ring-2 focus:ring-[#D4AF37] focus:outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">CTA Button Text</label>
                            <input type="text" name="cta_text" x-model="previewCtaText" placeholder="e.g. CLAIM OFFER" class="w-full bg-slate-50 dark:bg-[#0B0F19] text-slate-900 dark:text-white border border-slate-300 dark:border-white/10 rounded-xl px-3 py-2 text-xs font-bold uppercase focus:ring-2 focus:ring-[#D4AF37] focus:outline-none">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Destination URL</label>
                            <input type="text" name="cta_link" x-model="previewCtaLink" placeholder="/shop?offer=making-charges" class="w-full bg-slate-50 dark:bg-[#0B0F19] text-slate-900 dark:text-white border border-slate-300 dark:border-white/10 rounded-xl px-3 py-2 text-xs font-mono focus:ring-2 focus:ring-[#D4AF37] focus:outline-none">
                        </div>
                    </div>

                    <div class="flex items-center gap-2 pt-1">
                        <input type="checkbox" name="is_active" id="create_is_active" value="1" checked class="w-4 h-4 rounded text-amber-500 focus:ring-[#D4AF37] border-slate-300 dark:border-white/20 bg-slate-100 dark:bg-slate-800">
                        <label for="create_is_active" class="font-semibold text-slate-700 dark:text-slate-300 cursor-pointer">Publish immediately (Active on storefront)</label>
                    </div>

                    <button type="submit" class="w-full py-2.5 bg-[#0a2240] hover:bg-[#12396e] dark:bg-amber-500 dark:hover:bg-amber-600 text-amber-300 dark:text-slate-950 rounded-xl font-bold uppercase tracking-wider text-xs transition-all shadow-md flex items-center justify-center gap-2 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        <span>Publish Banner</span>
                    </button>
                </form>
            </div>

            <!-- Right: Banners Management Table with Large Image Thumbnails -->
            <div class="xl:col-span-2 content-card bg-white dark:bg-[#141C2B] rounded-2xl border border-slate-200 dark:border-white/10 shadow-sm overflow-hidden transition-colors">
                <div class="px-5 py-4 border-b border-slate-100 dark:border-white/10 flex items-center justify-between flex-wrap gap-2">
                    <div>
                        <h3 class="font-bold text-slate-900 dark:text-white text-sm">Active Homepage Banners &amp; Offer Promotions</h3>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400">All banners below sync instantly with the live storefront. Click thumbnails to inspect full resolution.</p>
                    </div>
                    <span class="text-xs font-mono font-bold bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 px-3 py-1 rounded-full border border-slate-200 dark:border-white/10">
                        Total: {{ $banners->count() }}
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 dark:bg-[#0B0F19]/60 text-slate-500 dark:text-slate-400 uppercase tracking-wider font-semibold border-b border-slate-200 dark:border-white/10">
                            <tr>
                                <th class="py-3 px-4">Banner Media Preview</th>
                                <th class="py-3 px-4">Title &amp; Destination</th>
                                <th class="py-3 px-4">Placement Corridor</th>
                                <th class="py-3 px-4 text-center">Slot / Order</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-white/5 font-medium">
                            @forelse($banners as $ban)
                                <tr class="hover:bg-slate-50/70 dark:hover:bg-white/[0.03] transition-colors"
                                    x-show="activeFilter === 'all' || activeFilter === '{{ $ban->placement }}'">
                                    
                                    <!-- Banner Image Thumbnail with Zoom Feature -->
                                    <td class="py-3.5 px-4">
                                        <div class="relative group cursor-pointer w-28 h-16 rounded-lg bg-slate-950 overflow-hidden border border-slate-200 dark:border-white/10 shadow-2xs"
                                             @click="openImageZoom('{{ $ban->desktop_image_url }}', '{{ addslashes($ban->title) }}')">
                                            @if($ban->desktop_image_url)
                                                <img src="{{ $ban->desktop_image_url }}" alt="{{ $ban->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold gap-1">
                                                    <span>🔍 Zoom</span>
                                                </div>
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-amber-300 text-xs font-bold">
                                                    No Image
                                                </div>
                                            @endif
                                        </div>
                                        @if($ban->mobile_image_url && $ban->mobile_image_url !== $ban->desktop_image_url)
                                            <span class="inline-block mt-1 text-[9px] text-blue-600 dark:text-blue-400 font-semibold cursor-pointer hover:underline"
                                                  @click="openImageZoom('{{ $ban->mobile_image_url }}', '{{ addslashes($ban->title) }} (Mobile)')">
                                                + Mobile Image
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Banner Copy Details -->
                                    <td class="py-3.5 px-4">
                                        <div class="min-w-0 max-w-xs space-y-0.5">
                                            @if($ban->tagline)
                                                <span class="inline-block text-[9px] font-bold text-amber-600 dark:text-amber-400 uppercase tracking-wider">
                                                    ✦ {{ $ban->tagline }}
                                                </span>
                                            @endif
                                            <span class="font-bold text-slate-900 dark:text-white block truncate text-xs">{{ $ban->title }}</span>
                                            @if($ban->subtitle)
                                                <span class="text-[10px] text-slate-400 block truncate">{{ $ban->subtitle }}</span>
                                            @endif
                                            @if($ban->cta_link)
                                                <span class="text-[9px] font-mono text-blue-600 dark:text-blue-400 inline-block bg-blue-50 dark:bg-blue-950/40 border border-blue-200/50 dark:border-blue-500/20 px-1.5 py-0.5 rounded truncate max-w-[200px]">
                                                    {{ $ban->cta_text ? $ban->cta_text . ' → ' : '' }}{{ $ban->cta_link }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Placement Corridor Badges -->
                                    <td class="py-3.5 px-4">
                                        @if($ban->placement === 'home_hero')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 dark:bg-amber-950/40 text-amber-900 dark:text-amber-300 border border-amber-200 dark:border-amber-500/30 whitespace-nowrap">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                Top Hero Slider
                                            </span>
                                        @elseif($ban->placement === 'promo')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-50 dark:bg-blue-950/40 text-blue-800 dark:text-blue-300 border border-blue-200 dark:border-blue-500/30 whitespace-nowrap">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                                Offer Card (Slot #{{ $ban->sort_order ?: 1 }})
                                            </span>
                                        @elseif($ban->placement === 'collection_feature')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-purple-50 dark:bg-purple-950/40 text-purple-800 dark:text-purple-300 border border-purple-200 dark:border-purple-500/30 whitespace-nowrap">
                                                <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                                                Editorial Feature
                                            </span>
                                        @elseif($ban->placement === 'announcement')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-500/30 whitespace-nowrap">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Top Announcement
                                            </span>
                                        @else
                                            <span class="text-[10px] font-mono text-slate-500 dark:text-slate-400 uppercase">{{ $ban->placement }}</span>
                                        @endif
                                    </td>

                                    <!-- Sort Order -->
                                    <td class="py-3.5 px-4 font-mono text-center">
                                        <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10 rounded text-xs font-bold">
                                            {{ $ban->sort_order }}
                                        </span>
                                    </td>

                                    <!-- Status with Quick Toggle -->
                                    <td class="py-3.5 px-4">
                                        <form action="{{ route('admin.banners.toggle-active', $ban) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    title="Click to toggle status"
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase transition-all cursor-pointer {{ $ban->is_active ? 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/30 hover:bg-emerald-100 dark:hover:bg-emerald-900/40' : 'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 border border-slate-200 dark:border-white/10 hover:bg-slate-200 dark:hover:bg-slate-700' }}">
                                                <span class="w-1.5 h-1.5 rounded-full {{ $ban->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                                <span>{{ $ban->is_active ? 'Active' : 'Hidden' }}</span>
                                            </button>
                                        </form>
                                    </td>

                                    <!-- Action Buttons -->
                                    <td class="py-3.5 px-4 text-right">
                                        <div class="inline-flex items-center gap-1.5">
                                            <!-- Edit Button -->
                                            <button type="button" 
                                                    @click="openEdit({{ json_encode($ban) }})"
                                                    class="px-2.5 py-1 rounded-lg text-[11px] font-bold bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10 transition-colors cursor-pointer">
                                                Edit
                                            </button>

                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.banners.destroy', $ban) }}" method="POST" class="inline" onsubmit="return confirm('Permanently remove banner \'{{ addslashes($ban->title) }}\'?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2.5 py-1 rounded-lg text-[11px] font-bold bg-red-50 dark:bg-red-950/30 hover:bg-red-100 dark:hover:bg-red-900/50 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-500/20 transition-colors cursor-pointer">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center text-slate-400 dark:text-slate-500">
                                        <p class="font-medium">No banners found in this placement corridor.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Edit Banner Modal with Live Image Replacement Preview -->
        <div x-show="editModalOpen" 
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/70 backdrop-blur-sm flex items-center justify-center p-4">
            
            <div @click.away="editModalOpen = false" 
                 class="content-card bg-white dark:bg-[#141C2B] rounded-2xl shadow-2xl border border-slate-200 dark:border-white/10 max-w-lg w-full p-6 space-y-4 text-xs transition-colors">
                
                <div class="flex items-center justify-between border-b border-slate-100 dark:border-white/10 pb-3">
                    <div>
                        <h3 class="font-bold text-slate-900 dark:text-white text-sm">Edit Banner &amp; Replace Image</h3>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400">Update copy, placement corridor, destination URL, or upload replacement images.</p>
                    </div>
                    <button @click="editModalOpen = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-white text-xl cursor-pointer font-bold">&times;</button>
                </div>

                <form :action="'{{ url('admin/banners') }}/' + editingBanner.id" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Current Image Display -->
                    <div class="p-3.5 bg-slate-50 dark:bg-[#0B0F19] rounded-xl border border-slate-200 dark:border-white/10 space-y-2">
                        <label class="block font-bold text-slate-800 dark:text-white">Desktop Image Preview</label>
                        <div class="h-28 rounded-lg overflow-hidden bg-slate-950 flex items-center justify-center border border-slate-300 dark:border-white/10">
                            <template x-if="editDesktopPreview">
                                <img :src="editDesktopPreview" class="w-full h-full object-contain">
                            </template>
                            <template x-if="!editDesktopPreview && editingBanner.desktop_url">
                                <img :src="editingBanner.desktop_url" class="w-full h-full object-contain">
                            </template>
                        </div>
                        
                        <div class="pt-2">
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Upload Replacement File</label>
                            <input type="file" 
                                   name="image_desktop" 
                                   accept="image/*"
                                   @change="if ($event.target.files[0]) editDesktopPreview = URL.createObjectURL($event.target.files[0])"
                                   class="w-full text-xs text-slate-600 dark:text-slate-300 file:mr-2 file:py-1 file:px-2.5 file:rounded file:border-0 file:bg-[#0a2240] dark:file:bg-amber-500 file:text-white dark:file:text-slate-950">
                        </div>

                        <div class="pt-1">
                            <label class="block font-semibold text-slate-600 dark:text-slate-400 text-[11px] mb-0.5">Or Replace With Image URL / Asset Path</label>
                            <input type="text" 
                                   name="image_desktop_url" 
                                   :value="editingBanner.desktop_path"
                                   placeholder="assets/images/banner_making_charges.jpg" 
                                   class="w-full bg-white dark:bg-[#141C2B] text-slate-900 dark:text-white border border-slate-300 dark:border-white/10 rounded-lg px-2.5 py-1.5 text-xs font-mono">
                        </div>
                    </div>

                    <!-- Mobile Image Replacement -->
                    <div class="p-3.5 bg-slate-50 dark:bg-[#0B0F19] rounded-xl border border-slate-200 dark:border-white/10 space-y-2">
                        <label class="block font-bold text-slate-800 dark:text-white">Mobile Image Media (Optional)</label>
                        <div class="pt-1">
                            <input type="file" 
                                   name="image_mobile" 
                                   accept="image/*"
                                   @change="if ($event.target.files[0]) editMobilePreview = URL.createObjectURL($event.target.files[0])"
                                   class="w-full text-xs text-slate-600 dark:text-slate-300 file:mr-2 file:py-1 file:px-2.5 file:rounded file:border-0 file:bg-slate-700 file:text-white">
                        </div>
                        <div class="pt-1">
                            <input type="text" 
                                   name="image_mobile_url" 
                                   :value="editingBanner.mobile_path"
                                   placeholder="assets/images/banner_mobile.jpg" 
                                   class="w-full bg-white dark:bg-[#141C2B] text-slate-900 dark:text-white border border-slate-300 dark:border-white/10 rounded-lg px-2.5 py-1.5 text-xs font-mono">
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Placement Corridor *</label>
                        <select name="placement" x-model="editingBanner.placement" required class="w-full bg-slate-50 dark:bg-[#0B0F19] text-slate-900 dark:text-white border border-slate-300 dark:border-white/10 rounded-xl px-3 py-2 text-xs focus:ring-2 focus:ring-[#D4AF37] focus:outline-none">
                            <option value="home_hero">★ Main Top Hero Slider (Flipkart Carousel at Top)</option>
                            <option value="promo">★ Promotional Offer Cards (3-Card Offer Grid)</option>
                            <option value="collection_feature">◈ Editorial Campaign Feature (Handpicked Collections)</option>
                            <option value="announcement">📢 Top Header Announcement Bar (Top Ribbon)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Banner Title *</label>
                        <input type="text" name="title" x-model="editingBanner.title" required class="w-full bg-slate-50 dark:bg-[#0B0F19] text-slate-900 dark:text-white border border-slate-300 dark:border-white/10 rounded-xl px-3 py-2 text-xs focus:ring-2 focus:ring-[#D4AF37] focus:outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Tagline / Badge</label>
                            <input type="text" name="tagline" x-model="editingBanner.tagline" class="w-full bg-slate-50 dark:bg-[#0B0F19] text-slate-900 dark:text-white border border-slate-300 dark:border-white/10 rounded-xl px-3 py-2 text-xs focus:ring-2 focus:ring-[#D4AF37] focus:outline-none">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Sort Order / Slot #</label>
                            <input type="number" name="sort_order" x-model="editingBanner.sort_order" class="w-full bg-slate-50 dark:bg-[#0B0F19] text-slate-900 dark:text-white border border-slate-300 dark:border-white/10 rounded-xl px-3 py-2 text-xs font-mono focus:ring-2 focus:ring-[#D4AF37] focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Subtitle / Offer Details</label>
                        <input type="text" name="subtitle" x-model="editingBanner.subtitle" class="w-full bg-slate-50 dark:bg-[#0B0F19] text-slate-900 dark:text-white border border-slate-300 dark:border-white/10 rounded-xl px-3 py-2 text-xs focus:ring-2 focus:ring-[#D4AF37] focus:outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">CTA Button Text</label>
                            <input type="text" name="cta_text" x-model="editingBanner.cta_text" class="w-full bg-slate-50 dark:bg-[#0B0F19] text-slate-900 dark:text-white border border-slate-300 dark:border-white/10 rounded-xl px-3 py-2 text-xs font-bold uppercase focus:ring-2 focus:ring-[#D4AF37] focus:outline-none">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Destination URL</label>
                            <input type="text" name="cta_link" x-model="editingBanner.cta_link" class="w-full bg-slate-50 dark:bg-[#0B0F19] text-slate-900 dark:text-white border border-slate-300 dark:border-white/10 rounded-xl px-3 py-2 text-xs font-mono focus:ring-2 focus:ring-[#D4AF37] focus:outline-none">
                        </div>
                    </div>

                    <div class="flex items-center gap-2 pt-1">
                        <input type="checkbox" name="is_active" id="edit_is_active" value="1" :checked="editingBanner.is_active" class="w-4 h-4 rounded text-amber-500 focus:ring-[#D4AF37] border-slate-300 dark:border-white/20 bg-slate-100 dark:bg-slate-800">
                        <label for="edit_is_active" class="font-semibold text-slate-700 dark:text-slate-300 cursor-pointer">Active and visible on storefront</label>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100 dark:border-white/10">
                        <button type="button" @click="editModalOpen = false" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-xl font-bold cursor-pointer transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="px-5 py-2 bg-[#0a2240] hover:bg-[#12396e] dark:bg-amber-500 dark:hover:bg-amber-600 text-amber-300 dark:text-slate-950 rounded-xl font-bold uppercase tracking-wider cursor-pointer shadow-md transition-all">
                            Save Changes
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <!-- Fullscreen Image Zoom Lightbox Modal -->
        <div x-show="imageModalOpen" 
             x-cloak
             x-transition
             class="fixed inset-0 z-50 bg-black/85 backdrop-blur-md flex items-center justify-center p-4">
            <div @click.away="imageModalOpen = false" class="max-w-4xl w-full bg-[#141C2B] rounded-2xl overflow-hidden shadow-2xl border border-white/20 p-4 space-y-3">
                <div class="flex items-center justify-between text-white border-b border-white/10 pb-2">
                    <span class="font-bold text-sm" x-text="imageModalTitle"></span>
                    <button @click="imageModalOpen = false" class="text-white hover:text-amber-300 text-xl font-bold cursor-pointer">&times;</button>
                </div>
                <div class="max-h-[75vh] flex items-center justify-center overflow-auto p-2 bg-black/40 rounded-xl">
                    <img :src="imageModalUrl" class="max-w-full max-h-[70vh] object-contain rounded-lg shadow-lg">
                </div>
            </div>
        </div>

    </div>
</x-layouts.admin>