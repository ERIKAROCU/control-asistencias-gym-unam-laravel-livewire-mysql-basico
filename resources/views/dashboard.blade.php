<x-app-layout>
    <div class="container mx-auto p-6 bg-gray-50 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Dashboard de Asistencias</h2>

        <!-- Tarjetas de resumen -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="flex items-center p-5 bg-blue-500 text-white rounded-lg shadow-lg">
                <div class="text-4xl mr-4">👤</div>
                <div>
                    <h3 class="text-lg font-semibold">Total Estudiantes</h3>
                    <p class="text-3xl font-bold">{{ $totalEstudiantes }}</p>
                </div>
            </div>

            <div class="flex items-center p-5 bg-green-500 text-white rounded-lg shadow-lg">
                <div class="text-4xl mr-4">🏫</div>
                <div>
                    <h3 class="text-lg font-semibold">Total Escuelas</h3>
                    <p class="text-3xl font-bold">{{ $totalEscuelas }}</p>
                </div>
            </div>

            <div class="flex items-center p-5 bg-yellow-500 text-white rounded-lg shadow-lg">
                <div class="text-4xl mr-4">🕒</div>
                <div>
                    <h3 class="text-lg font-semibold">Total Asistencias</h3>
                    <p class="text-3xl font-bold">{{ $totalAsistencias }}</p>
                </div>
            </div>

            <div class="flex items-center p-5 bg-purple-500 text-white rounded-lg shadow-lg">
                <div class="text-4xl mr-4">📅</div>
                <div>
                    <h3 class="text-lg font-semibold">Semestre Actual</h3>
                    <p class="text-2xl font-bold">{{ $ultimoSemestre->semestre_elegido ?? 'No definido' }}</p>
                </div>
            </div>
        </div>

        <!-- Tabla de Estudiantes -->
        <h3 class="text-2xl font-semibold text-gray-700 mb-4">Estudiantes Registrados</h3>
        <div class="overflow-x-auto mb-10">
            <table class="min-w-full bg-white border rounded-lg shadow-md text-sm">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4">Código</th>
                        <th class="py-2 px-4">DNI</th>
                        <th class="py-2 px-4">Nombre</th>
                        <th class="py-2 px-4">Apellido</th>
                        <th class="py-2 px-4">Email</th>
                        <th class="py-2 px-4">Escuela</th>
                        <th class="py-2 px-4">Ciclo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estudiantes as $est)
                        <tr class="border-t">
                            <td class="py-2 px-4">{{ $est->codigo_estudiante }}</td>
                            <td class="py-2 px-4">{{ $est->dni }}</td>
                            <td class="py-2 px-4">{{ $est->nombre }}</td>
                            <td class="py-2 px-4">{{ $est->apellido }}</td>
                            <td class="py-2 px-4">{{ $est->email }}</td>
                            <td class="py-2 px-4">{{ $est->escuela_profesional }}</td>
                            <td class="py-2 px-4">{{ $est->ciclo }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Últimos Movimientos de Asistencia -->
        <h3 class="text-2xl font-semibold text-gray-700 mb-4">Últimos Movimientos de Asistencia</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded-lg shadow-md text-sm">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4">Estudiante</th>
                        <th class="py-2 px-4">DNI</th>
                        <th class="py-2 px-4">Fecha y Hora</th>
                        <th class="py-2 px-4">Tipo</th>
                        <th class="py-2 px-4">Semestre</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asistencias as $asist)
                        <tr class="border-t">
                            <td class="py-2 px-4">{{ $asist->estudiante->nombre }} {{ $asist->estudiante->apellido }}</td>
                            <td class="py-2 px-4">{{ $asist->estudiante->dni }}</td>
                            <td class="py-2 px-4">{{ $asist->fecha_hora }}</td>
                            <td class="py-2 px-4 capitalize">{{ $asist->tipo }}</td>
                            <td class="py-2 px-4">{{ $asist->semestre_academico }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
