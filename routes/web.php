<?php

use App\Http\Controllers\home_controller;
use App\Http\Controllers\Auth_Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [home_controller::class, 'index'])->name('home_rsph');

Route::get('/login', [Auth_Controller::class, 'login'])->name('login');

Route::get('/struktur', [home_controller::class, 'struktur'])->name('struktur');

Route::get('/layanan', [home_controller::class, 'layanan'])->name('layanan');

// Admin Route
Route::get('/admin', [App\Http\Controllers\AdminControl::class, 'index'])->name('admin.index');
