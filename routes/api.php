<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\BancoController;
use App\Http\Controllers\Api\V1\EmailController;
use App\Http\Controllers\Api\V1\MovimientoController;
use Illuminate\Support\Facades\Route;

Route::post('/v1/login', [AuthController::class, 'login']);
Route::post('/v1/register', [AuthController::class, 'register']);

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('movimientos', [MovimientoController::class, 'index']);
    Route::apiResource('emails', EmailController::class);
    Route::apiResource('bancos', BancoController::class);
});
