<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\RiwayatPeminjamanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name("dashboard");

// Data Laporan
Route::get('/data-laporan', [LaporanController::class, 'index'])->name('dataLaporan');

// Data Buku
Route::get('/data-buku', [BukuController::class, 'index'])->name('dataBuku');
Route::get('/buku/create', [BukuController::class, 'create'])->name('createBuku');
Route::post('/buku/store', [BukuController::class, 'store'])->name('storeBuku');
Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('editBuku');
Route::put('/buku/{id}', [BukuController::class, 'update'])->name('updateBuku');
Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('deleteBuku');

// Data Anggota
Route::get('/data-anggota', [AnggotaController::class, 'index'])->name('dataAnggota');
Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('createAnggota');
Route::post('/anggota/store', [AnggotaController::class, 'store'])->name('storeAnggota');
Route::get('/anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('editAnggota');
Route::put('/anggota/update/{id}', [AnggotaController::class, 'update'])->name('updateAnggota');
Route::delete('/anggota/delete/{id}', [AnggotaController::class, 'destroy'])->name('deleteAnggota');

// Data Peminjaman
Route::get('/data-peminjaman', [PinjamanController::class, 'index'])->name('dataPeminjaman');

// Data Pengembalian
Route::get('/data-pengembalian', [PengembalianController::class, 'index'])->name('dataPengembalian');

// Katalog Buku
Route::get('/katalog-buku', [KatalogController::class, 'index'])->name('katalogBuku');

// Riwayat Peminjaman
Route::get('/riwayat-peminjaman', [RiwayatPeminjamanController::class, 'index'])->name('riwayatPeminjaman');
