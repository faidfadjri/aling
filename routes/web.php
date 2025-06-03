<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/backend/beranda', [HomeController::class, 'index'])->name('homepage')->middleware('auth');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/daftar', [AuthController::class, 'register'])->name('register');


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'authorizeUser'])->name('login.post');
Route::redirect('/admin', '/admin/dashboard');
