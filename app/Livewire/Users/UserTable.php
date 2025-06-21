<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserTable extends Component
{
    use WithPagination;

    public $search = ''; // Búsqueda general
    public $perPage = 10; // Número de usuarios por página
    public $isActive = ''; // Filtro de estado (activos/inactivos)

    protected $listeners = ['refreshTable' => '$refresh', 'deleteRow' => 'deleteRow'];

    public function render()
    {
        $usuarios = User::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('rol', 'like', '%' . $this->search . '%');
            })
            ->when($this->isActive !== '', function ($query) {
                $query->where('is_active', $this->isActive);
            })
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);

        return view('livewire.users.user-table', compact('usuarios'))->layout('layouts.app');
    }
}
