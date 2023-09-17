<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailVerificationNotificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
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


Route::middleware('guest')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/jenis-product', [JenisProductController::class, 'index'])->name('jenis-product.index');

    Route::get('/tambah-jenis-product', [JenisProductController::class, 'add'])->name('jenis-product.add');

    Route::post('/tambah-jenis-product', [JenisProductController::class, 'store'])->name('jenis-product.store');

    Route::get('/delete-jenis-product/{category}', [JenisProductController::class, 'destroy'])->name('jenis-product.destroy');

    Route::get('/edit-jenis-product/{category}', [JenisProductController::class, 'edit'])->name('jenis-product.edit');

    Route::post('/update-jenis-product/{category}', [JenisProductController::class, 'update'])->name('jenis-product.update');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');

    Route::get('/tambah-product', [ProductController::class, 'add'])->name('product.add');

    Route::post('/tambah-product', [ProductController::class, 'store'])->name('product.store');

    Route::post('/update-product/{product}', [ProductController::class, 'update'])->name('product.update');

    Route::post('/update-product-stock/{product}', [ProductController::class, 'stockUpdate'])->name('product.stock.update');

    Route::get('/delete-product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('/edit-photo-product/{product}', [ProductController::class, 'editPhoto'])->name('product.edit.photo');

    Route::post('/update-photo/{photo}', [ProductController::class, 'updatePhoto']);

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

    Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,60')->name('verification.send');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');

    Route::post('/login', [LoginController::class, 'store'])->name('login.store');


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
