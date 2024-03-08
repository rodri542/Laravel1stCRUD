@extends('layouts.main')

@section('contenido')

{{-- Se muestra la lista de errores --}}
@if ($errors->any())
<div class="w-full  text-red-500 italic">
    <ul class="max-w-md space-y-1 list-disc list-inside">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Muestra todos los registros uno por uno o si no encuentra muestra el mensaje --}}
@if ($pokemones->isEmpty())
<p class="text-center text-white">No hay ningún Pokémon registrado.</p>
@else
<div class="flex justify-center items-center p-36"> 
    <div class="flex flex-wrap">
        @foreach ($pokemones as $pk)
        <div class="max-w-sm flex-initial justify-items-center shadow-lg border-stone-50 bg-orange-300 p-2 rounded-md border-2 m-3">
            <div class="px-6 py-4 w-40">
                <!-- Nombre del Pokémon -->
                <div class="font-bold text-xl mb-2">{{ $pk->nombre }}</div>
                <!-- Otros campos del Pokémon -->
                <p class="text-gray-700 text-base">
                    Tipo: {{ $pk->tipo }} <br>
                    Región: {{ $pk->region }} <br>
                    Descripción: {{ $pk->descripcion }} <br>
                    Edad: {{ $pk->edad }} <br>
                    Peso: {{ $pk->peso }}<br>

                </p>
            </div>

        </div>
        @endforeach
    </div>
</div>
@endif

<form action="	{{ route('bienvenido.store') }}" method="post" class= " flex flex-wrap flex-row flex-coljustify-items-center justify-center content-center place-content-center">
    @csrf
    <div class=" bg-red-200 p-3 rounded-md justify-center  place-items-center flex flex-col mb-3">
        <p class="text-black text-sm">REGISTRAR UN NUEVO POKEMON</p>
        <div class="p-1 col-span-6 lg:col-span-1">
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre')}} "  placeholder="Ingresa el nombre del pokemon" class="p-1.5 rounded-md border-2 border-gray-800" required >
        </div>
        <div class="p-1 col-span-6 lg:col-span-1">
            <input type="text" id="tipo" name="tipo" value="{{ old('tipo')}} "  placeholder="Ingresa el tipo del pokemon" class="p-1.5 rounded-md border-2 border-gray-800" required >
        </div>
        <div class="p-1 col-span-6 lg:col-span-1">
            <input type="text" id="region" name="region" value="{{ old('region')}} "  placeholder="Ingresa la region del pokemon" class="p-1.5 rounded-md border-2 border-gray-800" required >
        </div>
        <div class="p-1 col-span-6 lg:col-span-1">
            <input type="text" id="descripcion" name="descripcion" value="{{ old('descripcion')}} "  placeholder="Ingresa la descripcion del pokemon" class="p-1.5 rounded-md border-2 border-gray-800" required >
        </div>
        <div class="p-1 col-span-6 lg:col-span-1">
            <input type="number" id="edad" name="edad" value="{{ old('edad')}} "  placeholder="Ingresa la edad del pokemon" class="p-1.5 rounded-md border-2 border-gray-800" required >
        </div>
        <div class="p-1 col-span-6 lg:col-span-1">
            <input type="number" id="peso" name="peso" value="{{ old('peso')}} "  placeholder="Ingresa el peso del pokemon" class="p-1.5 rounded-md border-2 border-gray-800" required >
        </div>  
        <div class="p-1 col-span-6 lg:col-span-1">
            <button type="submit" class="p-1.5 rounded-lg bg-indigo-600 text-white shadow-lg">Guardar</button>
        </div>
    </div>

</form>









@endsection