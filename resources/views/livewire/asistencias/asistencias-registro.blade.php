<div class="max-w-2xl mx-auto p-10 bg-white bg-opacity-90 backdrop-blur-md rounded-2xl shadow-2xl border border-blue-200">
    {{-- Mensajes de sesión --}}
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
             class="mb-4 px-4 py-3 rounded-lg text-white bg-green-600 shadow-md transition-all duration-300 ease-in-out">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
             class="mb-4 px-4 py-3 rounded-lg text-white bg-red-600 shadow-md transition-all duration-300 ease-in-out">
            {{ session('error') }}
        </div>
    @endif

    {{-- Formulario --}}
    <form wire:submit.prevent="submit" class="space-y-6">
        @csrf
        <h2 class="text-3xl font-bold text-center text-gray-800">Registro de Asistencia</h2>

        <div>
            <label for="entrada" class="block text-base font-medium text-gray-700 mb-1">DNI o Código del Estudiante</label>
            <input
                type="password"
                id="entrada"
                wire:model="entrada"
                placeholder="Ingrese DNI o Código"
                autocomplete="off"
                class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm text-gray-800 bg-white text-lg"
                required
            />
            @error('entrada') 
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <button type="submit"
                class="w-full py-4 bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 text-white font-semibold text-lg rounded-xl shadow-lg transform transition duration-200 hover:scale-105">
            Registrar Asistencia
        </button>
    </form>
</div>
