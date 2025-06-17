<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
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
Route::get('product', [PageController::class, 'product'])->name('product');


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authorizeUser'])->name('login.store');

Route::get('/daftar', [AuthController::class, 'register'])->name('register');
Route::post('/pendaftaran', [AuthController::class, 'registerStore'])->name('register.store');





Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::redirect('/admin', '/admin/dashboard');
