<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;

// Halaman Utama
Route::get('/', [LaporanController::class, 'index'])->name('home');

// --- AUTH SYSTEM ---

// 1. Rute Warga (Tombol Masuk)
Route::get('/login', [LaporanController::class, 'showLogin'])->name('login');

// 2. Rute Admin
Route::get('/admin/login', [LaporanController::class, 'showLoginAdmin'])->name('admin.login');

// 3. Proses Login & Logout
Route::post('/login', [LaporanController::class, 'postLogin'])->name('post.login');
Route::get('/logout', [LaporanController::class, 'logout'])->name('logout');


// SEMUA YANG BUTUH LOGIN
Route::middleware(['auth'])->group(function () {

    // FITUR WARGA
    Route::get('/tambah', [LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/simpan-laporan', [LaporanController::class, 'store'])->name('laporan.store');
    Route::get('/profil', [LaporanController::class, 'profil'])->name('laporan.profil');

    // FITUR ADMIN
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [LaporanController::class, 'adminDashboard'])->name('admin.dashboard');

        // Update status laporan
        Route::patch('/laporan/proses/{id}', [LaporanController::class, 'prosesLaporan'])->name('admin.laporan.proses');
        Route::patch('/laporan/selesai/{id}', [LaporanController::class, 'updateLaporan'])->name('admin.laporan.update');
        Route::delete('/laporan/{id}', [LaporanController::class, 'destroyLaporan'])->name('admin.laporan.destroy');

        // Data Penduduk (CRUD)
        Route::get('/warga', [LaporanController::class, 'dataWarga'])->name('admin.warga');
        Route::post('/warga', [LaporanController::class, 'storeWarga'])->name('admin.warga.store');
        Route::patch('/warga/{id}', [LaporanController::class, 'updateWarga'])->name('admin.warga.update');
        Route::delete('/warga/{id}', [LaporanController::class, 'destroyWarga'])->name('admin.warga.destroy');
    });

});