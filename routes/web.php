<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\Dashboard\CompanyProfileController as DashboardCompanyProfileController;
use App\Http\Controllers\Dashboard\FeedbackController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\TypeController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\StoreController;
use App\Http\Controllers\Dashboard\OrderController as DashboardOrderController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Artisan;


// Public Routes (User)
Auth::routes();

Route::get('/', [LandingController::class, 'index'])->name('index');

Route::get('shiping-procedure', function(){
    return view('pages.shiping-procedure');
})->name('shiping-procedure');

Route::get('shiping-ask', function(){
    return view('pages.shiping-ask');
})->name('shiping-ask');

Route::get('company-profile', [CompanyProfileController::class, 'index'])->name('company-profile');


Route::prefix('profile')->middleware('auth')->controller(ProfileController::class)->group(function () {
    Route::get('/', 'index')->name('profile');
    Route::put('/', 'update')->name('profile.update');
});

Route::prefix('cart')->middleware('auth')->controller(CartController::class)->group(function () {
    Route::get('/', 'index')->name('cart');
    Route::post('add/{product}', 'addTo')->name('cart.add');
    Route::put('update/{cartDetail}', 'update')->name('cart.update');
    Route::delete('remove/{cartDetail}', 'removeFrom')->name('cart.remove');
});

Route::prefix('checkout')->middleware('auth')->controller(CheckoutController::class)->group(function () {
    Route::get('', 'index')->name('checkout');
    Route::post('process', 'process')->name('checkout.process');
});

Route::prefix('orders')->middleware('auth')->controller(OrderController::class)->group(function () {
    Route::get('', 'index')->name('orders.list');
    Route::get('detail/{order}', 'detail')->name('orders.list.detail');
    Route::post('upload/{order}', 'upload')->name('orders.list.upload');
     Route::put('complete/{order}', 'complete')->name('orders.list.complete');
});

// Dashboard Routes (Admin & Superadmin)
Route::prefix('dashboard')->group(function () {

    // Guest (Login Page for Admin)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [\App\Http\Controllers\Dashboard\LoginController::class, 'showLoginForm'])->name('dashboard.login');
        Route::post('/login', [\App\Http\Controllers\Dashboard\LoginController::class, 'login'])->name('dashboard.login.submit');
    });

    // Authenticated (Admin & Superadmin)
    Route::middleware(['auth', 'checkrole:admin,superadmin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Logout (POST)
        Route::post('/logout', [\App\Http\Controllers\Dashboard\LoginController::class, 'logout'])->name('dashboard.logout');

        // Company Profile (Superadmin Only)
        Route::prefix('company-profile')->middleware('checkrole:superadmin')->controller(DashboardCompanyProfileController::class)->group(function () {
            Route::get('/', 'index')->name('company-profile.edit');
            Route::put('/update/{uuid}', 'update')->name('company-profile.update');
        });

        // Stores (Superadmin Only)
        Route::prefix('stores')->middleware('checkrole:superadmin')->controller(StoreController::class)->group(function () {
            Route::get('/', 'index')->name('stores');
            Route::get('/create', 'create')->name('stores.create');
            Route::post('/store', 'store')->name('stores.store');
            Route::get('/edit/{uuid}', 'edit')->name('stores.edit');
            Route::put('/update/{uuid}', 'update')->name('stores.update');
            Route::delete('/destroy/{uuid}', 'destroy')->name('stores.destroy');
        });

        // Admins (Superadmin Only)
        Route::prefix('admins')->middleware('checkrole:superadmin')->controller(AdminController::class)->group(function () {
            Route::get('/', 'index')->name('admins');
            Route::get('/create', 'create')->name('admins.create');
            Route::post('/store', 'store')->name('admins.store');
            Route::get('/edit/{uuid}', 'edit')->name('admins.edit');
            Route::put('/update/{uuid}', 'update')->name('admins.update');
            Route::delete('/destroy/{uuid}', 'destroy')->name('admins.destroy');
        });

        // Types (Superadmin Only)
        Route::prefix('types')->middleware('checkrole:superadmin')->controller(TypeController::class)->group(function () {
            Route::get('/', 'index')->name('types');
            Route::get('/create', 'create')->name('types.create');
            Route::post('/store', 'store')->name('types.store');
            Route::get('/edit/{uuid}', 'edit')->name('types.edit');
            Route::put('/update/{uuid}', 'update')->name('types.update');
            Route::delete('/destroy/{uuid}', 'destroy')->name('types.destroy');
        });

        // Customers (Superadmin Only)
        Route::prefix('customers')->middleware('checkrole:superadmin')->controller(CustomerController::class)->group(function () {
            Route::get('/', 'index')->name('customers');
            Route::get('/edit/{uuid}', 'edit')->name('customers.edit');
            Route::put('/update/{uuid}', 'update')->name('customers.update');
            Route::delete('/destroy/{uuid}', 'destroy')->name('customers.destroy');
        });

        // Products (Admin & Superadmin)
        Route::prefix('products')->controller(ProductController::class)->group(function () {
            Route::get('/', 'index')->name('products');
            Route::get('/create', 'create')->name('products.create');
            Route::post('/store', 'store')->name('products.store');
            Route::get('/edit/{uuid}', 'edit')->name('products.edit');
            Route::put('/update/{uuid}', 'update')->name('products.update');
            Route::delete('/destroy/{uuid}', 'destroy')->name('products.destroy');
            Route::delete('/images/destroy/{uuid}', 'destroyImage')->name('products.destroyImage');
        });

        // Orders (Admin & Superadmin)
        Route::prefix('orders')->controller(DashboardOrderController::class)->group(function () {
            Route::get('/', 'index')->name('orders');
            Route::get('/show/{uuid}', 'show')->name('orders.show');
            Route::put('/update/{uuid}', 'update')->name('orders.update');
        });

        // Feedback (Superadmin Only)
        Route::prefix('feedback')->middleware('checkrole:superadmin')->controller(FeedbackController::class)->group(function () {
            Route::get('/', 'index')->name('feedback');
            Route::get('/create', 'create')->name('feedback.create');
            Route::post('/store', 'store')->name('feedback.store');
            Route::get('/edit/{uuid}', 'edit')->name('feedback.edit');
            Route::put('/update/{uuid}', 'update')->name('feedback.update');
            Route::delete('/destroy/{uuid}', 'destroy')->name('feedback.destroy');
        });
    });
});

Route::post('/set-language', [LanguageController::class, 'setLanguage'])->name('set.language');


Route::get('/run-artisan', function () {
    if (!app()->environment('local')) {
        abort(403, 'Unauthorized');
    }

    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('storage:link');

    return 'Artisan commands executed: config:clear, cache:clear, route:clear, storage:link';
});