<?php

use App\Http\Controllers\AlatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogAktivitasController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register', [AuthController::class, 'tampilRegister'])->name('register.tampil');
Route::post('/register/submit', [AuthController::class, 'submitRegister'])->name('register.submit');
Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // === ADMIN ONLY ===
    Route::middleware('role:admin')->group(function () {
        // user
        Route::get('/users', [UserController::class, 'index'])->name('user.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/users', [UserController::class, 'store'])->name('user.store');

        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/users/{id}', [UserController::class, 'delete'])->name('user.delete');

        // kategori
        Route::get('/kategoris', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategoris/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/kategoris', [KategoriController::class, 'store'])->name('kategori.store');

        Route::get('/kategoris/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/kategoris/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategoris/{id}', [KategoriController::class, 'delete'])->name('kategori.delete');

        // Log Aktivitas
        Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])->name('log_aktivitas.index');
    });

    // === ADMIN & PETUGAS ===
    Route::middleware('role:admin,petugas')->group(function () {
        // alat (Write)
        Route::get('/alats/create', [AlatController::class, 'create'])->name('alat.create');
        Route::post('/alats', [AlatController::class, 'store'])->name('alat.store');
        Route::get('/alats/{id}/edit', [AlatController::class, 'edit'])->name('alat.edit');
        Route::put('/alats/{id}', [AlatController::class, 'update'])->name('alat.update');
        Route::delete('/alats/{id}', [AlatController::class, 'delete'])->name('alat.delete');

        // peminjaman (Approve/Reject/Edit/Delete)
        Route::get('peminjamans/{id}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
        Route::put('/peminjamans/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
        Route::delete('/peminjamans/{id}', [PeminjamanController::class, 'delete'])->name('peminjaman.delete');
        Route::put('/peminjamans/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
        Route::put('/peminjamans/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');

        // pengembalian (Edit/Delete)
        Route::get('/pengembalians/{id}/edit', [PengembalianController::class, 'edit'])->name('pengembalian.edit');
        Route::put('/pengembalians/{id}', [PengembalianController::class, 'update'])->name('pengembalian.update');
        Route::delete('/pengembalians/{id}', [PengembalianController::class, 'destroy'])->name('pengembalian.destroy');
    });

    // === ALL ROLES (Admin, Petugas, Peminjam) ===
    Route::middleware('role:admin,petugas,peminjam')->group(function () {
        // alat (Read)
        Route::get('/alats', [AlatController::class, 'index'])->name('alat.index');

        // peminjaman (Read, Create)
        Route::get('/peminjamans', [PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::get('/peminjamans/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
        Route::post('peminjamans', [PeminjamanController::class, 'store'])->name('peminjaman.store');
        
        // REPORT (PDF) - Placed securely
        Route::middleware('role:admin,petugas')->group(function(){
            Route::get('/peminjaman/cetak', [PeminjamanController::class, 'print'])->name('peminjaman.print');
            Route::get('/pengembalian/cetak', [PengembalianController::class, 'print'])->name('pengembalian.print');
        });

        // pengembalian (Read, Create)
        Route::get('/pengembalians', [PengembalianController::class, 'index'])->name('pengembalian.index');
        Route::get('/pengembalians/create/{peminjamen_id}', [PengembalianController::class, 'create'])->name('pengembalian.create');
        Route::post('/pengembalians', [PengembalianController::class, 'store'])->name('pengembalian.store');
    });
});

