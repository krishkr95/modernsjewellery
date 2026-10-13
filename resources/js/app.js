import './bootstrap';
import Alpine from 'alpinejs';
import gsap from 'gsap';

window.Alpine = Alpine;
window.gsap = gsap;

// Global Toast Notification Store
Alpine.store('toast', {
    items: [],
    show(message, type = 'info', duration = 4000) {
        const id = Date.now() + Math.random();
        this.items.push({ id, message, type });
        setTimeout(() => {
            this.remove(id);
        }, duration);
    },
    remove(id) {
        this.items = this.items.filter(item => item.id !== id);
    }
});

// Global Cart Drawer Store
Alpine.store('cartDrawer', {
    open: false,
    itemCount: 0,
    toggle() {
        this.open = !this.open;
        if (this.open) {
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    },
    close() {
        this.open = false;
        document.body.classList.remove('overflow-hidden');
    }
});

// Global Video Call / Try At Home Booking Modal Store
Alpine.store('videoCallModal', {
    open: false,
    step: 1,
    selectedCategory: 'Rings',
    selectedDate: '',
    selectedSlot: '11:00 AM - 12:00 PM',
    name: '',
    phone: '',
    email: '',
    toggle() {
        this.open = !this.open;
        if (this.open) {
            this.step = 1;
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    },
    close() {
        this.open = false;
        document.body.classList.remove('overflow-hidden');
    },
    submit() {
        Alpine.store('toast').show('Video Call booked successfully! Our diamond expert will call you at the scheduled time.', 'success', 5000);
        this.close();
    }
});

// Global Store Locator Modal Store
Alpine.store('storeModal', {
    open: false,
    selectedCity: 'Mumbai',
    stores: [
        { city: 'Mumbai', name: 'BlueStone Flagship - Bandra West', address: 'Linking Road, Bandra West, Mumbai 400050', phone: '+91 22 2640 1234', timing: '11:00 AM - 9:00 PM' },
        { city: 'Mumbai', name: 'BlueStone High Street Phoenix', address: 'Grand Galleria, Lower Parel, Mumbai 400013', phone: '+91 22 4004 5678', timing: '11:00 AM - 9:30 PM' },
        { city: 'Delhi', name: 'BlueStone South Extension', address: 'Part 1, Main Ring Road, New Delhi 110049', phone: '+91 11 4164 2200', timing: '10:30 AM - 8:30 PM' },
        { city: 'Bengaluru', name: 'BlueStone Indiranagar Flagship', address: '100 Feet Road, HAL 2nd Stage, Bengaluru 560038', phone: '+91 80 4115 8899', timing: '11:00 AM - 9:00 PM' },
        { city: 'Bengaluru', name: 'BlueStone Phoenix Marketcity', address: 'Whitefield Main Road, Mahadevapura, Bengaluru 560048', phone: '+91 80 4962 6600', timing: '11:00 AM - 9:30 PM' },
    ],
    toggle() {
        this.open = !this.open;
        if (this.open) {
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    },
    close() {
        this.open = false;
        document.body.classList.remove('overflow-hidden');
    }
});

// Global Search Modal / Autocomplete Store
Alpine.store('searchModal', {
    open: false,
    query: '',
    results: [],
    loading: false,
    recentSearches: ['Solitaire Rings', 'Evil Eye Pendants', 'Gold Coins 24K', 'Diamond Studs', 'Mangalsutra'],
    toggle() {
        this.open = !this.open;
        if (this.open) {
            document.body.classList.add('overflow-hidden');
            setTimeout(() => {
                const input = document.getElementById('search-modal-input');
                if (input) input.focus();
            }, 100);
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    },
    close() {
        this.open = false;
        this.query = '';
        this.results = [];
        document.body.classList.remove('overflow-hidden');
    },
    async search() {
        if (!this.query.trim()) {
            this.results = [];
            return;
        }
        this.loading = true;
        try {
            const res = await fetch(`/search?q=${encodeURIComponent(this.query)}`, {
                headers: { 'Accept': 'application/json' }
            });
            if (res.ok) {
                const data = await res.json();
                this.results = data.results || [];
            }
        } catch (e) {
            console.error('Search error:', e);
        } finally {
            this.loading = false;
        }
    }
});

// ============================================================
// BLUESTONE WISHLIST & LOCALSTORAGE SYNC SYSTEM
// ============================================================
window.getGuestWishlist = function() {
    try {
        return JSON.parse(localStorage.getItem('mjh_guest_wishlist') || '[]');
    } catch (e) {
        return [];
    }
};

window.isGuestWishlisted = function(productId) {
    const list = window.getGuestWishlist();
    return list.includes(Number(productId)) || list.includes(String(productId));
};

window.updateWishlistHeaderCount = function() {
    const countEl = document.getElementById('header-wishlist-count');
    if (countEl) {
        const list = window.getGuestWishlist();
        countEl.textContent = list.length;
    }
};

window.toggleMaisonWishlist = function(productId, btnElement) {
    let list = window.getGuestWishlist();
    const pid = Number(productId);
    const index = list.indexOf(pid);
    let added = false;

    if (index > -1) {
        list.splice(index, 1);
        added = false;
    } else {
        list.push(pid);
        added = true;
    }

    localStorage.setItem('mjh_guest_wishlist', JSON.stringify(list));
    window.updateWishlistHeaderCount();

    // Trigger visual heart pop micro-animation if button supplied
    if (btnElement) {
        btnElement.classList.add('animate-heart-pop');
        setTimeout(() => {
            btnElement.classList.remove('animate-heart-pop');
        }, 400);
    }

    if (added) {
        Alpine.store('toast').show('Saved to your Wishlist!', 'success', 3000);
    } else {
        Alpine.store('toast').show('Removed from Wishlist.', 'info', 3000);
    }

    // If authenticated, sync with server
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (csrfToken) {
        fetch('/wishlist/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ product_id: pid })
        }).catch(() => {});
    }
};

// Update header bag count helper
window.updateHeaderBagCount = function(count) {
    const countEl = document.getElementById('header-bag-count');
    if (countEl) countEl.textContent = count;
};

// Initialize counts and GSAP on DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
    window.updateWishlistHeaderCount();

    // GSAP BlueStone Smooth Scroll & Reveal Animations
    if (window.gsap) {
        const reveals = document.querySelectorAll('.scroll-reveal');
        if (reveals.length) {
            reveals.forEach((el) => {
                gsap.fromTo(el, 
                    { opacity: 0, y: 24 },
                    { 
                        opacity: 1, 
                        y: 0, 
                        duration: 0.85, 
                        ease: 'power2.out',
                        scrollTrigger: el
                    }
                );
            });
        }
    }
});

Alpine.start();
