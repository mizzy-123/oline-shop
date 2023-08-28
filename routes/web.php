<?php

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

Route::get('/', function () {
    return view('main.pages.home');
})->name('home');

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
