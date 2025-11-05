<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth_Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Admin Route
Route::get('/manage-user', [App\Http\Controllers\AdminControl::class, 'manageUsers'])->name('admin.manage_user');
Route::get('/manage-pemilik', [App\Http\Controllers\AdminControl::class, 'managePemilik'])->name('admin.pemilik.manage_pemilik');
Route::get('/manage-jenis', [App\Http\Controllers\AdminControl::class, 'manageJenisHewan'])->name('admin.jenis_hewan.manage_jenis_hewan');
Route::get('/manage-pet', [App\Http\Controllers\AdminControl::class, 'managePets'])->name('admin.pet.manage_pet');
Route::get('/manage-role', [App\Http\Controllers\AdminControl::class, 'manageRoles'])->name('admin.role.manage_role');
Route::get('/manage-kategori', [App\Http\Controllers\AdminControl::class, 'manageKategori'])->name('admin.tindakan.manage_kategori');
Route::get('/manage-kategori-klinis', [App\Http\Controllers\AdminControl::class, 'manageKat_klinis'])->name('admin.Klinis.manage_klinis');
Route::get('/manage-tindakan', [App\Http\Controllers\AdminControl::class, 'manageKat_tindakan'])->name('admin.kategori.manage_tindakan');

Route::get('/login', [LoginController::class, 'ShowLoginForm'])->name('login');
Route::get('/dashboard', [App\Http\Controllers\AdminControl::class, 'index'])->name('admin.index');

Route::get('/', function () {
    return view('home_rsph');
});
// Route::middleware(['guest'])->group(function () {
    
// });

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::middleware(['auth'])->group(function () {
// });

