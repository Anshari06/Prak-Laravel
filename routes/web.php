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