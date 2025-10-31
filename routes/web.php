<?php

use App\Http\Controllers\home_controller;
use App\Http\Controllers\Auth_Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home_rsph');
});

// Admin Route
Route::get('/dashboard', [App\Http\Controllers\AdminControl::class, 'index'])->name('admin.index');
Route::get('/manage-user', [App\Http\Controllers\AdminControl::class, 'manageUsers'])->name('admin.manage_user');
Route::get('/manage-pemilik', [App\Http\Controllers\AdminControl::class, 'managePemilik'])->name('admin.pemilik.manage_pemilik');
Route::get('/manage-jenis', [App\Http\Controllers\AdminControl::class, 'manageJenisHewan'])->name('admin.jenis_hewan.manage_jenis_hewan');
Route::get('/manage-pet', [App\Http\Controllers\AdminControl::class, 'managePets'])->name('admin.pet.manage_pet');
Route::get('/manage-role', [App\Http\Controllers\AdminControl::class, 'manageRoles'])->name('admin.role.manage_role');
Route::get('/manage-kategori', [App\Http\Controllers\AdminControl::class, 'manageKatTindakan'])->name('admin.tindakan.manage_tindakan');
Route::get('/manage-kategori-klinis', [App\Http\Controllers\AdminControl::class, 'manageKatKlinis'])->name('admin.kategori_klinis.manage_kategori_klinis');
Route::get('/manage-tindakan', [App\Http\Controllers\AdminControl::class, 'manageKat_tindakan'])->name('admin.kategori.manage_kategori');
