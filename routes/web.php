<?php

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart', [CartController::class, 'destroy'])->name('cart.destroy');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register.store');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');

    Route::post('/favorites/{product}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{product}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    Route::get('/featured', [productcontroller::class, 'featured'])->name('products.featured');

    Route::get('/orders/{order}/confirmation', [OrderController::class, 'confirmation'])->name('orders.confirmation');

    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::resource('products', AdminProductController::class);
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
        Route::patch('orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.status.update');


    });
});
