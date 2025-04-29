<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\DiagnosaPenyakitController;
use App\Http\Controllers\AlarmController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/login', [StaffAuthController::class, 'showLoginForm'])->name('login');

//Route::get('/login', [StaffAuthController::class, 'showLoginForm'])->name('staff.login.form');
Route::post('/login', [StaffAuthController::class, 'login'])->name('staff.login.process');
//Route::get('/logout', [StaffAuthController::class, 'logout'])->name('staff.logout');
Route::get('/logout', [StaffAuthController::class, 'logout'])->name('staff.logout');


Route::resource('pasien', PasienController::class);

Route::resource('obat', ObatController::class);

Route::resource('diagnosa', DiagnosaPenyakitController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/alarm', [AlarmController::class, 'index'])->name('alarm.index');
Route::get('/alarm/detail/{id}', [AlarmController::class, 'detail'])->name('alarm.detail');

Route::get('/riwayat', function() {
    return view('riwayat.index');
});

Route::get('/riwayat/{id}', function($id) {
    return view('riwayat.detail');
});






