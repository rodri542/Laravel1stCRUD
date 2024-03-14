@extends('layouts.main')

@section('contenido')
    {{-- Se muestra la lista de errores --}}
    @if ($errors->any())
        <div class="w-full  bg-yellow-100 text-red-500 italic">
            <ul class="max-w-md space-y-1 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        
    <div class="grid grid-cols-1 lg:grid-cols-[auto_1fr] place-items-center">
        {{-- Form para crear nuevas materias --}}
        <form action="{{ route('asignature.store') }}" method="post">
            @csrf
            <div class="grid grid-row-5 gap-3 place-items-center p-2 m-4 bg-gray-300 rounded-lg">
                <p>Da de alta tu proceso de titulacion</p>
                <div class="p-1 col-span-6 lg:col-span-1">
                    <input type="number" id="numero_control" name="numero_control" value="{{ old('numero_control') }}" placeholder="Numero de control" class="p-1.5 rounded-md border-2 " required>
                    @error('numero_contro')
                    <p class="text-red-500 text-xs italic">{{ $error }}</p>
                    @enderror
                </div>
                <div class="p-1 col-span-6 lg:col-span-1">
                    <input type="number" id="id_asesor" name="id_asesor" value="{{ old('id_asesor') }}" placeholder="Identificador del asesor" class="p-1.5 rounded-md border-2 " required>
                    @error('id_asesor')
                    <p class="text-red-500 text-xs italic">{{ $error }}</p>
                    @enderror
                </div>
                <div class="p-1 col-span-6 lg:col-span-1">
                    <input type="number" id="anio_inicio" name="anio_inicio" value="{{ old('anio_inicio') }}" placeholder="Año de inicio" class="p-1.5 rounded-md border-2 " required>
                    @error('anio_inicio')
                    <p class="text-red-500 text-xs italic">{{ $error }}</p>
                    @enderror
                </div>
                <div class="p-1 col-span-6 lg:col-span-1">
                    <input type="text" id="nombre_proyecto" name="nombre_proyecto" value="{{ old('nombre_proyecto') }}" placeholder="Dame el nombre del proyecto" class="p-1.5 rounded-md border-2 " required>
                    @error('nombre_proyecto')
                    <p class="text-red-500 text-xs italic">{{ $error }}</p>
                    @enderror
                </div>
                <div class="p-1 col-span-6 lg:col-span-1">
                    <button type="submit" class="p-1.5 rounded-lg bg-green-200 text-black shadow-lg">Guardar</button>
                </div>
            </div>
        </form>

         {{-- Listado en Tabla de materias --}}
         <table class="w-5/6  border border-gray-800 rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-500">
                    <th class="rounded-tl-lg">ID</th>
                    <th>Numero control</th>
                    <th>ID asesor</th>
                    <th>año inicio</th>
                    <th>nombre proyecto</th>
                    <th>Editar</th>
                    <th class="rounded-tr-lg">Borrar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($titulaciones as $m)
                    <tr class="border-b-2 border-gray-300 {{ $loop->index%2==0 ? 'bg-white' : 'bg-gray-200' }}">
                        <td class="text-center">{{ $m->id }}</td>
                        <td class="text-center">{{ $m->numero_control }}</td>
                        <td class="text-center">{{ $m->id_asesor}}</td>
                        <td class="text-center">{{ $m->anio_inicio }}</td>
                        <td class="text-center">{{ $m->nombre_proyecto }}</td>
                        <td class="text-center">
                            <button class="openModalButton px-4 py-2 text-white bg-blue-400 hover:bg-blue-700 rounded"
                                data-action-url="{{ route('asignature.store') }}"
                                data-id="{{ $m->id }}"
                                data-numero-control="{{ $m->numero_control }}"
                                data-id-asesor="{{ $m->id_asesor }}"
                                data-anio-inicio="{{ $m->anio_inicio }}"
                                data-nombre-proyecto="{{ $m->nombre_proyecto }}">
                                Editar
                            </button>
                        </td>
                        <td class="text-center">
                            <form id="form-{{ $m->id }}" action="{{ route('asignature.remove') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $m->id }}" />
                                <button type="submit" class="p-1.5 border-2 bg-red-600  text-white rounded-lg  hover:bg-red-800 w-9">
                                    X
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <!-- Asegúrate de aplicar el redondeo en las esquinas inferiores de la última fila si es necesario -->

                


            </tbody>
        </table>

        <!-- El Modal -->
        <div id="myModal" class="hidden fixed z-10 left-0 top-0 w-full h-full overflow-auto bg-black bg-opacity-40">
            <div class="bg-white rounded-lg shadow-lg md:max-w-lg md:mx-auto mt-10 px-4 py-4">
                <div class="flex justify-between items-center">
                    <h4 class="text-lg">Editar Titulación</h4>
                    <button class="closeModalButton text-black">&times;</button>
                </div>
                <form id="editForm" action="{{ route('bienvenido.edit') }}" method="POST">
                    @csrf 
                    <div class="mt-2">
                        <input type="hidden" id="editId" name="id">
                        <div class="mb-4">
                            <label for="numeroControl" class="block text-sm font-medium text-gray-700">Número de Control:</label>
                            <input type="text" id="numeroControl" name="numero_control" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="idAsesor" class="block text-sm font-medium text-gray-700">ID Asesor:</label>
                            <input type="text" id="idAsesor" name="id_asesor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="anioInicio" class="block text-sm font-medium text-gray-700">Año de Inicio:</label>
                            <input type="text" id="anioInicio" name="anio_inicio" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="nombreProyecto" class="block text-sm font-medium text-gray-700">Nombre del Proyecto:</label>
                            <input type="text" id="nombreProyecto" name="nombre_proyecto" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
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
            const numeroControl = this.getAttribute('data-numero-control');
            const idAsesor = this.getAttribute('data-id-asesor');
            const anioInicio = this.getAttribute('data-anio-inicio');
            const nombreProyecto = this.getAttribute('data-nombre-proyecto');

            // Llenar el formulario dentro del modal
            const form = document.getElementById('editForm');
            form.action = actionUrl;
            document.getElementById('editId').value = id;
            document.getElementById('numeroControl').value = numeroControl;
            document.getElementById('idAsesor').value = idAsesor;
            document.getElementById('anioInicio').value = anioInicio;
            document.getElementById('nombreProyecto').value = nombreProyecto;

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
          
    </div>
@endsection