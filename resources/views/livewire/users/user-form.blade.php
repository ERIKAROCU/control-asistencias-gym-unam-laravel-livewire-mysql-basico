<div>
@if($modalVisible)
    <div class="fixed inset-0 bg-gray-500 bg-opacity-50 z-50 overflow-y-auto">
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl">
                <h2 class="text-xl font-bold mb-4">
                    {{ $isEditing ? 'Editar Usuario' : 'Nuevo Usuario' }}
                </h2>

                <form wire:submit.prevent="save" class="grid grid-cols-2 gap-4">
                    <!-- Nombre -->
                    <div class="col-span-1">
                        <label class="block text-sm">Nombres</label>
                        <input type="text" wire:model.defer="name" class="w-full p-2 border rounded" />
                        @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-span-1">
                        <label class="block text-sm">Correo</label>
                        <input type="email" wire:model.defer="email" class="w-full p-2 border rounded" />
                        @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Rol -->
                    <div class="col-span-1">
                        <label class="block text-sm">Rol</label>
                        <select wire:model.defer="rol" class="w-full p-2 border rounded">
                            <option value="0">Usuario</option>
                            <option value="1">Administrador</option>
                        </select>
                        @error('rol') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Estado -->
                    <div class="col-span-1">
                        <label class="block text-sm">Estado</label>
                        <select wire:model.defer="is_active" class="w-full p-2 border rounded">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                        @error('is_active') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="col-span-1">
                        <label class="block text-sm">Contraseña</label>
                        <input type="password" wire:model.defer="password" class="w-full p-2 border rounded" />
                        @error('password') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Confirmar contraseña -->
                    <div class="col-span-1">
                        <label class="block text-sm">Confirmar contraseña</label>
                        <input type="password" wire:model.defer="password_confirmation" class="w-full p-2 border rounded" />
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
