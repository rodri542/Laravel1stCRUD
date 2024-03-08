<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pokemonController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts/start');
});

// Definición de la ruta 'materias'
Route::any(
    'bienvenido', // URL de la ruta, en este caso, '/bienvenido'
    [pokemonController::class, 'index'] // Controlador y método a los que se dirige la solicitud en el controlador
)->name('bienvenido'); // Nombre de la ruta, útil para referenciarla en otras partes de la aplicación


// Definición de la ruta 'materias'
Route::post(
    'bienvenido-store', // URL de la ruta, en este caso, '/bienvenido'
    [pokemonController::class, 'store'] // Controlador y método a los que se dirige la solicitud en el controlador
)->name('bienvenido.store'); // Nombre de la ruta, útil para referenciarla en otras partes de la aplicación