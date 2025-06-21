<div class="w-50 h-screen bg-gray-900 shadow-lg text-white flex flex-col">
    <!-- Encabezado del Sidebar -->
    <div class="p-6 flex items-center space-x-3 border-b border-blue-800">
        {{-- <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-20 h-20"> --}}
        <h2 class="text-xl font-bold">Panel de Control</h2>
    </div>

    <!-- Menú de Navegación -->
    <nav class="flex-1 p-4">
        <ul class="space-y-2">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-800 transition">
                    <i class="fas fa-home"></i> <span>Dashboard</span>
                </a>
            </li>

            <!-- Usuarios -->
            <li>
                <a href="{{ route('users.users-table') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-800 transition">
                    <i class="fas fa-user"></i> <span>Usuarios</span>
                </a>
            </li>

            
        </ul>
    </nav>
</div>
