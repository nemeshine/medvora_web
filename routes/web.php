<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\DiagnosaPenyakitController;
use App\Http\Controllers\AlarmController;
use App\Http\Controllers\RiwayatAlarmController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CetakController;


Route::get('/', function () {
    return view('landingpage.landing');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/login', [StaffAuthController::class, 'showLoginForm'])->name('login');

//Route::get('/login', [StaffAuthController::class, 'showLoginForm'])->name('staff.login.form');
Route::post('/login', [StaffAuthController::class, 'login'])->name('staff.login.process');
//Route::get('/logout', [StaffAuthController::class, 'logout'])->name('staff.logout');
Route::get('/logout', [StaffAuthController::class, 'logout'])->name('staff.logout');

Route::resource('staff', StaffController::class);



Route::resource('pasien', PasienController::class);

Route::resource('obat', ObatController::class);

Route::resource('diagnosa', DiagnosaPenyakitController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('alarm')->group(function () {
    Route::get('/', [AlarmController::class, 'index'])->name('alarm.index');
    Route::get('/detail/{id_pasien}', [AlarmController::class, 'detail'])->name('alarm.detail');
    Route::get('/alarm/create', [AlarmController::class, 'create'])->name('alarm.create');
    Route::post('/alarm/store', [AlarmController::class, 'store'])->name('alarm.store');
    Route::put('/alarm/{id}', [AlarmController::class, 'update'])->name('alarm.update');
    

    
});

Route::get('/riwayat', [RiwayatAlarmController::class, 'index'])->name('riwayat.index');
Route::get('/riwayat/{id_pasien}', [RiwayatAlarmController::class, 'detail'])->name('riwayat.detail');

Route::post('/staff/verify-password', [StaffController::class, 'verifyPassword'])->name('staff.verify-password');

Route::get('/cetak_data', [CetakController::class, 'index'])->name('cetak.index');
Route::get('/cetak_data/{id}/pdf', [CetakController::class, 'cetak'])->name('cetak.pdf');








