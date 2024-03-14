<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\entrenador;


class entrenadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
    // Consulta a la base de datos para obtener todos los registros de la tabla 'pokemones'
    $entrenadores = entrenador::all();



    // Devuelve la vista 'bienvenido' y pasa los datos de los pokemones utilizando una clave llamada 'buenas'
    return view(
        'entrenadores',
        [
            'entrenadores' => $entrenadores  // La clave 'pokemones' se asocia a los datos de los pokemones
        ]
    );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
                
        $validated = $request->validate([
            "nombreEn" => "required|max:120",
            "edad" => "numeric",
            "ciudad" => "required|max:18",
        ]);

        $pokemon = entrenador::findOrNew($request->id);
        $pokemon->fill($validated);
        $pokemon->save();

        return redirect()->route('entrenadores.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        
        $validated = $request->validate([
            "id_entrenador" => "required",
        ]);
        
        $pokemon = pokemon::find($validated['id_pokemon']);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $pokemonf = entrenador::find($id);
        if($pokemonf) {
            $pokemonf->delete();
        }

        return redirect()->route('entrenadores.index');

    }
}
