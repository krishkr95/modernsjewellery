<x-layouts.admin title="Create New Product | Modern Jewellery House">

    <div class="flex items-center justify-between pb-2 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Create Fine Jewellery Piece</h1>
            <p class="text-xs text-slate-500 mt-1">Add a new creation to the Maison catalog with specifications and 3D visualization.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900">
            &larr; Back to Catalogue
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- LEFT COLUMN (2 Cols) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Core Details Card -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wide border-b border-slate-100 pb-2">Piece Identification</h3>
                    
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Product Title *</label>
                        <input type="text" name="name" required value="{{ old('name') }}" placeholder="e.g. Aurelia Solitaire Diamond Ring" 
                               class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3.5 py-2.5 text-xs text-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">SKU (Master Stock Code) *</label>
                            <input type="text" name="sku" required value="{{ old('sku') }}" placeholder="e.g. MJH-RNG-009" 
                                   class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3.5 py-2.5 text-xs font-mono text-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Badge</label>
                            <input type="text" name="badge" value="{{ old('badge') }}" placeholder="e.g. NEW, BESTSELLER, LIMITED" 
                                   class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3.5 py-2.5 text-xs uppercase tracking-wider text-slate-900 focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Tagline</label>
                        <input type="text" name="tagline" value="{{ old('tagline') }}" placeholder="e.g. Hand-set cushion solitaire in recycled platinum" 
                               class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3.5 py-2.5 text-xs text-slate-900 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Short Description</label>
                        <textarea name="short_description" rows="2" placeholder="Brief editorial excerpt..." 
                                  class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3.5 py-2.5 text-xs text-slate-900 focus:outline-none">{{ old('short_description') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Comprehensive Description</label>
                        <textarea name="description" rows="5" placeholder="Detailed provenance, craftsmanship, and hallmark notes..." 
                                  class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3.5 py-2.5 text-xs text-slate-900 focus:outline-none">{{ old('description') }}</textarea>
                    </div>
                </div>

                <!-- Precious Metals & Gemstone Specifications -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wide border-b border-slate-100 pb-2">Haute Lapidary & Material Specs</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Metal Type</label>
                            <input type="text" name="metal_type" value="{{ old('metal_type', '18K Yellow Gold') }}" placeholder="18K Yellow Gold" 
                                   class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3 py-2 text-xs text-slate-900">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Purity</label>
                            <input type="text" name="purity" value="{{ old('purity', '750 Hallmarked') }}" placeholder="750 / 18K" 
                                   class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3 py-2 text-xs text-slate-900">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Approx Weight</label>
                            <input type="text" name="weight" value="{{ old('weight') }}" placeholder="e.g. 4.85 g" 
                                   class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3 py-2 text-xs text-slate-900">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Primary Gemstone</label>
                            <input type="text" name="gemstone_type" value="{{ old('gemstone_type', 'Natural Diamond') }}" placeholder="Natural Diamond" 
                                   class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3 py-2 text-xs text-slate-900">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Stone Description</label>
                            <input type="text" name="stone" value="{{ old('stone') }}" placeholder="e.g. 1.50ct VVS1 F-Color Cushion Cut" 
                                   class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3 py-2 text-xs text-slate-900">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Certification Agency</label>
                            <input type="text" name="certification" value="{{ old('certification', 'GIA Certified') }}" placeholder="GIA, IGI, SGL" 
                                   class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3 py-2 text-xs text-slate-900">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Certificate Dossier Number</label>
                            <input type="text" name="certificate_number" value="{{ old('certificate_number') }}" placeholder="e.g. GIA-219481928" 
                                   class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3 py-2 text-xs text-slate-900 font-mono">
                        </div>
                    </div>
                </div>

                <!-- Product Sizing & Ring Sizes Management -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4"
                     x-data="{
                        enabled: {{ old('enable_sizes', false) ? 'true' : 'false' }},
                        selectedSizes: {{ json_encode(old('available_sizes', [])) }},
                        customSizeInput: '',
                        standardSizes: ['6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24'],
                        toggleSize(size) {
                            size = String(size).trim();
                            if (this.selectedSizes.includes(size)) {
                                this.selectedSizes = this.selectedSizes.filter(s => s !== size);
                            } else {
                                this.selectedSizes.push(size);
                                this.selectedSizes.sort((a, b) => (!isNaN(a) && !isNaN(b)) ? Number(a) - Number(b) : a.localeCompare(b));
                            }
                        },
                        addCustomSize() {
                            let val = this.customSizeInput.trim();
                            if (val && !this.selectedSizes.includes(val)) {
                                this.selectedSizes.push(val);
                                this.selectedSizes.sort((a, b) => (!isNaN(a) && !isNaN(b)) ? Number(a) - Number(b) : a.localeCompare(b));
                            }
                            this.customSizeInput = '';
                        },
                        setPopular() {
                            this.enabled = true;
                            this.selectedSizes = ['10', '12', '14', '16', '18', '20'];
                        },
                        setAllStandard() {
                            this.enabled = true;
                            this.selectedSizes = [...this.standardSizes];
                        },
                        clearAll() {
                            this.selectedSizes = [];
                        }
                     }">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <div>
                            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wide flex items-center gap-2">
                                <span>💍 Product Sizing &amp; Ring Sizes</span>
                                <span class="text-[10px] font-normal normal-case px-2 py-0.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                                    Rings Only Feature
                                </span>
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">Enable and manage finger sizes for this piece. When disabled, size selection is hidden on the store.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="enable_sizes" value="1" x-model="enabled" class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-600"></div>
                            <span class="ml-2 text-xs font-semibold text-slate-700" x-text="enabled ? 'Sizes Active' : 'No Sizing'"></span>
                        </label>
                    </div>

                    <!-- Hidden inputs for array submission -->
                    <template x-for="s in selectedSizes" :key="s">
                        <input type="hidden" name="available_sizes[]" :value="s">
                    </template>

                    <div x-show="enabled" x-transition class="space-y-4 pt-2">
                        <!-- Quick Presets -->
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs font-semibold text-slate-500">Quick Presets:</span>
                            <button type="button" @click="setPopular()" class="px-2.5 py-1 text-xs font-medium rounded-md bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-200 transition-colors">
                                Popular (10, 12, 14, 16, 18, 20)
                            </button>
                            <button type="button" @click="setAllStandard()" class="px-2.5 py-1 text-xs font-medium rounded-md bg-slate-100 hover:bg-slate-200 text-slate-700 border border-slate-200 transition-colors">
                                All Standard (6 - 24)
                            </button>
                            <button type="button" @click="clearAll()" class="px-2.5 py-1 text-xs font-medium rounded-md bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 transition-colors">
                                Clear All
                            </button>
                        </div>

                        <!-- Standard Size Pills Grid -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Click to Select / Deselect Available Finger Sizes:</label>
                            <div class="grid grid-cols-6 sm:grid-cols-10 md:grid-cols-12 gap-1.5">
                                <template x-for="sz in standardSizes" :key="sz">
                                    <button type="button" 
                                            @click="toggleSize(sz)"
                                            :class="selectedSizes.includes(sz) 
                                                ? 'bg-amber-600 text-white font-bold border-amber-600 ring-2 ring-amber-500/30' 
                                                : 'bg-slate-50 text-slate-700 border-slate-200 hover:border-amber-400 hover:bg-amber-50/50'"
                                            class="py-2 text-center text-xs rounded-lg border transition-all duration-150">
                                        <span x-text="sz"></span>
                                    </button>
                                </template>
                            </div>
                        </div>

                        <!-- Custom Size Input & Currently Active Chips -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-slate-100">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Add Custom Size Option:</label>
                                <div class="flex gap-2">
                                    <input type="text" x-model="customSizeInput" @keydown.enter.prevent="addCustomSize()" placeholder="e.g. 14.5 or Free Size" 
                                           class="flex-1 bg-slate-50 border border-slate-300 rounded-lg px-3 py-1.5 text-xs text-slate-900 focus:outline-none focus:ring-1 focus:ring-amber-500">
                                    <button type="button" @click="addCustomSize()" class="px-3 py-1.5 bg-slate-900 text-white rounded-lg text-xs font-semibold hover:bg-slate-800">
                                        + Add
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">
                                    Currently Selected Sizes (<span x-text="selectedSizes.length"></span>):
                                </label>
                                <div class="flex flex-wrap gap-1.5 min-h-[34px] p-2 bg-slate-50 border border-slate-200 rounded-lg">
                                    <template x-if="selectedSizes.length === 0">
                                        <span class="text-xs text-slate-400 italic">No sizes selected. Click sizes above or choose a preset.</span>
                                    </template>
                                    <template x-for="s in selectedSizes" :key="s">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-amber-100 text-amber-900 text-xs font-semibold border border-amber-300">
                                            <span x-text="'Size ' + s"></span>
                                            <button type="button" @click="toggleSize(s)" class="text-amber-700 hover:text-rose-600 font-bold ml-0.5">&times;</button>
                                        </span>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3D & 360° INTERACTIVE STUDIO (Render My Jewelry & 3D Upload Control Center) -->
                <div id="rmj-360-admin-card"
                     class="content-card bg-white dark:bg-[#141C2B] p-6 rounded-2xl border-2 border-amber-500/30 dark:border-amber-500/20 shadow-md space-y-6 transition-colors" 
                     x-data="rmjAdminStudio({ 
                         enabled3d: {{ old('3d_model_enabled') ? 'true' : 'false' }},
                         modelUrl: @js(old('3d_model_url', '')),
                         autorotate: {{ old('3d_autorotate', true) ? 'true' : 'false' }},
                         speed: @js(old('3d_speed', 'slow')),
                         showColors: {{ old('3d_show_colors', true) ? 'true' : 'false' }},
                         defaultColor: @js(old('3d_default_color', 'yellow')),
                         bgColor: @js(old('3d_bg_color', '#0d0d0f')),
                         smoothness: @js(old('3d_smoothness', 'ultra'))
                     })">
                    
                    <!-- Header with Title, Badges & Master Toggle -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-slate-200 dark:border-white/10 gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 text-white flex items-center justify-center font-black text-sm shadow-md">
                                360°
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-slate-900 dark:text-white uppercase tracking-wide flex items-center gap-2">
                                    <span>Render My Jewelry &bull; 360° Studio Controls</span>
                                    <template x-if="isRmj">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/30">
                                            ✓ RMJ Engine Active
                                        </span>
                                    </template>
                                </h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400">
                                    Upload 360 product files or paste embed codes from <strong>rendermyjewelry.com</strong> for smooth 60fps jewelry showcase.
                                </p>
                            </div>
                        </div>

                        <!-- Master Enable Switch with Status Label -->
                        <div class="flex items-center gap-3 bg-slate-50 dark:bg-white/5 px-3 py-1.5 rounded-xl border border-slate-200 dark:border-white/10 self-start sm:self-auto">
                            <span class="text-xs font-semibold" :class="enabled3d ? 'text-amber-600 dark:text-amber-400 font-bold' : 'text-slate-400'">
                                <span x-text="enabled3d ? '360° Studio: Active' : '360° Studio: Disabled'"></span>
                            </span>
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="3d_model_enabled" value="1" x-model="enabled3d" class="sr-only">
                                <div class="w-11 h-6 bg-slate-200 dark:bg-slate-800 rounded-full transition-colors relative border border-slate-300 dark:border-white/10" :class="enabled3d ? 'bg-amber-500 dark:bg-amber-500' : ''">
                                    <div class="w-4 h-4 bg-white rounded-full absolute top-1 left-1 transition-transform shadow-xs" :class="enabled3d ? 'translate-x-5' : 'translate-x-0'"></div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Primary Upload & Paste Section (ALWAYS VISIBLE) -->
                    <div class="space-y-4">

                        <!-- Dual Input Cards (Paste Code OR File Upload) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            
                            <!-- 1. PASTE EMBED CODE OR URL -->
                            <div class="p-4 rounded-xl bg-slate-50/80 dark:bg-white/5 border border-slate-200 dark:border-white/10 space-y-2">
                                <div class="flex items-center justify-between">
                                    <label class="text-xs font-bold text-slate-900 dark:text-white flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                        <span>Option A: Paste 360° Embed Code / URL</span>
                                    </label>
                                    <span class="text-[10px] font-semibold text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-500/10 px-2 py-0.5 rounded-md">
                                        RenderMyJewelry.com
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">
                                    Paste your 360 link (e.g. <code class="text-[10px] text-amber-600">https://app.rendermyjewelry.com/preview/...</code>) or the full <code class="text-[10px]">&lt;iframe&gt;</code> code snippet:
                                </p>
                                <textarea name="3d_model_url" 
                                          x-model="modelUrl"
                                          @input="onInputCode()"
                                          rows="3"
                                          placeholder="Paste URL or <iframe> code from https://rendermyjewelry.com/ here..." 
                                          class="w-full bg-white dark:bg-[#0B0F19] border border-slate-300 dark:border-white/10 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 dark:text-white font-mono focus:ring-2 focus:ring-amber-500 focus:outline-none leading-relaxed"></textarea>
                                <input type="hidden" name="3d_model_provider" value="rendermyjewelry">
                            </div>

                            <!-- 2. DIRECT 3D MODEL FILE UPLOAD -->
                            <div class="p-4 rounded-xl bg-slate-50/80 dark:bg-white/5 border border-slate-200 dark:border-white/10 space-y-2">
                                <div class="flex items-center justify-between">
                                    <label class="text-xs font-bold text-slate-900 dark:text-white flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                        <span>Option B: Upload 360° / 3D Model File</span>
                                    </label>
                                    <span class="text-[10px] font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-500/10 px-2 py-0.5 rounded-md">
                                        .GLB / .GLTF
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400">
                                    Upload a standalone 3D binary file from your computer (supports up to 100MB):
                                </p>
                                
                                <div class="border-2 border-dashed border-slate-300 dark:border-white/20 rounded-xl p-3 bg-white dark:bg-[#0B0F19] text-center hover:border-amber-500 transition-colors">
                                    <input type="file" 
                                           id="3d_model_file_input_create"
                                           name="3d_model_file" 
                                           accept=".glb,.gltf,.obj,.usdz,.zip" 
                                           @change="onFileSelected($event)"
                                           class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-amber-500 file:text-white hover:file:bg-amber-600 cursor-pointer">
                                    <template x-if="fileName">
                                        <p class="text-[11px] text-emerald-600 dark:text-emerald-400 font-semibold mt-1">
                                            ✓ Selected: <span x-text="fileName"></span>
                                        </p>
                                    </template>
                                </div>
                            </div>

                        </div>

                        <!-- Active Source Indicator Pill -->
                        <div x-show="previewSrc" class="flex flex-wrap items-center justify-between gap-2 p-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs">
                            <div class="flex items-center gap-2 overflow-hidden">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span class="font-bold text-slate-800 dark:text-white">Active 360 Source:</span>
                                <span class="text-amber-800 dark:text-amber-300 font-mono truncate max-w-md" x-text="previewSrc"></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <button type="button" 
                                        @click="showPreview = !showPreview" 
                                        class="px-3 py-1 rounded-lg text-xs font-bold bg-amber-500 text-white hover:bg-amber-600 shadow-xs cursor-pointer">
                                    <span x-text="showPreview ? 'Hide 360 Preview' : '👁️ View Live 360 Preview'"></span>
                                </button>
                                <button type="button" 
                                        @click="modelUrl = ''; enabled3d = false; showPreview = false" 
                                        class="px-2 py-1 rounded-lg text-xs font-semibold text-rose-600 hover:bg-rose-50 cursor-pointer"
                                        title="Clear 360 model">
                                    Clear
                                </button>
                            </div>
                        </div>

                        <!-- Live Interactive 360 Preview Display -->
                        <div x-show="showPreview && previewSrc" x-transition class="rounded-xl overflow-hidden border-2 border-amber-500/40 bg-black aspect-video relative max-w-2xl mx-auto shadow-xl">
                            <iframe :src="previewSrc" 
                                    class="w-full h-full border-0 select-none" 
                                    allow="accelerometer; gyroscope; fullscreen; xr-spatial-tracking"
                                    title="Admin 360 Live Preview"></iframe>
                        </div>

                        <!-- Smoothness, Rotation & Atelier Display Parameters Grid -->
                        <div class="pt-2">
                            <div class="p-4 rounded-xl bg-slate-50/70 dark:bg-white/5 border border-slate-200/80 dark:border-white/5 space-y-4">
                                <h4 class="text-xs font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider flex items-center gap-2">
                                    <span>⚙️ 360° Studio Smoothness &amp; Presentation Controls</span>
                                </h4>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    
                                    <!-- Auto-Rotate & Speed -->
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">
                                                Auto-Rotation (Smooth Spin)
                                            </label>
                                            <input type="checkbox" name="3d_autorotate" value="1" x-model="autorotate" class="rounded text-amber-500 focus:ring-amber-400">
                                        </div>
                                        
                                        <div>
                                            <label class="block text-[11px] text-slate-500 dark:text-slate-400 mb-1">Rotation Speed</label>
                                            <select name="3d_speed" x-model="speed" :disabled="!autorotate" class="w-full bg-white dark:bg-[#0B0F19] border border-slate-300 dark:border-white/10 rounded-lg px-3 py-1.5 text-xs text-slate-800 dark:text-white focus:ring-2 focus:ring-[#D4AF37]">
                                                <option value="slow">Slow &amp; Ultra-Smooth (0.5 RPM Haute Joaillerie)</option>
                                                <option value="medium">Medium Fluid Motion (1.2 RPM)</option>
                                                <option value="fast">Fast Active Showcase (2.5 RPM)</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block text-[11px] text-slate-500 dark:text-slate-400 mb-1">Smoothness &amp; Frame Rate</label>
                                            <select name="3d_smoothness" x-model="smoothness" class="w-full bg-white dark:bg-[#0B0F19] border border-slate-300 dark:border-white/10 rounded-lg px-3 py-1.5 text-xs text-slate-800 dark:text-white focus:ring-2 focus:ring-[#D4AF37]">
                                                <option value="ultra">Ultra-Smooth 60fps (Recommended for High Jewellery)</option>
                                                <option value="adaptive">Dynamic Adaptive Motion (Balanced Performance)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Color Swatches & Stage Background -->
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">
                                                Show Live Metal Color Swatches
                                            </label>
                                            <input type="checkbox" name="3d_show_colors" value="1" x-model="showColors" class="rounded text-amber-500 focus:ring-amber-400">
                                        </div>

                                        <div>
                                            <label class="block text-[11px] text-slate-500 dark:text-slate-400 mb-1">Default Metal Finish</label>
                                            <select name="3d_default_color" x-model="defaultColor" class="w-full bg-white dark:bg-[#0B0F19] border border-slate-300 dark:border-white/10 rounded-lg px-3 py-1.5 text-xs text-slate-800 dark:text-white focus:ring-2 focus:ring-[#D4AF37]">
                                                <option value="yellow">18K Yellow Gold (Warm Atelier Radiance)</option>
                                                <option value="white">18K White Gold / Platinum (Lustrous Rhodium)</option>
                                                <option value="rose">18K Rose Gold (Warm Romantic Blush)</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block text-[11px] text-slate-500 dark:text-slate-400 mb-1">Stage Background Tone</label>
                                            <select name="3d_bg_color" x-model="bgColor" class="w-full bg-white dark:bg-[#0B0F19] border border-slate-300 dark:border-white/10 rounded-lg px-3 py-1.5 text-xs text-slate-800 dark:text-white focus:ring-2 focus:ring-[#D4AF37]">
                                                <option value="#0d0d0f">Dark Velvet Obsidian (#0d0d0f - Atelier Default)</option>
                                                <option value="#141416">Deep Charcoal Satin (#141416)</option>
                                                <option value="#f7f5f0">Light Ivory Studio (#f7f5f0)</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Media Uploads -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wide border-b border-slate-100 pb-2">Product Imagery</h3>
                    
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-2">Upload Atelier Photos (First image becomes Primary)</label>
                        <input type="file" name="images[]" multiple accept="image/*" 
                               class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-white hover:file:bg-slate-800 cursor-pointer">
                    </div>
                </div>

                <!-- SEO Metadata -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wide border-b border-slate-100 pb-2">Search Engine Optimization</h3>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">SEO Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title') }}" placeholder="e.g. Aurelia 1.50ct Diamond Ring | Modern Jewellery House" 
                               class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3.5 py-2 text-xs text-slate-900">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">SEO Meta Description</label>
                        <textarea name="meta_description" rows="2" placeholder="Compelling description for search results..." 
                                  class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3.5 py-2 text-xs text-slate-900">{{ old('meta_description') }}</textarea>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN (1 Col) -->
            <div class="space-y-6">
                
                <!-- Status & Publish -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wide border-b border-slate-100 pb-2">Publishing Status</h3>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Catalog Status *</label>
                        <select name="status" class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3 py-2 text-xs font-semibold text-slate-900">
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published (Active on Store)</option>
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Private Atelier Review)</option>
                            <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Category Classification *</label>
                        <select name="category_id" required class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3 py-2 text-xs text-slate-900">
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Collection</label>
                        <select name="collection_id" class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3 py-2 text-xs text-slate-900">
                            <option value="">None / Unassigned</option>
                            @foreach($collections as $col)
                                <option value="{{ $col->id }}" {{ old('collection_id') == $col->id ? 'selected' : '' }}>{{ $col->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="pt-3 border-t border-slate-100">
                        <button type="submit" class="w-full py-3 px-4 bg-slate-900 text-white rounded-lg text-xs font-bold tracking-wider uppercase hover:bg-slate-800 shadow-sm transition-colors">
                            Save Product Piece
                        </button>
                    </div>
                </div>

                <!-- Pricing & Vault Stock -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-4">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wide border-b border-slate-100 pb-2">Pricing & Inventory</h3>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Base Price (₹) *</label>
                        <input type="number" step="0.01" name="base_price" required value="{{ old('base_price') }}" placeholder="125000.00" 
                               class="w-full sub-input rounded-lg px-3.5 py-2 text-xs font-mono font-bold text-slate-900 dark:text-white">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Compare At / Strike Price (₹)</label>
                        <input type="number" step="0.01" name="compare_at_price" value="{{ old('compare_at_price') }}" placeholder="140000.00" 
                               class="w-full sub-input rounded-lg px-3.5 py-2 text-xs font-mono text-slate-900 dark:text-white">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Cost of Goods (₹)</label>
                        <input type="number" step="0.01" name="cost_price" value="{{ old('cost_price') }}" placeholder="72000.00" 
                               class="w-full sub-input rounded-lg px-3.5 py-2 text-xs font-mono text-slate-900 dark:text-white">
                        <p class="text-[10px] text-slate-500 mt-1">Confidential internal valuation.</p>
                    </div>

                    <div class="pt-2 border-t border-slate-100">
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Initial Vault Stock Quantity *</label>
                        <input type="number" name="stock" required min="0" value="{{ old('stock', 5) }}" 
                               class="w-full bg-slate-50 border border-slate-300 rounded-lg px-3.5 py-2 text-xs font-mono font-bold text-slate-900">
                        <p class="text-[10px] text-slate-500 mt-1">Automatic inventory ledger entry will be logged.</p>
                    </div>
                </div>

            </div>

        </div>

    </form>

</x-layouts.admin>
