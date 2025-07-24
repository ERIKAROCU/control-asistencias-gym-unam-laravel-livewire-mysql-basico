<div class="container mx-auto p-4 bg-gray-50 rounded-lg shadow-md">
    <div>
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-4">Lista de Asistencias</h1>
    </div>

    <div class="mb-4 flex justify-between items-center">
        <input
            type="text"
            wire:model.live="search"
            placeholder="Buscar por nombre, correo, DNI o cargo..."
            class="w-1/2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
    </div>
    <div wire:key="usuarios-table">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="py-2 px-4 border-b text-center text-sm font-medium">Estudiante</th>
                    <th class="py-2 px-4 border-b text-center text-sm font-medium">Código</th>
                    <th class="py-2 px-4 border-b text-center text-sm font-medium">Tipo</th>
                    <th class="py-2 px-4 border-b text-center text-sm font-medium">Fecha y Hora</th>
                    <th class="py-2 px-4 border-b text-center text-sm font-medium">Semestre</th>
                </tr>
            </thead>
            <tbody>
                @forelse($movimientos as $mov)
                    <tr>
                        <td class="py-2 px-4 border-b text-sm text-gray-800">{{ $mov->estudiante->nombre }} {{ $mov->estudiante->apellido }}</td>
                        <td class="py-2 px-4 border-b text-center text-sm text-gray-800">{{ $mov->estudiante->codigo_estudiante }}</td>
                        <td class="py-2 px-4 border-b text-center text-sm text-gray-800">
                            <span class="px-2 py-1 rounded text-white {{ $mov->tipo === 'entrada' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ ucfirst($mov->tipo) }}
                            </span>
                        </td>
                        <td class="py-2 px-4 border-b text-center text-sm text-gray-800">{{ $mov->fecha_hora }}</td>
                        <td class="py-2 px-4 border-b text-center text-sm text-gray-800">{{ $mov->semestre_academico }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-2 px-4 border-b text-sm text-gray-800">Sin registros de asistencia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    <div class="mt-4">
        {{ $movimientos->links() }}
    </div>
</div>
