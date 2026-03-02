<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BreadController as AdminBreadController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;

//Home routes - List breads, bread details
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/bread/{id}', [HomeController::class, 'show'])->name('bread.show');

//Product category routes
Route::get('/products/hot-selling', [HomeController::class, 'hotSelling'])->name('products.hot-selling');
Route::get('/products/new', [HomeController::class, 'newProducts'])->name('products.new');
Route::get('/products/sweet-bread', [HomeController::class, 'sweetBread'])->name('products.sweet-bread');
Route::get('/products/salty-bread', [HomeController::class, 'saltyBread'])->name('products.salty-bread');

// News & promotions
use App\Http\Controllers\NewsController;

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

//Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

//Order - login required
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');
    Route::get('/order/history', [OrderController::class, 'history'])->name('order.history');
    Route::get('/order/{id}', [OrderController::class, 'detail'])->name('order.detail');
});

//Profile routes (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Admin routes 
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/revenue-data', [DashboardController::class, 'revenueData'])->name('revenue.data');

    // Bread Management
    Route::resource('breads', AdminBreadController::class);

    // News Management
    Route::resource('news', AdminNewsController::class);

    // Order Management
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{id}/invoice', [AdminOrderController::class, 'invoice'])->name('orders.invoice');
    Route::patch('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // User Management
    Route::resource('users', AdminUserController::class);
});

require __DIR__ . '/auth.php';
