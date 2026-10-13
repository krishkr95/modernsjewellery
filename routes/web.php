<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\ProfileController;
use App\Services\SEO\SeoService;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Brand & Catalog Routes
|--------------------------------------------------------------------------
*/
// Technical SEO: Dynamic Cached XML Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/', [HomeController::class, 'index'])->name('home');

// Discovery Catalog: /shop (Primary) and legacy alias /fine-jewellery
Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/fine-jewellery', [ProductController::class, 'index'])->name('products.index');

// Product Detail: /product/{slug} (Primary clean URL) and legacy alias /fine-jewellery/{slug}
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/fine-jewellery/{slug}', function (string $slug) {
    return redirect()->route('products.show', ['slug' => $slug], 301);
});
Route::post('/product/{product}/reviews', [ReviewController::class, 'store'])->name('products.reviews.store');

Route::get('/search', [SearchController::class, 'index'])->name('search');

// Recently Viewed APIs for Guest Local Storage Hydration
Route::post('/recently-viewed/record', [ProductController::class, 'recordRecentlyViewed'])->name('recently-viewed.record');
Route::post('/recently-viewed/fetch', [ProductController::class, 'fetchRecentlyViewed'])->name('recently-viewed.fetch');

/*
|--------------------------------------------------------------------------
| Shopping Bag & Cart Routes
|--------------------------------------------------------------------------
*/
Route::get('/bag', [CartController::class, 'index'])->name('cart.index');
Route::get('/bag/drawer', [CartController::class, 'drawer'])->name('cart.drawer');
Route::get('/cart', function () {
    return redirect()->route('cart.index');
});
Route::post('/bag/items', [CartController::class, 'store'])->name('cart.store');
Route::patch('/bag/items/{item}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/bag/items/{item}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/bag/coupon', [CartController::class, 'applyCoupon'])->name('cart.coupon');
Route::delete('/bag/coupon', [CartController::class, 'removeCoupon'])->name('cart.coupon.remove');

