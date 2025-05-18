<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PasienAuthController;

Route::post('/pasien/login', [PasienAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/pasien/logout', [PasienAuthController::class, 'logout']);
});
