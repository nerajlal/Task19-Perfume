<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('landing.vespr-landing');
})->name('landing');

Route::get('/home', [App\Http\Controllers\LandingController::class, 'index'])->name('landing.old');
Route::get('/templates', [App\Http\Controllers\LandingController::class, 'templates'])->name('landing.templates');

// Shared Actions (Global)
Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/fetch', [App\Http\Controllers\CartController::class, 'fetch'])->name('cart.fetch');
Route::post('/order/place', [App\Http\Controllers\OrderController::class, 'store'])->name('order.place');

// v1 Nurah Theme Routes
Route::prefix('v1')->name('v1.')->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/collections', [PageController::class, 'collection'])->name('collection');
    Route::get('/products', [PageController::class, 'collection'])->name('products');
    Route::get('/all-products', [PageController::class, 'allProducts'])->name('all-products');
    Route::get('/combos', [PageController::class, 'combos'])->name('combos');
    Route::get('/combo', [PageController::class, 'combo'])->name('combo');
    Route::get('/cosmopolitan', [PageController::class, 'cosmopolitan'])->name('cosmopolitan');
    Route::get('/product', [PageController::class, 'product'])->name('product');
    Route::view('/about', 'nurah.about')->name('about');
    Route::view('/contact', 'nurah.contact')->name('contact');
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
    Route::get('/shipping-policy', [PageController::class, 'shippingPolicy'])->name('shipping-policy');
    Route::get('/return-policy', [PageController::class, 'returnPolicy'])->name('return-policy');
    Route::get('/terms-of-service', [PageController::class, 'termsOfService'])->name('terms-of-service');
});

// Account Routes
Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account.index')->middleware('auth');
Route::post('/account/address', [App\Http\Controllers\AccountController::class, 'updateAddress'])->name('account.address.update')->middleware('auth');
Route::get('/account/orders', [App\Http\Controllers\AccountController::class, 'orders'])->name('account.orders')->middleware('auth');

