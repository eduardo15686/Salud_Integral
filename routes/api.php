<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EspecialistaController;
use App\Http\Controllers\FotoController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->prefix('/especialista')->group(function () {
    Route::get('/obtenerFoto', [FotoController::class, 'obtenerFoto']);
    Route::post('/guardarEspecialista', [EspecialistaController::class, 'guardarEspecialista']);
    Route::post('/updateFoto', [FotoController::class, 'updateFoto']);
});
