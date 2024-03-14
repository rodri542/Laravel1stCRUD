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



    @if ($entrenadores->isEmpty())
        
    <h1 class="text-gray-50">Aun no hay entrenadores registrados</h1>
    
    @else
            {{-- Listado en Tabla de materias --}}
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-500">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Ciudad</th>
                        <th>Pokemones</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entrenadores as $m)
                        <tr class="border-b-2 border-gray-300 {{ $loop->index%2==0 ? 'bg-indigo-50' : 'bg-emerald-50' }}">
                            <td class="text-center">{{ $m->id_entrenador }}</td>
                            <td class="text-center">{{ $m->nombreEn }}</td>
                            <td class="text-center">{{ $m->edad }}</td>
                            <td class="text-center">{{ $m->ciudad }}</td>
                            <td class="text-center">
                                <a href="{{ route('bienvenido', ['id' => $m->id_entrenador]) }}" class="p-1.5 border-2 border-green-600 text-green-600 hover:bg-green-600 hover:text-white">
                                    Pokemones
                                </a>
                            </td>
                            <td class="text-center">
                                <div class="justify-center justify-self-center place-content-center flex">
                                    <button class="openModalButton px-4 py-2 justify-center p-1.5 border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white "
                                    data-action-url="{{ route('entrenadores.store') }}"
                                    data-id="{{ $m->id_entrenador }}"
                                    data-nombre="{{ $m->nombreEn }}"
                                    data-edad="{{ $m->edad }}"
                                    data-ciudad="{{ $m->ciudad }}">
                                    Editar
                                </button>
                                </div>
                            </td>
                            <td class="text-center">
                                <form id="form-{{ $m->id_entrenador }}" action="{{ route('entrenadores.destroy', $m->id_entrenador) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white">
                                        Borrar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    
    @endif

    <form action="{{ route('entrenadores.store') }}" method="post">
        @csrf
        <div class="grid grid-cols-6 gap-3">
            <div class="p-1 col-span-6 lg:col-span-1">
                <input type="text" id="nombreEn" name="nombreEn" value="{{ old('nombreEn') }}" placeholder="Nombre del entrenador" class="p-1.5 rounded-md border-2 border-blue-300" required>
                @error('NombreEn')
                <p class="text-red-500 text-xs italic">{{ $error }}</p>
                @enderror
            </div>
            <div class="p-1 col-span-6 lg:col-span-1">
                <input type="number" id="edad" name="edad" value="{{ old('edad') }}" placeholder="Ingresa tu edad" class="p-1.5 rounded-md border-2 border-blue-300" required>
                @error('number')
                <p class="text-red-500 text-xs italic">{{ $error }}</p>
                @enderror
            </div>
            <div class="p-1 col-span-6 lg:col-span-1">
                <input type="text" id="ciudad" name="ciudad" value="{{ old('ciudad') }}" placeholder="Ingresa tu ciudad" class="p-1.5 rounded-md border-2 border-blue-300" required>
                @error('ciudad')
                <p class="text-red-500 text-xs italic">{{ $error }}</p>
                @enderror
            </div>
            <div class="p-1 col-span-6 lg:col-span-1">
                <button type="submit" class="p-1.5 rounded-lg bg-indigo-600 text-white shadow-lg">Guardar</button>
            </div>
        </div>
    </form>


        <!-- El Modal -->
        <div id="myModal" class="hidden fixed z-10 left-0 top-0 w-full h-full overflow-auto bg-black bg-opacity-40">
            <div class="bg-white rounded-lg shadow-lg md:max-w-lg md:mx-auto mt-10 px-4 py-4">
                <div class="flex justify-between items-center">
                    <h4 class="text-lg">Editar Pokemon</h4>
                    <button class="closeModalButton text-black">&times;</button>
                </div>
                <form id="editForm" action="{{ route('entrenadores.edit',  $m->id_entrenador) }}" method="POST">
                    @csrf 
                    <div class="mt-2">
                        <input type="hidden" id="editId" name="id">
                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                            <input type="text" id="enombre" name="nombreEn" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="edad" class="block text-sm font-medium text-gray-700">Edad:</label>
                            <input type="number" id="eedad" name="edad" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="peso" class="block text-sm font-medium text-gray-700">Ciudad:</label>
                            <input type="text" id="eciudad" name="ciudad" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-700">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
        // Abrir modal y llenar formulario con datos para editar
            document.querySelectorAll('.openModalButton').forEach(button => {
            button.addEventListener('click', function() {
                // Extraer los datos
                const actionUrl = this.getAttribute('data-action-url');
                const id = this.getAttribute('data-id');
                const nombre = this.getAttribute('data-nombre');
                const edad = this.getAttribute('data-edad');
                const ciudad = this.getAttribute('data-ciudad');
    
                // Llenar el formulario dentro del modal
                const form = document.getElementById('editForm');
                form.action = actionUrl;
                document.getElementById('editId').value = id;
                document.getElementById('enombre').value = nombre;
                document.getElementById('eedad').value = edad;
                document.getElementById('eciudad').value = ciudad;
    
                // Mostrar el modal
                document.getElementById('myModal').classList.remove('hidden');
                        });
                    });
    
                    // Cerrar el modal al hacer clic en el botón de cerrar
                    document.querySelectorAll('.closeModalButton').forEach(button => {
                        button.addEventListener('click', function() {
                            document.getElementById('myModal').classList.add('hidden');
                        });
                    });
    
                    //Cerrar el modal al hacer clic fuera de él
                    window.onclick = function(event) {
                        if (event.target == document.getElementById('myModal')) {
                            document.getElementById('myModal').classList.add('hidden');
                        }
                    };
                });
    
              </script>



</h2>
@endsection