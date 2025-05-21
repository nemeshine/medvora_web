<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PasienAuthController;
use App\Http\Controllers\Api\AlarmApiController;

Route::post('/pasien/login', [PasienAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/pasien/logout', [PasienAuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/alarms', [AlarmApiController::class, 'index']);
    Route::post('/alarms/{id}/konfirmasi', [AlarmApiController::class, 'konfirmasi']);
});

});
