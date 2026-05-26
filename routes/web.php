<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'home'])->name('home');

// User Authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register.post');
});

Route::post('/wallet/store', [WalletController::class, 'store'])->name('wallet.store');

Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Public/frontend routes (previously protected by `auth`) — made public again
Route::get('/video', function () {
    return view('video');
});

Route::get('/digital-products/wordpress-themes-plugins', function () {
    return view('digital-products.wordpress');
});

Route::get('/culture-of-change', function () {
    return view('culture-of-change');
});

Route::get('/learn', function () {
    return view('learn');
});

Route::get('/digital-products', [FrontendController::class, 'digitalProducts'])->name('digital-products');
Route::get('/digital-products/{slug}', [FrontendController::class, 'productCategory'])->name('digital-products.category');
Route::get('/product-category/digital-services/{slug}', [FrontendController::class, 'serviceCategory'])->name('digital-services.category');
Route::get('/digital-services', [FrontendController::class, 'digitalServices'])->name('digital-services');
Route::get('/digital-services/{slug}', [FrontendController::class, 'serviceDetail'])->name('digital-services.show');

// Blog Routes
Route::get('/blog', [FrontendController::class, 'blogIndex'])->name('blog.index');
Route::get('/blog/{slug}', [FrontendController::class, 'blogShow'])->name('blog.show');

// About Us Routes
Route::get('/culture-of-change', [FrontendController::class, 'aboutCulture'])->name('about.culture');
Route::get('/engagement-models', function () {
    return view('engagement-models');
})->name('engagement-models');

// 10 CR Blueprint Landing Page
Route::get('/10-cr-blueprint/session-3-leadership-people-blueprint', function () {
    return view('10cr-blueprint');
})->name('10cr.blueprint.session3');

Route::get('/channel-distribution-management-software-development', function () {
    return view('channel-distribution-management-software-development');
})->name('channel-distribution-management-software-development');

Route::get('/custom-manufacturing-operations-control-software-development', function () {
    return view('custom-manufacturing-operations-control-software-development');
})->name('custom-manufacturing-operations-control-software-development');

Route::get('/supplychain-logistic', function () {
    return view('supplychain-logistic');
})->name('supplychain-logistic');

Route::get('/seo-services', function () {
    return view('seo-services');
})->name('seo-services');

Route::get('/erpnext-implementation', function () {
    return view('erpnext-implementation');
})->name('erpnext-implementation');

Route::get('/erpnext-for-healthcare', function () {
    return view('erpnext-for-healthcare');
})->name('erpnext-for-healthcare');

Route::get('/custom-warehouse-inventory-management-software-development', function () {
    return view('custom-warehouse-inventory-management-software-development');
})->name('custom-warehouse-inventory-management-software-development');

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('/refund-return-policy', function () {
    return view('refund-return-policy');
})->name('refund-return-policy');

// Contact Routes
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'contactStore'])->name('contact.store');

// User Profile (authenticated)
Route::middleware('auth')->get('/profile', [FrontendController::class, 'profile'])->name('profile');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Authentication (no middleware required for login)
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('admin.auth')->group(function () {
        // Dashboard
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        // Admins
        Route::resource('admins', App\Http\Controllers\Admin\AdminUserController::class);

        // Users
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
        Route::post('user/transection-history', [App\Http\Controllers\Admin\UserController::class, 'getTransectionHistoty'])->name('users.transection.history');

        // Categories
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);

        // Digital Products
        Route::get('/products', [App\Http\Controllers\Admin\DigitalProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [App\Http\Controllers\Admin\DigitalProductController::class, 'create'])->name('products.create');
        Route::post('/products', [App\Http\Controllers\Admin\DigitalProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [App\Http\Controllers\Admin\DigitalProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [App\Http\Controllers\Admin\DigitalProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [App\Http\Controllers\Admin\DigitalProductController::class, 'destroy'])->name('products.destroy');
        Route::patch('/products/{product}/toggle-status', [App\Http\Controllers\Admin\DigitalProductController::class, 'toggleStatus'])->name('products.toggle-status');

        // Digital Services
        Route::get('/services', [App\Http\Controllers\Admin\DigitalServiceController::class, 'index'])->name('services.index');
        Route::get('/services/create', [App\Http\Controllers\Admin\DigitalServiceController::class, 'create'])->name('services.create');
        Route::post('/services', [App\Http\Controllers\Admin\DigitalServiceController::class, 'store'])->name('services.store');
        Route::get('/services/{service}/edit', [App\Http\Controllers\Admin\DigitalServiceController::class, 'edit'])->name('services.edit');
        Route::put('/services/{service}', [App\Http\Controllers\Admin\DigitalServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{service}', [App\Http\Controllers\Admin\DigitalServiceController::class, 'destroy'])->name('services.destroy');
        Route::patch('/services/{service}/toggle-status', [App\Http\Controllers\Admin\DigitalServiceController::class, 'toggleStatus'])->name('services.toggle-status');

        // Blogs
        Route::post('blogs/upload-image', [App\Http\Controllers\Admin\ImageUploadController::class, 'upload'])->name('blogs.upload');
        Route::resource('blogs', App\Http\Controllers\Admin\BlogController::class);

        // Site Content Management
        Route::resource('settings', App\Http\Controllers\Admin\SettingController::class);
        Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class);
        Route::resource('features', App\Http\Controllers\Admin\FeatureController::class);
        Route::resource('impact-stats', App\Http\Controllers\Admin\ImpactStatController::class);
        Route::resource('page-contents', App\Http\Controllers\Admin\PageContentController::class);
        Route::resource('process-steps', App\Http\Controllers\Admin\ProcessStepController::class);
        Route::resource('locations', App\Http\Controllers\Admin\LocationController::class);
    });
});
