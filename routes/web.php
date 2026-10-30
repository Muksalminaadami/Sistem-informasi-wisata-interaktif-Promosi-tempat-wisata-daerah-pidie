<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;

// Halaman Utama Publik
Route::get('/', [PublicController::class, 'index'])->name('home');

// Halaman Login Admin (Ditambahkan agar saat mengakses /admin tidak 404)
Route::get('/admin', [AdminController::class, 'showLoginForm'])->name('admin.login.form');

// Proses Login Admin
Route::post('/admin-login', [AdminController::class, 'login'])->name('admin.login');

// Protected Routes Admin (Menggunakan middleware 'auth' standar yang stabil)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/destinasi', [AdminController::class, 'storeDestinasi'])->name('admin.destinasi.store');
    Route::put('/admin/destinasi/{id}', [AdminController::class, 'updateDestinasi'])->name('admin.destinasi.update');
    Route::delete('/admin/destinasi/{id}', [AdminController::class, 'destroyDestinasi'])->name('admin.destinasi.destroy');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});