<?php


use App\Http\Controllers\ExpedienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EspecialistaController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\PacienteController;

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
    Route::post('/updatePassword', [EspecialistaController::class, 'updatePassword']);
});

Route::middleware('auth:sanctum')->prefix('/usuarios')->group(function () {
    Route::post('/nuevoUsuario', [UsuarioController::class, 'nuevoUsuario']);
    Route::get('/getUsuarios', [UsuarioController::class, 'getUsuarios']);
    Route::post('/deleteUsuario', [UsuarioController::class, 'deleteUsuario']);
});

Route::middleware('auth:sanctum')->prefix('/agendas')->group(function () {
    Route::post('/generarAgenda', [AgendaController::class, 'generarAgenda']);
    Route::post('/verAgenda', [AgendaController::class, 'verAgenda']);
    Route::post('/aceptarProspecto', [AgendaController::class, 'aceptarProspecto']);
    Route::post('/rechazarProspecto', [AgendaController::class, 'rechazarProspecto']);
    Route::post('/inhabilitarHora', [AgendaController::class, 'inhabilitarHora']);
    Route::get('/getPacientes', [AgendaController::class, 'getPacientes']);
    Route::post('/agendarPaciente', [AgendaController::class, 'agendarPaciente']);
    Route::post('/habilitarHora', [AgendaController::class, 'habilitarHora']);
    Route::post('/agendarHoraEspecial', [AgendaController::class, 'agendarHoraEspecial']);
});

Route::middleware('auth:sanctum')->prefix('/horario')->group(function () {
    Route::get('/obtenerDias', [HorarioController::class, 'obtenerDias']);
    Route::post('/generarHorario', [HorarioController::class, 'generarHorario']);
    Route::post('/modificarHorario', [HorarioController::class, 'modificarHorario']);
    Route::get('/getHoras', [HorarioController::class, 'getHoras']);
    Route::get('/tiempoConsulta', [HorarioController::class, 'tiempoConsulta']);
    Route::get('/getHorario', [HorarioController::class, 'getHorario']);

});

Route::middleware('auth:sanctum')->prefix('/pacientes')->group(function () {
    Route::get('/getPacientes', [PacienteController::class, 'getPacientes']);
    Route::post('/guardarPaciente', [PacienteController::class, 'guardarPaciente']);
    Route::get('/getPaciente/{id}', [PacienteController::class, 'getPaciente']);
    Route::post('/editarPaciente', [PacienteController::class, 'editarPaciente']);
    Route::post('/eliminarPaciente', [PacienteController::class, 'eliminarPaciente']);

});


Route::middleware('auth:sanctum')->prefix('/servicios')->group(function () {
    Route::get('/getServicios', [ServicioController::class, 'getServicios']);
    Route::get('/getCategorias/{id}', [ServicioController::class, 'getCategorias']);
    Route::get('/getSubCategorias/{id}', [ServicioController::class, 'getSubCategorias']);
    Route::post('/nuevoServicio', [ServicioController::class, 'nuevoServicio']);
    Route::post('/nuevaCategoria', [ServicioController::class, 'nuevaCategoria']);
    Route::post('/nuevaSubCategoria', [ServicioController::class, 'nuevaSubCategoria']);
    Route::post('/deleteServicio', [ServicioController::class, 'deleteServicio']);
});

Route::middleware('auth:sanctum')->prefix('/perfiles')->group(function () {
    Route::get('/getPerfiles', [PerfilController::class, 'getPerfiles']);
});

Route::middleware('auth:sanctum')->prefix('/expedientes')->group(function () {
    Route::post('/guardarExpediente', [ExpedienteController::class, 'guardarExpediente']);
    Route::get('/getExpedientes/{id}', [ExpedienteController::class, 'getExpedientes']);

});


Route::prefix('/citas')->group(function () {
    Route::post('/getEspecialistas', [CitaController::class, 'getEspecialistas']);
    Route::get('/obtenerLinkFoto', [CitaController::class, 'obtenerLinkFoto']);
    Route::post('/agendarCita', [CitaController::class, 'agendarCita']);
    Route::get('/getSubCategorias', [CitaController::class, 'getSubCategorias']);
});