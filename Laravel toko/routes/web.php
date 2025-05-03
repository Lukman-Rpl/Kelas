<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminhomeController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminBannerController;
use App\Http\Controllers\Admin\AdminCheckoutController;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/add-to-cart', [HomeController::class, 'addToCart'])->name('add.to.cart');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

// USER
Route::get('/login', [UserAuthController::class, 'showLogin'])->name('user.login');
Route::post('/login', [UserAuthController::class, 'login']);
Route::post('/register', [UserAuthController::class, 'register'])->name('user.register');
Route::get('/logout', [UserAuthController::class, 'logout'])->name('user.logout');

Route::get('/ulasan', [ReviewController::class, 'index'])->name('ulasan.index');
Route::post('/ulasan', [ReviewController::class, 'store'])->name('ulasan.store');


Route::prefix('admin')->name('admin.')->group(function () {
    
Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login']);
Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AdminhomeController::class, 'index'])->name('dashboard');
    // Product
Route::get('/product', [AdminProductController::class, 'index'])->name('products.index');
Route::get('/product/create', [AdminProductController::class, 'create'])->name('products.create');
Route::post('/product', [AdminProductController::class, 'store'])->name('products.store');
Route::get('/product/{id}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
Route::post('/product/{id}', [AdminProductController::class, 'update'])->name('products.update');
Route::delete('/product/{id}', [AdminProductController::class, 'destroy'])->name('products.destroy');

     // Menampilkan daftar pengguna
Route::get('/customers', [AdminCustomerController::class, 'index'])->name('users.index');
Route::delete('/customers/{id}', [AdminCustomerController::class, 'destroy'])->name('users.destroy');
   

Route::get('/banner', [AdminBannerController::class, 'index'])->name('banner');
Route::post('/banner', [AdminBannerController::class, 'store'])->name('banners.store');
Route::get('/banner/{id}/edit', [AdminBannerController::class, 'edit'])->name('banners.edit');
Route::put('/banner/{id}', [AdminBannerController::class, 'update'])->name('banners.update');
Route::patch('/banner/set-active/{id}', [AdminBannerController::class, 'setActive'])->name('banners.setActive');
Route::delete('/banner/{id}', [AdminBannerController::class, 'destroy'])->name('banners.destroy');

Route::get('/checkoutlist', [AdminCheckoutController::class, 'index'])->name('checkoutlist');
});


