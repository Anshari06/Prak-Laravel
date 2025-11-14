<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JenisHewanController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\Role\ResepsionisController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Role\DokterControll;
use App\Http\Controllers\Role\AdminControl;
use App\Http\Controllers\Role\Pemilik;
use App\Http\Controllers\Role\Perawat;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home_rsph');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Auth::routes();
// admin role
Route::middleware(['IsAdministrator'])->group(function () {
    Route::get('/admin-dashboard', [AdminControl::class, 'index'])->name('admin.index');
    // crud
    Route::get('/manage-user', [AdminControl::class, 'manageUsers'])->name('admin.manage_user');
    Route::post('/add-user', [UserController::class, 'stored'])->name('admin.add_user');

    Route::get('/manage-pemilik', [AdminControl::class, 'managePemilik'])->name('admin.pemilik.manage_pemilik');
    Route::post('/add-Pemilik', [PemilikController::class, 'stored'])->name('admin.add_pemilik');

    Route::get('/manage-jenis', [AdminControl::class, 'manageJenisHewan'])->name('admin.jenis_hewan.manage_jenis_hewan');
    Route::post('/add-jenis', [JenisHewanController::class, 'store'])->name('admin.add_jenis_hewan');
    Route::delete('delete-jenis/{id}', [JenisHewanController::class, 'destroy'])->name('admin.delete_jenis_hewan');

    Route::get('/manage-pet', [AdminControl::class, 'managePets'])->name('admin.pet.manage_pet');
    Route::get('/manage-role', [AdminControl::class, 'manageRoles'])->name('admin.role.manage_role');
    Route::get('/manage-kategori', [AdminControl::class, 'manageKategori'])->name('admin.tindakan.manage_kategori');
    Route::get('/manage-kategori-klinis', [AdminControl::class, 'manageKat_klinis'])->name('admin.Klinis.manage_klinis');
    Route::get('/manage-tindakan', [AdminControl::class, 'manageKat_tindakan'])->name('admin.kategori.manage_tindakan');
});
// Resepsionis role
Route::middleware(['IsResepsionis'])->group(function () {
    Route::get('/resepsionis-dashboard', [ResepsionisController::class, 'index'])->name('resepsionis.index');
    Route::get('/regis-pet', [ResepsionisController::class, 'regisPet'])->name('resepsionis.regis-pet');
});

// Dokter Role
Route::middleware(['IsDokter'])->group(function () {
    Route::get('/dokter-dashboard', [DokterControll::class, 'index'])->name('dokter.index');
    Route::get('/dokter/rekam', [DokterControll::class, 'index'])->name('dokter.rekam.rekam');
});

// Pemilik Role
Route::middleware(['IsPemilik'])->group(function () {
    Route::get('/pemilik-dashboard', [Pemilik::class, 'index'])->name('pemilik.index');
});

// perawat role
Route::middleware(['IsPerawat'])->group(function () {
    Route::get('/perawat-dashboard', [Perawat::class, 'index'])->name('perawat.index');
    Route::get('/detail-rekam', [Perawat::class, 'detail'])->name('perawat.detail_rekam');
});
