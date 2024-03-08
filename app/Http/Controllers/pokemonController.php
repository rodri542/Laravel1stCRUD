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



    // Devuelve la vista 'bienvenido' y pasa los datos de los pokemones utilizando una clave llamada 'buenas'
    return view(
        'bienvenido',
        [
            'pokemones' => $pokemones  // La clave 'pokemones' se asocia a los datos de los pokemones
        ]
    );

}


function store(Request $request) {
        
    $validated = $request->validate([
        "nombre" => "required|max:120",
        "tipo" => "required|max:18",
        "region" => "required|max:18",
        "descripcion" => "required|max:120",
        "edad"=>"required|numeric",
        "peso"=>"required|numeric"
    ]);

    $pokemon = pokemon::findOrNew($request->id);
    $pokemon->fill($validated);
    $pokemon->save();

    return redirect()->route('bienvenido');



}
    
}
