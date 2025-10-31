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
Route::get('/manage-jenis-hewan', [App\Http\Controllers\JenisHewanController::class, 'index'])->name('admin.jenis_hewan.index');