<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. Rute Sisi Pelanggan (Customer / Kasir Publik)
Route::get('/', [OrderController::class, 'index'])->name('customer.index');

// Middleware 'auth' memastikan pelanggan harus login saat checkout pemesanan cucian
Route::post('/checkout', [OrderController::class, 'store'])->middleware('auth')->name('customer.checkout');

// 2. Rute Dashboard Rekap Pesanan Admin
Route::get('/dashboard', [OrderController::class, 'adminDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 3. Rute Grup Terproteksi Admin (Wajib Login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Update status cucian laundry (Pending -> Proses -> Selesai -> Batal)
    Route::patch('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    // CRUD Master Layanan & Paket Laundry
    Route::resource('/admin/packages', PackageController::class);
});

// Panggil rute login/logout bawaan Laravel Breeze
require __DIR__.'/auth.php';