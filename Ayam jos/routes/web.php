<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;

// Home Page (Menu page)
Route::get('/', [MenuController::class, 'index'])->name('home');

Route::get('/chat', [ChatController::class, 'show'])->name('chat');
Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');


// Routes for Order
Route::get('/order', [OrderController::class, 'showOrder'])->name('order'); // Show Order Page
Route::post('/order', [OrderController::class, 'storeOrder']); // Store an Order


Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');
Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');

Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/order/addToCart', [OrderController::class, 'addToCart'])->middleware('auth')->name('order.addToCart');
Route::delete('/order/remove/{id}', [OrderController::class, 'removeFromCart'])->name('order.removeFromCart');
Route::get('/order/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
Route::put('/order/update/{id}', [OrderController::class, 'update'])->name('order.update');
Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');


Route::get('/admin/cekorder', [OrderController::class, 'adminindex'])->name('admin.cekorder');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('admin/messages/{id}/reply', [ChatController::class, 'reply']);
Route::get('/admin/home', [AdminController::class, 'home'])->name('admin.home');
Route::get('/admin/messages', [ChatController::class, 'index']); // untuk lihat dan balas pesan
Route::get('/admin/users', [AdminController::class, 'listUsers']); // lihat semua user
Route::get('/admin/menus', [AdminController::class, 'listMenus']); // lihat semua menu

// ADMIN MENU CRUD
Route::get('/admin/menus', [MenuController::class, 'adminIndex'])->name('admin.menus');
Route::post('/admin/menus', [MenuController::class, 'adminStore']);
Route::get('/admin/menus/{id}/edit', [MenuController::class, 'adminEdit']);
Route::post('/admin/menus/{id}/update', [MenuController::class, 'adminUpdate']);
Route::post('/admin/menus/{id}/delete', [MenuController::class, 'adminDestroy']);



