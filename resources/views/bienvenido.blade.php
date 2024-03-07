@extends('layouts.main')

@section('contenido')

{{-- Se muestra la lista de errores --}}
@if ($errors->any())
<div class="w-full bg-yellow-100 text-red-500 italic">
    <ul class="max-w-md space-y-1 list-disc list-inside">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if ($pokemones->isEmpty())
<p class="text-center text-white">No hay ningún Pokémon registrado.</p>


@else
<div class="flex justify-center items-center h-screen">
    <div class="flex flex-wrap">
        @foreach ($pokemones as $pk)
        <div class="max-w-sm flex-initial justify-items-center shadow-lg border-stone-50 bg-orange-300 p-2 rounded-md border-2 m-3">
            <div class="px-6 py-4 ">
                <!-- Nombre del Pokémon -->
                <div class="font-bold text-xl mb-2">{{ $pk->nombre }}</div>
                <!-- Otros campos del Pokémon -->
                <p class="text-gray-700 text-base">
                    Tipo: {{ $pk->tipo }} <br>
                    Región: {{ $pk->region }} <br>
                    Descripción: {{ $pk->descripcion }} <br>
                    Edad: {{ $pk->edad }} <br>
                    Peso: {{ $pk->peso }}<br>
                    {{$pk->count()}}
                </p>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endif


@endsection