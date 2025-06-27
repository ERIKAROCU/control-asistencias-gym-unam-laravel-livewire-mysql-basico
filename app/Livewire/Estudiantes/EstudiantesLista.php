<?php

namespace App\Livewire\Estudiantes;

use Livewire\Component;
use App\Models\Estudiante;
use Livewire\WithPagination;

class EstudiantesLista extends Component
{
    use WithPagination;

    public $search = ''; // Búsqueda general
    public $perPage = 10; // Número de usuarios por página
    public $isActive = ''; // Filtro de estado (activos/inactivos)

    protected $listeners = ['refreshTable' => '$refresh', 'deleteRow' => 'deleteRow'];

    public function render()
    {
        $estudiantes = Estudiante::query()
            ->when($this->search, function ($query) {
                $query->where('codigo_estudiante', 'like', '%' . $this->search . '%')
                    ->orWhere('dni', 'like', '%' . $this->search . '%')
                    ->orWhere('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('apellido', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('escuela_profesional', 'like', '%' . $this->search . '%')
                    ->orWhere('ciclo', 'like', '%' . $this->search . '%');
            })
            /* ->when($this->isActive !== '', function ($query) {
                $query->where('is_active', $this->isActive);
            }) */
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);

        return view('livewire.estudiantes.estudiantes-lista', compact('estudiantes'))->layout('layouts.app');
    }
}
