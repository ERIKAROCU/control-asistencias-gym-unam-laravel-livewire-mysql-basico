<div>
@if($modalVisible)
    <div class="fixed inset-0 bg-gray-500 bg-opacity-50 z-50 overflow-y-auto">
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl">
                <h2 class="text-xl font-bold mb-4">
                    {{ $isEditing ? 'Editar Estudiante' : 'Agregar Estudiante' }}
                </h2>
                
                <form wire:submit.prevent="save" class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm">Código</label>
                        <input type="text" wire:model.defer="codigo_estudiante" class="w-full p-2 border rounded" />
                        @error('codigo_estudiante') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm">DNI</label>
                        <input type="text" wire:model.defer="dni" class="w-full p-2 border rounded" />
                        @error('dni') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm">Nombres</label>
                        <input type="text" wire:model.defer="nombre" class="w-full p-2 border rounded" />
                        @error('nombre') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm">Apellidos</label>
                        <input type="text" wire:model.defer="apellido" class="w-full p-2 border rounded" />
                        @error('apellido') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm">Email</label>
                        <input type="email" wire:model.defer="email" class="w-full p-2 border rounded" />
                        @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm">Escuela Profesional</label>
                        <select
                            wire:model.defer="escuela_profesional"
                            class="w-full p-2 border rounded"
                        >
                            @foreach($escuelas as $escuela)
                                <option value="{{ $escuela }}">{{ $escuela }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm">Ciclo</label>
                        <input type="text" wire:model.defer="ciclo" class="w-full p-2 border rounded" />
                        @error('ciclo') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Botones -->
                    <div class="col-span-2 flex justify-end gap-2 mt-4">
                        <button wire:click="$set('modalVisible', false)" type="button" class="px-4 py-2 bg-gray-300 rounded">
                            Cancelar
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            {{ $isEditing ? 'Actualizar' : 'Guardar' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style> body { overflow: hidden; } </style>
@endif
</div>

<script>
    window.addEventListener('swal', event => {
        Swal.fire({
            title: event.detail.title,
            icon: event.detail.icon,
            showConfirmButton: true,
            timer: 1500
        });
    });
</script>