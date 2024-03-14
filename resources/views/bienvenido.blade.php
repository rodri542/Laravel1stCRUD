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
        <div class="flex flex-wrap ">
            @foreach ($pokemones as $pk)
            <div class="max-w-sm flex-initial shadow-lg border-stone-50 bg-teal-200 p-2 rounded-md border-2 m-3 ">
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

                <div class="align-bottom origin-bottom bottom-0 object-bottom ">
                    <form id="form-{{ $pk->id_pokemon }}" action="{{ route('bienvenido.delete')}}" method="post" class="justify-center justify-self-center place-content-center flex m-4">
                        @csrf
                        <input type="hidden" name="id_pokemon" value="{{ $pk->id_pokemon }}" />
                        <button type="submit" class="justify-center p-1.5 border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white ">ELIMINAR</button>
                    </form>
                    <div class="justify-center justify-self-center place-content-center flex">
                        <button class="openModalButton px-4 py-2 justify-center p-1.5 border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white "
                        data-action-url="{{ route('bienvenido.store') }}"
                        data-id="{{ $pk->id_pokemon }}"
                        data-nombre="{{ $pk->nombre }}"
                        data-tipo="{{ $pk->tipo }}"
                        data-region="{{ $pk->region }}"
                        data-descripcion="{{ $pk->descripcion }}"
                        data-edad="{{$pk->edad}}"
                        data-peso="{{$pk->peso}}">
                        Editar
                    </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <form action="	{{ route('bienvenido.store') }}" method="post" class= " flex flex-wrap flex-row flex-coljustify-items-center justify-center content-center place-content-center">
        @csrf
        <div class=" bg-cyan-300 p-3 rounded-md justify-center  place-items-center flex flex-col mb-3">
            <p class="text-black text-sm">REGISTRAR UN NUEVO POKEMON</p>
            <input type="hidden" value="{{$id}}" name="id_entrenador" id="id_entrenador">
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

        <!-- El Modal -->
        <div id="myModal" class="hidden fixed z-10 left-0 top-0 w-full h-full overflow-auto bg-black bg-opacity-40">
            <div class="bg-white rounded-lg shadow-lg md:max-w-lg md:mx-auto mt-10 px-4 py-4">
                <div class="flex justify-between items-center">
                    <h4 class="text-lg">Editar Pokemon</h4>
                    <button class="closeModalButton text-black">&times;</button>
                </div>
                <form id="editForm" action="{{ route('bienvenido.edit') }}" method="POST">
                    @csrf 
                    <div class="mt-2">
                        <input type="hidden" id="editId" name="id">
                        <input type="hidden" id="eid_entrendador" name="id_entrenador" value="{{$id}}">
                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                            <input type="text" id="enombre" name="nombre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo</label>
                            <input type="text" id="etipo" name="tipo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="region" class="block text-sm font-medium text-gray-700">Region:</label>
                            <input type="text" id="eregion" name="region" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripcion:</label>
                            <input type="text" id="edescripcion" name="descripcion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="edad" class="block text-sm font-medium text-gray-700">Edad:</label>
                            <input type="number" id="eedad" name="edad" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="peso" class="block text-sm font-medium text-gray-700">Peso:</label>
                            <input type="number" id="epeso" name="peso" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
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
                const tipo = this.getAttribute('data-tipo');
                const region = this.getAttribute('data-region');
                const descripcion = this.getAttribute('data-descripcion');
                const edad = this.getAttribute('data-edad');
                const peso = this.getAttribute('data-peso');
    
                // Llenar el formulario dentro del modal
                const form = document.getElementById('editForm');
                form.action = actionUrl;
                document.getElementById('editId').value = id;
                document.getElementById('enombre').value = nombre;
                document.getElementById('etipo').value = tipo;
                document.getElementById('eregion').value = region;
                document.getElementById('edescripcion').value = descripcion;
                document.getElementById('eedad').value = edad;
                document.getElementById('epeso').value = peso;
    
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





    @endsection