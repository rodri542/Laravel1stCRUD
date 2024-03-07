<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pokemon;

class pokemonController extends Controller
{

// Definición de la función index en el controlador
function index() {
    // Consulta a la base de datos para obtener todos los registros de la tabla 'pokemones'
    $pokemones = Pokemon::all();

    // Log de la cantidad de registros obtenidos
    \Log::info('Número de registros de pokemones: ' . $pokemones->count());


    // Devuelve la vista 'bienvenido' y pasa los datos de los pokemones utilizando una clave llamada 'buenas'
    return view(
        'bienvenido',
        [
            'pokemones' => $pokemones  // La clave 'pokemones' se asocia a los datos de los pokemones
        ]
    );




}


    
}
