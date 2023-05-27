<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    if (Auth::check()) {
        return Redirect::to('/home');
    }
    return view('auth.login');
    // return view('welcome');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth')->middleware('Permisos:1-1');


Route::get('/especialista', function () {
    return view('panels.especialistas.informacion');
})->name('especialista')->middleware('auth')->middleware('Permisos:1-2');



Route::get('/configuracion/perfil-usuario', function () {
    return view('panels.configuracion.usuario');
})->name('usuario')->middleware('auth')->middleware('Permisos:1-10');

Route::get('/configuracion/amortizacion', function () {
    return view('panels.configuracion.amortizacion');
})->name('amortizacion')->middleware('auth')->middleware('Permisos:1-16');

Route::get('/clientes', function () {
    return view('panels.clientes.index');
})->name('cliente')->middleware('auth')->middleware('Permisos:1-8');

Route::get('/empresas', function () {
    return view('panels.empresas.index');
})->name('empresa')->middleware('auth')->middleware('Permisos:1-11');

Route::get('/control-creditos', function () {
    return view('panels.control-creditos.index');
})->name('control-credito')->middleware('auth')->middleware('Permisos:1-13');

Route::get('/creditos-activos', function () {
    return view('panels.creditos-activos.index');
})->name('creditos-activos')->middleware('auth')->middleware('Permisos:1-13');

Route::get('/validacion-creditos', function () {
    return view('panels.validacion-creditos.index');
})->name('validacion-creditos')->middleware('auth')->middleware('Permisos:1-25');

Route::get('/lista-retencion', function () {
    return view('panels.lista-retencion.index');
})->name('lista-retencion')->middleware('auth')->middleware('Permisos:1-33');

Route::get('/seguimientos-pagos', function () {
    return view('panels.seguimientos-pagos.index');
})->name('seguimientos-pagos')->middleware('auth')->middleware('Permisos:1-35');

Route::get('/lista-pagos', function () {
    return view('panels.lista-pagos.index');
})->name('lista-pagos')->middleware('auth')->middleware('Permisos:1-25');

Route::get('/creditos-en-covertura', function () {
    return view('panels.creditos-en-covertura.index');
})->name('creditos-en-covertura')->middleware('auth')->middleware('Permisos:1-27');

Route::get('/compra-deuda', function () {
    return view('panels.compra-deuda.index');
})->name('compra-deuda')->middleware('auth')->middleware('Permisos:1-17');

Route::get('/consulta-rapida', function () {
    return view('panels.consulta-rapida.index');
})->name('consulta-rapida')->middleware('auth')->middleware('Permisos:1-14');

Route::get('/usuarios/administrar', function () {
    return view('panels.usuarios.administrar');
})->name('administrar')->middleware('auth')->middleware('Permisos:1-39');

Route::get('/usuarios/perfilador', function () {
    return view('panels.usuarios.perfilador');
})->name('perfilador')->middleware('auth')->middleware('Permisos:1-43');

Route::get('/configuracion/periodos', function () {
    return view('panels.configuracion.periodos');
})->name('periodos')->middleware('auth')->middleware('Permisos:1-48');