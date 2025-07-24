<?php

namespace App\Livewire\Estudiantes;

use Livewire\Component;
use App\Models\Estudiante;
use App\Models\Escuela;
use Livewire\WithPagination;

class EstudiantesLista extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $perEscuela = ''; // Mantenemos este nombre
    public $isActive = '';

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
            ->when($this->perEscuela, function ($query) {
                $query->where('escuela_profesional', $this->perEscuela);
            })
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);

        // Obtenemos las escuelas únicas que existen en los estudiantes
        $escuelas = Escuela::select('escuela')
                    ->distinct()
                    ->orderBy('escuela')
                    ->get()
                    ->pluck('escuela');

        return view('livewire.estudiantes.estudiantes-lista', [
            'estudiantes' => $estudiantes,
            'escuelas' => $escuelas
        ])->layout('layouts.app');
    }
}