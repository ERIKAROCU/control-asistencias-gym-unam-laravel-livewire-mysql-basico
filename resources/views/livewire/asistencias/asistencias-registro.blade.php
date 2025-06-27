<div>
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="bg-red-500 text-white p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-4">
        @csrf

        <!-- Campo único: DNI o Código -->
        <div>
            <label for="entrada" class="block text-sm font-medium">DNI o Código del Estudiante:</label>
            <input
                type="password"
                id="entrada"
                wire:model="entrada"
                class="mt-1 block w-full border-gray-300 text-black rounded-md shadow-sm"
                required
                placeholder="Ingrese DNI o Código"
                autocomplete="off"
            />
            @error('entrada') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-[#2152b5] text-white px-4 py-2 rounded w-full">
            Registrar Asistencia
        </button>
    </form>
</div>
