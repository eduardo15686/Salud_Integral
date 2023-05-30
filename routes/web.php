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

Route::get('/especialista', function () {
    return view('panels.especialistas.informacion');
})->name('especialista')->middleware('auth')->middleware('Permisos:1-2');

Route::get('/usuarios/administrar', function () {
    return view('panels.usuarios.administrar');
})->name('administrar')->middleware('auth')->middleware('Permisos:1-5');

Route::get('/usuarios/perfilador', function () {
    return view('panels.usuarios.perfilador');
})->name('perfilador')->middleware('auth')->middleware('Permisos:1-6');

Route::get('/usuarios/servicios', function () {
    return view('panels.usuarios.servicios');
})->name('servicios')->middleware('auth')->middleware('Permisos:1-10');