<div class="container mx-auto p-4 bg-gray-50 rounded-lg shadow-md">
    <div>
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-4">Gestión de Estudiantes</h1>
    </div>
    <div>
        <ul>
            <li>
                <button wire:click="dispatch('showModalEstudiante')" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-user"></i>+ Agregar
                </button>
            </li>
        </ul>
    </div>
    <br>

    <div class="mb-4 flex justify-between items-center">
        <input
            type="text"
            wire:model.live="search"
            placeholder="Buscar por nombre, correo, DNI o cargo..."
            class="w-1/2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >

        <select
            wire:model.live="perEscuela"
            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <option value="">Todas las escuelas</option>
            @foreach($escuelas as $escuela)
                <option value="{{ $escuela }}">{{ $escuela }}</option>
            @endforeach
        </select>

        <select
            wire:model.live="perPage"
            class="px-6 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <option value="10">10 por página</option>
            <option value="25">25 por página</option>
            <option value="50">50 por página</option>
        </select>
    </div>

    <div wire:key="estudiantes-table">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="py-2 px-4 border-b text-center text-sm font-medium">ID</th>
                    <th class="py-2 px-4 border-b text-center text-sm font-medium">Codigo</th>
                    <th class="py-2 px-4 border-b text-center text-sm font-medium">DNI</th>
                    <th class="py-2 px-4 border-b text-center text-sm font-medium">Nombres</th>
                    <th class="py-2 px-4 border-b text-center text-sm font-medium">Apellidos</th>
                    <th class="py-2 px-4 border-b text-center text-sm font-medium">Email</th>
                    <th class="py-2 px-4 border-b text-center text-sm font-medium">Escuela</th>
                    <th class="py-2 px-4 border-b text-center text-sm font-medium">Ciclo</th>
                    <th class="py-2 px-4 border-b text-center text-sm font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody> 
                @foreach ($estudiantes as $estudiante)
                    <tr wire:key="estudiante-{{ $estudiante->id }}">
                        <td class="py-2 px-4 border-b text-center text-sm text-gray-800">{{ $estudiante->id }}</td>
                        <td class="py-2 px-4 border-b text-center text-sm text-gray-800">{{ $estudiante->codigo_estudiante }}</td>
                        <td class="py-2 px-4 border-b text-center text-sm text-gray-800">{{ $estudiante->dni }}</td>
                        <td class="py-2 px-4 border-b text-sm text-gray-800">{{ $estudiante->nombre }}</td>
                        <td class="py-2 px-4 border-b text-sm text-gray-800">{{ $estudiante->apellido }}</td>
                        <td class="py-2 px-4 border-b text-sm text-gray-800">{{ $estudiante->email }}</td>
                        <td class="py-2 px-4 border-b text-sm text-gray-800">{{ $estudiante->escuela_profesional }}</td>
                        <td class="py-2 px-4 border-b text-center text-sm text-gray-800">{{ $estudiante->ciclo }}</td>
                        {{-- <td class="py-2 px-4 border-b text-center text-sm text-gray-800">{{ $estudiante->rol ? 'Admin' : 'Usuario' }}</td> --}}
                        {{-- <td class="py-2 px-4 border-b text-center text-sm text-gray-800">
                            @if ($estudiante->is_active)
                                <span class="text-green-600">Activo</span>
                            @else
                                <span class="text-red-600">Inactivo</span>
                            @endif
                        </td> --}}
                        <td class="border border-gray-300 p-2 text-center">
                            {{-- Botón Editar --}}
                            <button wire:click="dispatch('edit', { id: {{ $estudiante->id }} })"
                                class="bg-blue-600 hover:bg-blue-800 text-white px-3 py-1 rounded" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>

                            {{-- Botón Eliminar --}}
                            {{-- <button onclick="confirmDelete({{ $empleado->id }})"
                                class="bg-red-500 text-white px-3 py-1 rounded">
                                <i class="fas fa-trash"></i>
                            </button> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $estudiantes->links() }}
    </div>

    {{-- Incluir el modal --}}
    @livewire('estudiantes.estudiantes-form')

    {{-- Script para confirmar eliminación --}}
    <script>
        function confirmDelete(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                @this.call('deleteRow', id);
            }
        }
    </script> 
</div>
