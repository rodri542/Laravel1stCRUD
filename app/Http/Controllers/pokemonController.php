<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pokemon;

class pokemonController extends Controller
{

// Definición de la función index en el controlador
function index(Request $request) {
    // Consulta a la base de datos para obtener todos los registros de la tabla 'pokemones'
    $id_entrenador = $request->query('id');


    $pokemones = Pokemon::where('id_entrenador', $id_entrenador)->get();

    // Devuelve la vista 'bienvenido' y pasa los datos de los pokemones utilizando una clave llamada 'buenas'
    return view(
        'bienvenido',
        [
            'pokemones' => $pokemones,
            'id'=>$id_entrenador  // La clave 'pokemones' se asocia a los datos de los pokemones
        ]
    );

}


function store(Request $request) {
        
    $id_entrenador = $request->query('id');


    $validated = $request->validate([
        "nombre" => "required|max:120",
        "tipo" => "required|max:18",
        "region" => "required|max:18",
        "descripcion" => "required|max:120",
        "edad"=>"required|numeric",
        "peso"=>"required|numeric",
        "id_entrenador"=>"required|numeric",
    ]);

    $pokemon = pokemon::findOrNew($request->id);
    $pokemon->fill($validated);
    $pokemon->save();

    $id_entrenador = $request->query('id');

    return redirect()->back()->with('id', $validated['id_entrenador']);

    
}
    

function delete(Request $request){
        
        $validated = $request -> validate([
            "id_pokemon" => "required",       


        ]);

        $pokemonf = pokemon::find($validated['id_pokemon']);
        if($pokemonf) {
            $pokemonf->delete();
        }
        $id_entrenador = $request->query('id');


        return redirect()->back()->with('id', $id_entrenador);


}


function edit(Request $request){
        
    $validated = $request->validate([
        "id_pokemon" => "required",
    ]);
    
    $pokemon = pokemon::find($validated['id_pokemon']);


}


}
