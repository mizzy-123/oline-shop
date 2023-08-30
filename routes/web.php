<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('main.pages.about');
})->name('about');

Route::get('/dashboard', function () {
    return view('dashboard.pages.dashboard');
})->name('dashboard');

Route::get('/scan', [ScanController::class, 'index'])->name('scan');

Route::get('/statuswa', [ScanController::class, 'status']);

Route::get('/cart', function () {
    return view('main.pages.cart');
})->name('cart');

Route::get('/addcart/{product:slug}', [CartController::class, 'addToCart'])->name('addcart');

Route::get('/product-detail/{product:slug}', function () {
    return view('main.pages.product');
})->name('product.detail');

Route::get('/checkout', function () {
    return view('main.pages.checkout');
})->name('checkout');

Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
