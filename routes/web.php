<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\PasienController;


// Route untuk menampilkan form login staff
Route::get('/login', [StaffAuthController::class, 'showLoginForm'])->name('staff.login.form');

// Route untuk memproses login staff
Route::post('/login', [StaffAuthController::class, 'login'])->name('staff.login.process');

// Route untuk logout staff (opsional)
Route::get('/logout', [StaffAuthController::class, 'logout'])->name('staff.logout');

Route::resource('pasien', PasienController::class);

Route::get('/landing', function () {
    return view('landingpage.landing');
});