// User Auth Routes
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
// Google Auth
Route::get('auth/google', [App\Http\Controllers\AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [App\Http\Controllers\AuthController::class, 'handleGoogleCallback']);

// Protected User Routes
Route::middleware('auth')->group(function () {
    Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account.index');
    Route::post('/account/address', [App\Http\Controllers\AccountController::class, 'updateAddress'])->name('account.address.update');
});

// Admin Routes (Auth Disabled for now)
// Route::prefix('admin')->name('admin.')->group(function () {
//     // Auth Routes
//     Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
//     Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.submit');
//     Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

//     // Protected Routes
//     Route::middleware('auth')->group(function () {
//         Route::view('/', 'admin.dashboard')->name('dashboard');
//     });
// });

// // Fallback for auth middleware if 'login' route is missing
// Route::get('/login', function() {
//     return redirect()->route('admin.login');
// })->name('login');

Route::get('/admin', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders');
Route::get('/admin/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.orders.show');
Route::get('/admin/orders/{id}/print', [App\Http\Controllers\Admin\OrderController::class, 'print'])->name('admin.orders.print');
Route::post('/admin/orders/{id}/update-status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('admin.orders.update-status');

Route::get('/admin/collections', [App\Http\Controllers\Admin\CollectionController::class, 'index'])->name('admin.collections');
Route::get('/admin/collections/create', [App\Http\Controllers\Admin\CollectionController::class, 'create'])->name('admin.collections.create');
Route::post('/admin/collections', [App\Http\Controllers\Admin\CollectionController::class, 'store'])->name('admin.collections.store');
Route::get('/admin/collections/{id}', [App\Http\Controllers\Admin\CollectionController::class, 'show'])->name('admin.collections.show');
Route::get('/admin/collections/{id}/edit', [App\Http\Controllers\Admin\CollectionController::class, 'edit'])->name('admin.collections.edit');
Route::put('/admin/collections/{id}', [App\Http\Controllers\Admin\CollectionController::class, 'update'])->name('admin.collections.update');
Route::delete('/admin/collections/{id}', [App\Http\Controllers\Admin\CollectionController::class, 'destroy'])->name('admin.collections.destroy');

Route::get('/admin/bundles', [App\Http\Controllers\Admin\BundleController::class, 'index'])->name('admin.bundles');
Route::get('/admin/bundles/create', [App\Http\Controllers\Admin\BundleController::class, 'create'])->name('admin.bundles.create');
Route::get('/admin/bundles/pool/create', [App\Http\Controllers\Admin\BundleController::class, 'createPool'])->name('admin.bundles.pool.create');
Route::post('/admin/bundles', [App\Http\Controllers\Admin\BundleController::class, 'store'])->name('admin.bundles.store');
Route::post('/admin/bundles/pack-of', [App\Http\Controllers\Admin\BundleController::class, 'storePackOf'])->name('admin.bundles.pack-of');
Route::post('/admin/bundles/pool', [App\Http\Controllers\Admin\BundleController::class, 'storePool'])->name('admin.bundles.pool');
Route::get('/admin/bundles/{id}/edit', [App\Http\Controllers\Admin\BundleController::class, 'edit'])->name('admin.bundles.edit');
Route::put('/admin/bundles/{id}', [App\Http\Controllers\Admin\BundleController::class, 'update'])->name('admin.bundles.update');
Route::delete('/admin/bundles/{id}', [App\Http\Controllers\Admin\BundleController::class, 'destroy'])->name('admin.bundles.destroy');

Route::get('/admin/products/{id}/variants', [App\Http\Controllers\Admin\ProductController::class, 'getVariants'])->name('admin.products.variants');

Route::get('/admin/attributes', [App\Http\Controllers\Admin\AttributeController::class, 'index'])->name('admin.attributes');
Route::post('/admin/attributes', [App\Http\Controllers\Admin\AttributeController::class, 'store'])->name('admin.attributes.store');
Route::put('/admin/attributes/{id}', [App\Http\Controllers\Admin\AttributeController::class, 'update'])->name('admin.attributes.update');
Route::delete('/admin/attributes/{id}', [App\Http\Controllers\Admin\AttributeController::class, 'destroy'])->name('admin.attributes.destroy');

Route::get('/admin/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products');
Route::get('/admin/products/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.products.create');
Route::post('/admin/products', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.products.store');
Route::get('/admin/products/{id}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.products.edit');
Route::put('/admin/products/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.products.update');
Route::delete('/admin/products/{id}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.products.destroy');

Route::view('/admin/reviews', 'admin.reviews.index')->name('admin.reviews');

Route::view('/admin/blog', 'admin.blog.index')->name('admin.blog');
Route::view('/admin/blog/create', 'admin.blog.create')->name('admin.blog.create');
Route::get('/admin/blog/{id}/edit', function ($id) {
    return view('admin.blog.edit', ['id' => $id]);
})->name('admin.blog.edit');


Route::get('/admin/customers', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('admin.customers');
Route::view('/admin/customers/create', 'admin.customers.create')->name('admin.customers.create');
Route::get('/admin/customers/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('admin.customers.show');

Route::get('/admin/carts', [App\Http\Controllers\Admin\CartController::class, 'index'])->name('admin.carts');

Route::get('/admin/analytics', [App\Http\Controllers\Admin\AnalyticsController::class, 'index'])->name('admin.analytics');
Route::get('/admin/analytics/{type}', function ($type) {
    $titles = [
        'sales' => ['title' => 'Total Sales', 'value' => '₹45,231.00', 'metricLabel' => 'Revenue'],
        'orders' => ['title' => 'Total Orders', 'value' => '342', 'metricLabel' => 'Orders'],
        'aov' => ['title' => 'Average Order Value', 'value' => '₹1,250.00', 'metricLabel' => 'Order Value'],
        'sessions' => ['title' => 'Online Store Sessions', 'value' => '10,234', 'metricLabel' => 'Sessions'],
    ];

    $data = $titles[$type] ?? ['title' => 'Report', 'value' => '0', 'metricLabel' => 'Count'];

    return view('admin.analytics.report', $data);
})->name('admin.analytics.show');
Route::get('/admin/discounts', [App\Http\Controllers\Admin\DiscountController::class, 'index'])->name('admin.discounts');
Route::get('/admin/discounts/create', [App\Http\Controllers\Admin\DiscountController::class, 'create'])->name('admin.discounts.create');
Route::post('/admin/discounts', [App\Http\Controllers\Admin\DiscountController::class, 'store'])->name('admin.discounts.store');
Route::get('/admin/discounts/{id}/edit', [App\Http\Controllers\Admin\DiscountController::class, 'edit'])->name('admin.discounts.edit');
Route::put('/admin/discounts/{id}', [App\Http\Controllers\Admin\DiscountController::class, 'update'])->name('admin.discounts.update');
Route::delete('/admin/discounts/{id}', [App\Http\Controllers\Admin\DiscountController::class, 'destroy'])->name('admin.discounts.destroy');

Route::get('/admin/settings/slider', [App\Http\Controllers\Admin\SliderController::class, 'index'])->name('admin.settings.slider');
Route::get('/admin/settings/slider/create', [App\Http\Controllers\Admin\SliderController::class, 'create'])->name('admin.settings.slider.create');
Route::post('/admin/settings/slider', [App\Http\Controllers\Admin\SliderController::class, 'store'])->name('admin.settings.slider.store');
Route::post('/admin/settings/slider/reorder', [App\Http\Controllers\Admin\SliderController::class, 'reorder'])->name('admin.settings.slider.reorder');
Route::delete('/admin/settings/slider/{id}', [App\Http\Controllers\Admin\SliderController::class, 'destroy'])->name('admin.settings.slider.destroy');

Route::get('/admin/settings/home-products', [App\Http\Controllers\Admin\HomeProductController::class, 'index'])->name('admin.settings.home-products');
Route::post('/admin/settings/home-products', [App\Http\Controllers\Admin\HomeProductController::class, 'store'])->name('admin.settings.home-products.store');
Route::post('/admin/settings/home-products/reorder', [App\Http\Controllers\Admin\HomeProductController::class, 'reorder'])->name('admin.settings.home-products.reorder');
Route::delete('/admin/settings/home-products/{id}', [App\Http\Controllers\Admin\HomeProductController::class, 'destroy'])->name('admin.settings.home-products.destroy');

Route::view('/admin/settings/managers', 'admin.settings.managers.index')->name('admin.settings.managers');
Route::view('/admin/settings/managers/create', 'admin.settings.managers.create')->name('admin.settings.managers.create');

Route::post('admin/settings/delivery-partners/{id}/default', [App\Http\Controllers\Admin\DeliveryPartnerController::class, 'setDefault'])->name('admin.settings.delivery-partners.default');

Route::resource('admin/settings/delivery-partners', App\Http\Controllers\Admin\DeliveryPartnerController::class, [
    'names' => 'admin.settings.delivery-partners'
])->except(['show', 'create', 'edit']);


// v2 Velvet Theme Routes
Route::prefix('v2')->name('velvet.')->group(function () {
    Route::get('/', function() {
        $bestsellers = \App\Models\HomeProduct::with(['product.variants', 'product.images', 'product.discounts'])
            ->orderBy('sort_order', 'asc')
            ->get();
        $collections = \App\Models\Collection::where('status', 1)->get();
        $bundles = \App\Models\Bundle::where('status', 'active')
            ->where('type', '!=', 'pool')
            ->with(['products.variants'])
            ->latest()
            ->take(4)
            ->get();
            
        return view('velvet.home', compact('bestsellers', 'collections', 'bundles'));
    })->name('home');

    Route::get('/all-products', function() {
        $products = \App\Models\Product::where('status', 'active')->with(['variants', 'images'])->latest()->get();
        $collections = \App\Models\Collection::where('status', 1)->get();
        return view('velvet.all-products', compact('products', 'collections'));
    })->name('all-products');

    Route::get('/collection/{slug}', function($slug) {
        $collection = \App\Models\Collection::where('slug', $slug)->firstOrFail();
        $products = $collection->products()->where('status', 'active')->with(['variants', 'images'])->get();
        $collections = \App\Models\Collection::where('status', 1)->get();
        return view('velvet.collection', compact('collection', 'products', 'collections'));
    })->name('collection');

    Route::get('/combos', function() {
        $bundles = \App\Models\Bundle::where('status', 'active')->where('type', '!=', 'pool')->with(['products.variants'])->latest()->get();
        $collections = \App\Models\Collection::where('status', 1)->get();
        return view('velvet.combos', compact('bundles', 'collections'));
    })->name('combos');

    Route::get('/combo/{slug}', function($slug) {
        $bundle = \App\Models\Bundle::where('slug', $slug)->with(['products.variants', 'products.images'])->firstOrFail();
        $collections = \App\Models\Collection::where('status', 1)->get();
        return view('velvet.combo-detail', compact('bundle', 'collections'));
    })->name('combo');

    Route::get('/product/{id}', [PageController::class, 'velvetProduct'])->name('product');
});

// v3 Backup Theme Routes
Route::prefix('v3')->name('v3.')->group(function () {
    Route::get('/', [PageController::class, 'v3Home'])->name('home');
    Route::get('/collections', [PageController::class, 'v3Collection'])->name('collection');
    Route::get('/all-products', [PageController::class, 'v3AllProducts'])->name('all-products');
    Route::get('/combos', [PageController::class, 'v3Combos'])->name('combos');
    Route::get('/combo', [PageController::class, 'v3Combo'])->name('combo');
    Route::get('/product', [PageController::class, 'v3Product'])->name('product');
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'v3Index'])->name('cart');
    Route::get('/checkout', [PageController::class, 'v3Checkout'])->name('checkout');
    Route::view('/about', 'v3.about')->name('about');
    Route::view('/contact', 'v3.contact')->name('contact');
    Route::view('/shipping-policy', 'v3.shipping-policy')->name('shipping-policy');
    Route::view('/return-policy', 'v3.return-policy')->name('return-policy');
    Route::view('/terms-of-service', 'v3.terms-of-service')->name('terms-of-service');
});

// v4 Ajmal Theme Routes
Route::prefix('v4')->name('v4.')->group(function () {
    Route::get('/', [PageController::class, 'ajmalHome'])->name('home');
    Route::get('/collections', [PageController::class, 'ajmalCollection'])->name('collection');
    Route::get('/all-products', [PageController::class, 'ajmalAllProducts'])->name('all-products');
    Route::get('/product', [PageController::class, 'ajmalProduct'])->name('product');
    Route::get('/combos', [PageController::class, 'ajmalCombos'])->name('combos');
    Route::get('/combo', [PageController::class, 'ajmalCombo'])->name('combo');
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'ajmalCart'])->name('cart');
    Route::get('/checkout', [PageController::class, 'ajmalCheckout'])->name('checkout');
});

// v5 Afnan Theme Routes
Route::prefix('v5')->name('v5.')->group(function () {
    Route::get('/', [PageController::class, 'afnanHome'])->name('home');
    Route::get('/collections', [PageController::class, 'afnanCollection'])->name('collection');
    Route::get('/all-products', [PageController::class, 'afnanAllProducts'])->name('all-products');
    Route::get('/product', [PageController::class, 'afnanProduct'])->name('product');
    Route::get('/combos', [PageController::class, 'afnanCombos'])->name('combos');
    Route::get('/combo', [PageController::class, 'afnanCombo'])->name('combo');
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'afnanCart'])->name('cart');
    Route::get('/checkout', [PageController::class, 'afnanCheckout'])->name('checkout');
});

// Super Admin Routes (Public for Verification)
Route::prefix('su-admin')->name('super_admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\SuperAdmin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/create-tenant', [App\Http\Controllers\SuperAdmin\DashboardController::class, 'createTenant'])->name('create_tenant');
    Route::post('/create-tenant', [App\Http\Controllers\SuperAdmin\DashboardController::class, 'storeTenant'])->name('store_tenant');
});
