<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EspecialistaController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\PerfilController;

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
    Route::get('/obtenerLinkFoto', [FotoController::class, 'obtenerLinkFoto']);
    // Route::get('/obtenerFoto', [FotoController::class, 'obtenerFoto']);
    Route::post('/updateFoto', [FotoController::class, 'updateFoto']);
    Route::get('/getInfoEspecialista', [EspecialistaController::class, 'getInfoEspecialista']);
    Route::post('/guardarEspecialista', [EspecialistaController::class, 'guardarEspecialista']);
    Route::post('/editarEspecialista', [EspecialistaController::class, 'editarEspecialista']);
    Route::get('/getSubCategorias', [EspecialistaController::class, 'getSubCategorias']);
});

Route::middleware('auth:sanctum')->prefix('/usuarios')->group(function () {
    Route::post('/nuevoUsuario', [UsuarioController::class, 'nuevoUsuario']);
    Route::get('/getUsuarios', [UsuarioController::class, 'getUsuarios']);
    Route::post('/deleteUsuario', [UsuarioController::class, 'deleteUsuario']);
});

Route::middleware('auth:sanctum')->prefix('/servicios')->group(function () {
    Route::get('/getServicios', [ServicioController::class, 'getServicios']);
    Route::get('/getCategorias/{id}', [ServicioController::class, 'getCategorias']);
    Route::get('/getSubCategorias/{id}', [ServicioController::class, 'getSubCategorias']);
    Route::post('/nuevoServicio', [ServicioController::class, 'nuevoServicio']);
    Route::post('/nuevaCategoria', [ServicioController::class, 'nuevaCategoria']);
    Route::post('/nuevaSubCategoria', [ServicioController::class, 'nuevaSubCategoria']);
});

Route::middleware('auth:sanctum')->prefix('/perfiles')->group(function () {
    Route::get('/getPerfiles', [PerfilController::class, 'getPerfiles']);
});