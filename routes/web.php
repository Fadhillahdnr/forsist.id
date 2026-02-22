<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK (TANPA LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/product', [HomeController::class, 'product'])->name('product');
Route::get('/product/{product}', [HomeController::class, 'show'])->name('product.show');
Route::get('/about', [HomeController::class, 'about'])->name('about');


/*
|--------------------------------------------------------------------------
| PROFILE USER (BREEZE)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| USER AREA (USER + ADMIN BOLEH AKSES)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user,admin'])->group(function () {

    // Dashboard user (admin bisa preview)
    Route::get('/user/dashboard', [HomeController::class, 'index'])
        ->name('user.dashboard');

    // CART
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::get('/add/{id}', [CartController::class, 'add'])->name('add');
        Route::get('/remove/{id}', [CartController::class, 'remove'])->name('remove');
        Route::get('/increase/{id}', [CartController::class, 'increase'])->name('increase');
        Route::get('/decrease/{id}', [CartController::class, 'decrease'])->name('decrease');
    });

    // CHECKOUT
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    // ORDER HISTORY USER
    Route::get('/orders', [UserOrderController::class, 'history'])->name('user.orders');
    Route::get('/orders/{id}', [UserOrderController::class, 'detail'])->name('user.orders.detail');
});


/*
|--------------------------------------------------------------------------
| ADMIN AREA (ADMIN ONLY)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // CRUD Product
        Route::resource('products', ProductController::class);

        // Product Category
        Route::post('/product-category', [ProductCategoryController::class, 'store'])
            ->name('product-category.store');

        Route::get('/product-category/{id}/edit', [ProductCategoryController::class, 'edit'])
            ->name('product-category.edit');

        Route::put('/product-category/{id}', [ProductCategoryController::class, 'update'])
            ->name('product-category.update');

        Route::delete('/product-category/{id}', [ProductCategoryController::class, 'destroy'])
            ->name('product-category.destroy');

        // Order Admin
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (LOGIN REGISTER LOGOUT)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
