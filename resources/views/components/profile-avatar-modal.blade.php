<!-- Luxury Profile Picture Modal -->
<div x-data="{
        open: false,
        currentAvatar: '{{ auth()->user()?->avatar_url }}',
        previewUrl: null,
        fileName: '',
        fileSize: '',
        isSubmitting: false,
        isRemoving: false,
        hasCustomAvatar: {{ auth()->user()?->avatar ? 'true' : 'false' }},
        fileError: '',
        handleFileSelect(event) {
            this.fileError = '';
            const file = event.target.files[0];
            if (!file) return;

            if (!file.type.match('image.*')) {
                this.fileError = 'Please select a valid image file (JPG, PNG, WEBP, GIF).';
                return;
            }

            if (file.size > 5 * 1024 * 1024) {
                this.fileError = 'Selected image exceeds the 5MB file size limit.';
                return;
            }

            this.fileName = file.name;
            this.fileSize = (file.size / (1024 * 1024)).toFixed(2) + ' MB';

            const reader = new FileReader();
            reader.onload = (e) => {
                this.previewUrl = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        resetPreview() {
            this.previewUrl = null;
            this.fileName = '';
            this.fileSize = '';
            this.fileError = '';
            if (this.$refs.fileInput) {
                this.$refs.fileInput.value = '';
            }
        }
     }"
     x-on:open-avatar-modal.window="open = true; resetPreview()"
     x-on:keydown.escape.window="if(open) open = false"
     x-show="open"
     x-cloak
     class="fixed inset-0 z-[9999] overflow-y-auto flex items-center justify-center p-4 sm:p-6"
     style="display: none;">

    <!-- Frosted Backdrop -->
    <div x-show="open" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false" 
         class="fixed inset-0 bg-slate-950/70 backdrop-blur-md transition-opacity"></div>

    <!-- Modal Dialog Box -->
    <div x-show="open"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="relative w-full max-w-md bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-slate-200/80 dark:border-slate-800 p-6 sm:p-8 z-10 overflow-hidden">

        <!-- Golden Luxury Glow Accent -->
        <div class="absolute -top-16 -right-16 w-36 h-36 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-16 -left-16 w-36 h-36 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Header -->
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 dark:border-slate-800">
            <div class="flex items-center space-x-2.5">
                <div class="w-8 h-8 rounded-full bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-600 dark:text-amber-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 dark:text-white text-base tracking-tight font-sans">
                        Profile Portrait
                    </h3>
                    <p class="text-[11px] text-slate-400 font-medium">Edit and customize your account avatar</p>
                </div>
            </div>

            <button type="button" @click="open = false" 
                    class="p-1.5 rounded-full text-slate-400 hover:text-slate-600 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Form for Uploading Avatar -->
        <form action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data" 
              @submit="isSubmitting = true" class="mt-6 space-y-6">
            @csrf

            <!-- Avatar Preview Stage -->
            <div class="flex flex-col items-center justify-center space-y-3">
                <div class="relative group cursor-pointer" @click="$refs.fileInput.click()">
                    <!-- Outer Decorative Ring -->
                    <div class="w-28 h-28 rounded-full p-1 bg-gradient-to-tr from-[#B38728] via-[#FBF5B7] to-[#DAA520] shadow-lg shadow-amber-500/10">
                        <div class="w-full h-full rounded-full overflow-hidden bg-slate-900 flex items-center justify-center">
                            <!-- Image Display -->
                            <img :src="previewUrl ? previewUrl : currentAvatar" 
                                 alt="Profile Preview"
                                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        </div>
                    </div>

                    <!-- Camera Overlay Button -->
                    <div class="absolute bottom-0 right-0 w-8 h-8 rounded-full bg-slate-900 text-amber-400 border-2 border-white dark:border-slate-800 flex items-center justify-center shadow-md group-hover:bg-amber-500 group-hover:text-slate-950 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>

                <div class="text-center">
                    <p class="text-xs font-semibold text-slate-800 dark:text-slate-200">
                        <span x-show="!previewUrl">{{ auth()->user()?->name }}</span>
                        <span x-show="previewUrl" class="text-amber-600 dark:text-amber-400">New Image Selected</span>
                    </p>
                    <p class="text-[11px] text-slate-400" x-show="!previewUrl">
                        Click on the image or choose a file below to replace
                    </p>
                    <p class="text-[11px] font-mono text-slate-500 dark:text-slate-400" x-show="previewUrl">
                        <span x-text="fileName"></span> (<span x-text="fileSize"></span>)
                    </p>
                </div>
            </div>

            <!-- Error Banner -->
            <div x-show="fileError" x-cloak class="p-3 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 text-xs">
                <span x-text="fileError"></span>
            </div>

            <!-- Hidden File Input -->
            <input type="file" 
                   name="avatar" 
                   x-ref="fileInput" 
                   @change="handleFileSelect($event)" 
                   accept="image/png, image/jpeg, image/jpg, image/webp, image/gif"
                   class="hidden">

            <!-- Drag & Drop / Click Zone -->
            <div @click="$refs.fileInput.click()" 
                 class="border-2 border-dashed border-slate-200 dark:border-slate-700 hover:border-amber-500/50 dark:hover:border-amber-500/50 rounded-2xl p-4 text-center cursor-pointer transition-colors bg-slate-50/50 dark:bg-slate-800/40">
                <svg class="w-6 h-6 mx-auto mb-1.5 text-slate-400 group-hover:text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                <p class="text-xs font-semibold text-slate-700 dark:text-slate-300">
                    Click to browse or drop photo here
                </p>
                <p class="text-[10px] text-slate-400 mt-0.5">
                    Supports high-resolution PNG, JPG, WEBP (Max 5MB)
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3 pt-2">
                <button type="button" 
                        @click="open = false; resetPreview()" 
                        class="flex-1 py-2.5 px-4 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-xs font-bold hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    Cancel
                </button>

                <button type="submit" 
                        :disabled="!previewUrl || isSubmitting"
                        :class="previewUrl && !isSubmitting ? 'bg-gradient-to-r from-amber-600 via-amber-500 to-amber-600 text-slate-950 font-bold hover:shadow-lg hover:shadow-amber-500/20 active:scale-[0.98]' : 'bg-slate-200 dark:bg-slate-800 text-slate-400 cursor-not-allowed font-semibold'"
                        class="flex-1 py-2.5 px-4 rounded-xl text-xs uppercase tracking-wider transition-all flex items-center justify-center space-x-1.5">
                    <template x-if="isSubmitting">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-slate-950" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </template>
                    <span x-text="isSubmitting ? 'Saving...' : 'Update Portrait'"></span>
                </button>
            </div>
        </form>

        <!-- Revert to Initials (If user has custom avatar) -->
        <div x-show="hasCustomAvatar" class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800 text-center">
            <form action="{{ route('profile.avatar.destroy') }}" method="POST" 
                  onsubmit="return confirm('Remove custom picture and revert to default initials?');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="text-[11px] text-rose-500 hover:text-rose-600 dark:text-rose-400 font-semibold hover:underline inline-flex items-center space-x-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    <span>Remove custom photo</span>
                </button>
            </form>
        </div>

    </div>
</div>