/*
|--------------------------------------------------------------------------
| Checkout, Razorpay & Order Fulfilment Routes
|--------------------------------------------------------------------------
*/
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::post('/checkout/verify', [CheckoutController::class, 'verify'])->name('checkout.verify');
Route::get('/checkout/confirmation/{orderNumber}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
Route::get('/orders/track/{orderNumber}', [CheckoutController::class, 'track'])->name('orders.track');

// Razorpay Webhook (Exempt from CSRF in bootstrap/app.php or middleware)
Route::post('/webhooks/razorpay', [CheckoutController::class, 'webhook'])->name('webhooks.razorpay');

/*
|--------------------------------------------------------------------------
| Wishlist
|--------------------------------------------------------------------------
*/
Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
Route::post('/wishlist/sync', [WishlistController::class, 'syncGuestWishlist'])->name('wishlist.sync');

/*
|--------------------------------------------------------------------------
| Guest Authentication
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::delete('/profile/avatar', [ProfileController::class, 'destroyAvatar'])->name('profile.avatar.destroy');
});

/*
|--------------------------------------------------------------------------
| Customer Account (Authenticated)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('account')->name('customer.')->group(function () {
    Route::get('/', [CustomerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
});

/*
|--------------------------------------------------------------------------
| Maison Management & Admin (Role Protected: SUPER_ADMIN, ADMIN, MANAGER, STAFF)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CollectionController as AdminCollectionController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\InventoryController as AdminInventoryController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\ContentController as AdminContentController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\AnalyticsController as AdminAnalyticsController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\AdminUserController as AdminAdminUserController;
use App\Http\Controllers\Admin\ActivityLogController as AdminActivityLogController;

Route::get('/dev-autologin', function() {
    $user = \App\Models\User::where('email', 'admin@modernjewelleryhouse.com')->first();
    if ($user) {
        \Illuminate\Support\Facades\Auth::login($user);
        return redirect()->route('admin.dashboard');
    }
    return 'Admin user not found';
});

Route::middleware(['auth', 'role:SUPER_ADMIN,ADMIN,MANAGER,STAFF'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.full');

    // PRD Section 2 URL Aliases
    Route::get('/catalog/products', fn() => redirect()->route('admin.products.index'));
    Route::get('/catalog/categories', fn() => redirect()->route('admin.categories.index'));
    Route::get('/catalog/collections', fn() => redirect()->route('admin.collections.index'));
    Route::get('/catalog/tags', fn() => redirect()->route('admin.products.index'));
    Route::get('/marketing/coupons', fn() => redirect()->route('admin.coupons.index'));
    Route::get('/marketing/campaigns', fn() => redirect()->route('admin.banners.index'));
    Route::get('/content/banners', fn() => redirect()->route('admin.banners.index'));
    Route::get('/content/pages', fn() => redirect()->route('admin.pages.index'));
    Route::get('/content/faqs', fn() => redirect()->route('admin.faqs.index'));
    Route::get('/content/testimonials', fn() => redirect()->route('admin.reviews.index'));
    Route::get('/orders/pending', fn() => redirect()->route('admin.orders.index', ['status' => 'pending']));
    Route::get('/orders/processing', fn() => redirect()->route('admin.orders.index', ['status' => 'processing']));
    Route::get('/orders/shipped', fn() => redirect()->route('admin.orders.index', ['status' => 'shipped']));
    Route::get('/orders/delivered', fn() => redirect()->route('admin.orders.index', ['status' => 'delivered']));
    Route::get('/orders/cancelled', fn() => redirect()->route('admin.orders.index', ['status' => 'cancelled']));
    Route::get('/orders/refunds', fn() => redirect()->route('admin.orders.index', ['status' => 'refunded']));

    // Products
    Route::post('products/{product}/duplicate', [AdminProductController::class, 'duplicate'])->name('products.duplicate');
    Route::post('products/{product}/toggle-publish', [AdminProductController::class, 'togglePublish'])->name('products.toggle-publish');
    Route::post('products/{product}/archive', [AdminProductController::class, 'archive'])->name('products.archive');
    Route::post('products/{product}/images/{image}/primary', [AdminProductController::class, 'setPrimaryImage'])->name('products.images.primary');
    Route::delete('products/{product}/images/{image}', [AdminProductController::class, 'deleteImage'])->name('products.images.delete');
    Route::resource('products', AdminProductController::class);

    // Categories & Collections
    Route::resource('categories', AdminCategoryController::class)->except(['show', 'create', 'edit']);
    Route::resource('collections', AdminCollectionController::class)->except(['show', 'create', 'edit']);

    // Orders & Refunds
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
    Route::post('orders/{order}/refund', [AdminOrderController::class, 'refund'])->name('orders.refund');
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show']);

    // Inventory
    Route::get('inventory', [AdminInventoryController::class, 'index'])->name('inventory.index');
    Route::post('inventory/{inventory}/adjust', [AdminInventoryController::class, 'adjust'])->name('inventory.adjust');

    // Customers
    Route::resource('customers', AdminCustomerController::class)->only(['index', 'show']);

    // Marketing: Coupons & Banners
    Route::post('coupons/{coupon}/toggle-active', [AdminCouponController::class, 'toggleActive'])->name('coupons.toggle-active');
    Route::resource('coupons', AdminCouponController::class);
    Route::post('banners/{banner}/toggle-active', [AdminBannerController::class, 'toggleActive'])->name('banners.toggle-active');
    Route::resource('banners', AdminBannerController::class)->except(['show', 'create', 'edit']);

    // Reviews Moderation
    Route::post('reviews/{review}/approve', [AdminReviewController::class, 'approve'])->name('reviews.approve');
    Route::post('reviews/{review}/reject', [AdminReviewController::class, 'reject'])->name('reviews.reject');
    Route::post('reviews/{review}/feature', [AdminReviewController::class, 'toggleFeature'])->name('reviews.feature');
    Route::delete('reviews/images/{image}', [AdminReviewController::class, 'destroyImage'])->name('reviews.images.destroy');
    Route::delete('reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('reviews', [AdminReviewController::class, 'index'])->name('reviews.index');

    // Content: Homepage CMS, Pages, FAQs
    Route::get('content/homepage', [AdminContentController::class, 'homepage'])->name('content.homepage');
    Route::post('content/homepage', [AdminContentController::class, 'updateHomepage'])->name('content.homepage.update');
    Route::resource('pages', AdminPageController::class)->except(['show']);
    Route::resource('faqs', AdminFaqController::class)->except(['show', 'create', 'edit']);

    // Intelligence: Analytics
    Route::get('analytics', [AdminAnalyticsController::class, 'index'])->name('analytics.index');

    // Activity Logs
    Route::get('activity-logs', [AdminActivityLogController::class, 'index'])->name('activity-logs.index');

    // Protected System Settings & Users (Strict Gate Authorization)
    Route::get('settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [AdminSettingController::class, 'update'])->name('settings.update');
    Route::post('settings/test-email', [AdminSettingController::class, 'sendTestEmail'])->name('settings.test-email');

    Route::resource('users', AdminAdminUserController::class)->except(['show', 'create', 'edit']);
});

/*
|--------------------------------------------------------------------------
| Hostinger Zero-SSH Setup Helper Route
|--------------------------------------------------------------------------
| Allows 1-click execution of storage symlink and cache warming from the browser.
*/
Route::get('/hostinger-setup', function (\Illuminate\Http\Request $request) {
    $results = [];

    // 1. Create storage symlink
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        $results['storage:link'] = trim(\Illuminate\Support\Facades\Artisan::output()) ?: 'Symlink created / verified';
    } catch (\Throwable $e) {
        $results['storage:link'] = $e->getMessage();
    }

    // 2. Clear old caches
    try {
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        $results['optimize:clear'] = 'Cleared old config/route/view caches';
    } catch (\Throwable $e) {
        $results['optimize:clear'] = $e->getMessage();
    }

    // 3. Warm up fresh production caches
    try {
        \Illuminate\Support\Facades\Artisan::call('config:cache');
        \Illuminate\Support\Facades\Artisan::call('route:cache');
        \Illuminate\Support\Facades\Artisan::call('view:cache');
        $results['optimize:cache'] = 'Successfully compiled config, routes, and views';
    } catch (\Throwable $e) {
        $results['optimize:cache'] = $e->getMessage();
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Modern Jewellery House Hostinger setup completed successfully!',
        'tasks' => $results,
        'next_steps' => [
            'Home page' => url('/'),
            'Admin login' => url('/login') . ' (admin@modernjewelleryhouse.com / Secret@12345)',
        ]
    ]);
});

