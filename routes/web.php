<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Login\AuthController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Rute untuk memproses login pengguna
Route::post('/login', [AuthController::class, 'login']);

// Rute untuk keluar dari sesi pengguna
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Rute untuk dashboard
Route::get('/dashboard', function () {
    // Pastikan pengguna yang mengakses rute ini sudah terotentikasi
    if (auth()->check()) {
        // Redirect ke dashboard admin atau author sesuai peran (role) pengguna
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->isAuthor()) {
            return redirect()->route('admin.dashboard');
        }
    }

    // Jika pengguna belum terotentikasi, redirect ke halaman login
    return redirect()->route('login');
});

// Rute untuk dashboard admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
Route::resource('posts', PostController::class);
