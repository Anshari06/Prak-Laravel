<?php

use App\Http\Controllers\home_controller;
use App\Http\Controllers\Auth_Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home_rsph');
});

Route::get('/home', [home_controller::class, 'index'])->name('home_rsph');

Route::get('/login', [Auth_Controller::class, 'login'])->name('login');

Route::get('/struktur', [home_controller::class, 'struktur'])->name('struktur');

// Admin Route
Route::get('/manage-user', [App\Http\Controllers\AdminControl::class, 'manageUsers'])->name('admin.manage_user');
Route::get('/manage-jenis-hewan', [App\Http\Controllers\JenisHewanController::class, 'index'])->name('admin.jenis_hewan.index');