<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Account\AddressBook;
use App\Livewire\Account\OrderHistory;
use App\Livewire\Auth\CustomerLogin;
use App\Livewire\Auth\CustomerRegister;
use App\Livewire\Cart;
use App\Livewire\Checkout;
use App\Livewire\HomePage;
use App\Livewire\PageStatic;
use App\Livewire\ProductCatalog;
use App\Livewire\ProductDetail;
use App\Livewire\SalesOrderDetail;
use App\Livewire\Wishlist;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/products', ProductCatalog::class)->name('product-catalog');
Route::get('/product/{product:slug}', ProductDetail::class)->name('product');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/checkout', Checkout::class)->middleware('throttle:15,1')->name('checkout');
Route::get('/order-confirmed/{sales_order:trx_id}', SalesOrderDetail::class)->name('order-confirmed');
Route::get('/page/{page:slug?}', PageStatic::class)->name('page');
Route::webhooks('moota/callback')->middleware('throttle:60,1');

Route::middleware(['guest', 'throttle:10,1'])->group(function () {
    Route::get('/login', CustomerLogin::class)->name('login');
    Route::get('/register', CustomerRegister::class)->name('register');
});

// Google OAuth
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('auth.google.callback');
Route::get('/auth/google/token-login/{token}', [GoogleController::class, 'tokenLogin'])->name('auth.google.token-login');

Route::middleware('auth')->group(function () {
    Route::get('/account/orders', OrderHistory::class)->name('account.orders');
    Route::get('/account/wishlist', Wishlist::class)->name('account.wishlist');
    Route::get('/account/addresses', AddressBook::class)->name('account.addresses');
    Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');
});

Route::middleware(['auth'])->prefix('back')->name('admin.')->group(function () {
    Route::get('/sales-orders/{order}/invoice', \App\Http\Controllers\Admin\InvoiceController::class)->name('sales-orders.invoice');
});
