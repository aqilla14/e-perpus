<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Htpp\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PenulisController;

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

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');

Route::get('/anggota/dashboard', function () {
    return view('anggota.dashboard');
})->middleware(['auth', 'role:anggota'])->name('anggota.dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/buku', [BukuController::class, 'index']);
    Route::get('/buku/create', [BukuController::class, 'create']);
    Route::post('/buku/store', [BukuController::class, 'store']);
    Route::get('/buku/{id}/edit', [BukuController::class, 'edit']);
    Route::post('/buku/{id}/update', [BukuController::class, 'update']);
    Route::get('/buku/{id}/delete', [BukuController::class, 'destroy']);

    Route::get('/penulis', [PenulisController::class, 'index']);
    Route::get('/penulis/create', [PenulisController::class, 'create']);
    Route::post('/penulis/store', [PenulisController::class, 'store']);
    Route::get('/penulis/{id}/edit', [PenulisController::class, 'edit']);
    Route::post('/penulis/{id}/update', [PenulisController::class, 'update']);
    Route::get('/penulis/{id}/delete', [PenulisController::class, 'destroy']);

    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::get('/kategori/create', [KategoriController::class, 'create']);
    Route::post('/kategori/store', [KategoriController::class, 'store']);
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']);
    Route::post('/kategori/{id}/update', [KategoriController::class, 'update']);
    Route::get('/kategori/{id}/delete', [KategoriController::class, 'destroy']);

    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
});

Route::middleware(['auth', 'role:anggota'])->group(function () {

    Route::get('/buku', [BukuController::class, 'index']);
    Route::post('/peminjaman/store', [PeminjamanController::class, 'store']);
    Route::post('/pengembalian/{id}', [PengembalianController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
