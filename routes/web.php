<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Transactions\OrderController;
use App\Http\Controllers\Transactions\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'index'])->name('homepage');

Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product');
    Route::get('/detail/{productID}', [ProductController::class, 'detail'])->name('product.detail');

    Route::get('checkout', [ProductController::class, 'checkout'])->name('product.checkout');
    Route::get('checkout/{productID}', [OrderController::class, 'checkout'])->name('product.checkout');
});

Route::prefix('order')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('order');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authorizeUser'])->name('login.store');

Route::get('/daftar', [AuthController::class, 'register'])->name('register');
Route::post('/pendaftaran', [AuthController::class, 'registerStore'])->name('register.store');

Route::prefix('profile')->group(function () {
    Route::get('address', [ProfileController::class, 'address'])->name('profile.address');
});


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::redirect('/admin', '/admin/dashboard');
