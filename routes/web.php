<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\WhatsappController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

    Route::get('/scan', [ScanController::class, 'index'])->name('scan');

    Route::get('/statuswa', [ScanController::class, 'status']);

    Route::get('/resend/{wamessage}', [WhatsappController::class, 'resend'])->name('resend');

    Route::get('/disconnect', [ScanController::class, 'disconnect'])->name('disconnect');

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/dashboard');
    })->middleware('signed')->name('verification.verify');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
});

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
