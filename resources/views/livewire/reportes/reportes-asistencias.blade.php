<div class="container mx-auto p-4 bg-gray-50 rounded-lg shadow-md">
    <!-- Loader -->
    <div wire:loading wire:target="downloadPdf" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500 mx-auto"></div>
            <p class="mt-4 text-center">Generando PDF...</p>
        </div>
    </div>

    <h1 class="text-2xl font-bold text-center mb-6">Reporte de Asistencias</h1>

    <!-- Filtros -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Búsqueda general -->
        <div>
            <label class="block text-sm font-medium mb-1">Búsqueda</label>
            <input type="text" wire:model.live="search" 
                   class="w-full px-3 py-2 border rounded-md">
        </div>

        <!-- Filtro por estudiante -->
        <div>
            <label class="block text-sm font-medium mb-1">Estudiante</label>
            <select wire:model.live="perEstudiante" class="w-full px-3 py-2 border rounded-md">
                <option value="">Todos</option>
                @foreach($estudiantes as $est)
                    <option value="{{ $est->id }}">{{ $est->nombre }} {{ $est->apellido }}</option>
                @endforeach
            </select>
        </div>

        <!-- Filtro por escuela -->
        <div>
            <label class="block text-sm font-medium mb-1">Escuela</label>
            <select wire:model.live="perEscuela" class="w-full px-3 py-2 border rounded-md">
                <option value="">Todas</option>
                @foreach($escuelas as $esc)
                    <option value="{{ $esc->escuela }}">{{ $esc->escuela }}</option>
                @endforeach
            </select>
        </div>

        <!-- Filtro por semestre -->
        <div>
            <label class="block text-sm font-medium mb-1">Semestre</label>
            <select wire:model.live="perSemestre" class="w-full px-3 py-2 border rounded-md">
                <option value="">Todos</option>
                @foreach($semestres as $sem)
                    <option value="{{ $sem->semestre }}">{{ $sem->semestre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Filtro por fecha -->
        <div>
            <label class="block text-sm font-medium mb-1">Fecha específica</label>
            <input type="date" wire:model.live="fechaFiltro" 
                   class="w-full px-3 py-2 border rounded-md">
        </div>

        <!-- Rango de fechas -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">Rango de fechas</label>
            <div class="flex gap-2">
                <input type="date" wire:model.live="rangoFechas.inicio" 
                       class="flex-1 px-3 py-2 border rounded-md">
                <input type="date" wire:model.live="rangoFechas.fin" 
                       class="flex-1 px-3 py-2 border rounded-md">
            </div>
        </div>
    </div>

    <!-- Botones de acción -->
    <div class="flex justify-between mb-6">
        <button wire:click="resetFilters" 
                class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">
            <i class="fas fa-sync-alt mr-2"></i>Resetear
        </button>
        <button wire:click="downloadPdf" 
                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
            <i class="fas fa-file-pdf mr-2"></i>Generar PDF
        </button>
    </div>

    <!-- Tabla de resultados -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="py-2 px-4">#</th>
                    <th class="py-2 px-4">Fecha</th>
                    <th class="py-2 px-4">Estudiante</th>
                    <th class="py-2 px-4">Escuela</th>
                    <th class="py-2 px-4">Semestre</th>
                    <th class="py-2 px-4">Tipo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movimientos as $mov)
                <tr class="border-b">
                    <td class="py-2 px-4">{{ $loop->iteration }}</td>
                    <td class="py-2 px-4">
                        @if($mov->fecha_hora)
                            {{ $mov->fecha_hora->format('d/m/Y H:i') }}
                        @else
                            Sin fecha
                        @endif
                    </td>
                    <td class="py-2 px-4">{{ $mov->estudiante->nombre }} {{ $mov->estudiante->apellido }}</td>
                    <td class="py-2 px-4">{{ $mov->estudiante->escuela_profesional }}</td>
                    <td class="py-2 px-4">{{ $mov->semestre_academico }}</td>
                    <td class="py-2 px-4">
                        <span class="{{ $mov->tipo === 'entrada' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $mov->tipo }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $movimientos->links() }}
    </div>
</div>