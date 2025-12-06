<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JenisHewanController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\Role\ResepsionisController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Role\DokterControll;
use App\Http\Controllers\Role\AdminControl;
use App\Http\Controllers\Role\Pemilik;
use App\Http\Controllers\Role\Perawat;
use App\Http\Controllers\PerawatController;
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
    Route::get('/manage-user/{id}', [UserController::class, 'show'])->name('admin.user.show');

    Route::get('/manage-pemilik', [AdminControl::class, 'managePemilik'])->name('admin.pemilik.manage_pemilik');
    Route::post('/add-Pemilik', [PemilikController::class, 'store'])->name('admin.add_pemilik');

    Route::get('/manage-jenis', [AdminControl::class, 'manageJenisHewan'])->name('admin.jenis_hewan.manage_jenis_hewan');
    Route::post('/add-jenis', [JenisHewanController::class, 'store'])->name('admin.add_jenis_hewan');
    Route::delete('delete-jenis/{id}', [JenisHewanController::class, 'destroy'])->name('admin.delete_jenis_hewan');

    Route::get('/manage-pet', [AdminControl::class, 'managePets'])->name('admin.pet.manage_pet');

    Route::get('/manage-role', [AdminControl::class, 'manageRoles'])->name('admin.role.manage_role');

    Route::get('/manage-dokter', [AdminControl::class, 'manageDokter'])->name('admin.dokter.manage_dokter');
    Route::post('add-dokter', [DokterController::class, 'store'])->name('admin.dokter.add_dokter');
    Route::delete('delete-dokter/{id}', [DokterController::class, 'destroy'])->name('admin.dokter.delete_dokter');

    Route::get('/manage-perawat', [AdminControl::class, 'managePerawat'])->name('admin.perawat.manage_perawat');
    Route::post('add-perawat', [PerawatController::class, 'store'])->name('admin.perawat.add_perawat');

    Route::get('/manage-kategori', [AdminControl::class, 'manageKategori'])->name('admin.tindakan.manage_kategori');
    Route::get('/manage-kategori-klinis', [AdminControl::class, 'manageKat_klinis'])->name('admin.Klinis.manage_klinis');
    Route::get('/manage-tindakan', [AdminControl::class, 'manageKat_tindakan'])->name('admin.kategori.manage_tindakan');
});
// Resepsionis role
Route::middleware(['IsResepsionis'])->group(function () {
    Route::get('/resepsionis-dashboard', [ResepsionisController::class, 'index'])->name('resepsionis.index');
    Route::get('/regis-pet', [ResepsionisController::class, 'regisPet'])->name('resepsionis.regis-pet');
    Route::post('/regis-pet', [ResepsionisController::class, 'storePet'])->name('resepsionis.regis-pet.store');
    Route::get('/regis-pet/{id}/edit', [ResepsionisController::class, 'editPet'])->name('resepsionis.regis-pet.edit');
    Route::put('/regis-pet/{id}', [ResepsionisController::class, 'updatePet'])->name('resepsionis.regis-pet.update');
    Route::delete('/regis-pet/{id}', [ResepsionisController::class, 'deletePet'])->name('resepsionis.regis-pet.delete');

    Route::get('/regis-pemilik', [ResepsionisController::class, 'regisPemilik'])->name('resepsionis.regis-pemilik');
    Route::post('/regis-pemilik', [ResepsionisController::class, 'storePemilik'])->name('resepsionis.regis-pemilik.store');
    Route::get('/regis-pemilik/{id}/edit', [ResepsionisController::class, 'editPemilik'])->name('resepsionis.regis-pemilik.edit');
    Route::put('/regis-pemilik/{id}', [ResepsionisController::class, 'updatePemilik'])->name('resepsionis.regis-pemilik.update');
    Route::delete('/regis-pemilik/{id}', [ResepsionisController::class, 'deletePemilik'])->name('resepsionis.regis-pemilik.delete');

    Route::get('/temu-dokter', [ResepsionisController::class, 'temuDokter'])->name('resepsionis.temu.index');
    Route::get('/temu-dokter/create', [ResepsionisController::class, 'createTemuDokter'])->name('resepsionis.temu.create');
    Route::post('/temu-dokter', [ResepsionisController::class, 'storeTemuDokter'])->name('resepsionis.temu.store');
    Route::get('/temu-dokter/success/{id}', [ResepsionisController::class, 'successTemuDokter'])->name('resepsionis.temu.success');
    Route::get('/temu-dokter/{id}/edit', [ResepsionisController::class, 'editTemuDokter'])->name('resepsionis.temu.edit');
    Route::put('/temu-dokter/{id}', [ResepsionisController::class, 'updateTemuDokter'])->name('resepsionis.temu.update');
    Route::delete('/temu-dokter/{id}', [ResepsionisController::class, 'deleteTemuDokter'])->name('resepsionis.temu.delete');
});

// Dokter Role
Route::middleware(['IsDokter'])->group(function () {
    Route::get('/dokter-dashboard', [DokterControll::class, 'index'])->name('dokter.index');
    Route::get('/dokter/rekam', [DokterControll::class, 'rekam'])->name('dokter.rekam.rekam');
    Route::get('/dokter/rekam/{id}', [DokterControll::class, 'show'])->name('dokter.rekam.show');
});

// Pemilik Role
Route::middleware(['IsPemilik'])->group(function () {
    Route::get('/pemilik-dashboard', [Pemilik::class, 'index'])->name('pemilik.index');
});

// perawat role
Route::middleware(['IsPerawat'])->group(function () {
    Route::get('/perawat-dashboard', [Perawat::class, 'index'])->name('perawat.index');
    Route::get('/perawat-rekam', [Perawat::class, 'rekam'])->name('perawat.rekam');
    // create / store must be registered before the parameterized {id} route
    Route::get('/perawat-rekam/create', [Perawat::class, 'create'])->name('perawat.rekam.create');
    Route::post('/perawat-rekam', [Perawat::class, 'store'])->name('perawat.rekam.store');
    // show / edit / update for a specific rekam
    Route::get('/perawat-rekam/{id}', [Perawat::class, 'show'])->name('perawat.rekam.show');
    Route::get('/perawat-rekam/{id}/edit', [Perawat::class, 'edit'])->name('perawat.rekam.edit');
    Route::put('/perawat-rekam/{id}', [Perawat::class, 'update'])->name('perawat.rekam.update');
});
