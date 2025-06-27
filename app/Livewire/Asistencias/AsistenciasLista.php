<?php

namespace App\Livewire\Asistencias;

use Livewire\Component;
use App\Models\MovimientoAsistencia;
use App\Models\Estudiante;
use Livewire\WithPagination;

class AsistenciasLista extends Component
{
    public $perPage = 10; // Número de usuarios por página
    public $search = ''; // Búsqueda general
    public $estudiantes = [];

    use WithPagination;

    public function render()
    {
        $movimientos = MovimientoAsistencia::with('estudiante')
        ->when($this->search, function ($query) {
            $query->whereHas('estudiante', function ($q) {
                $q->where('nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('apellido', 'like', '%' . $this->search . '%')
                    ->orWhere('codigo_estudiante', 'like', '%' . $this->search . '%')
                    ->orWhere('dni', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('escuela_profesional', 'like', '%' . $this->search . '%');
            })
            ->orWhere('fecha_hora', 'like', '%' . $this->search . '%') // ← búsqueda directa en fecha_hora
            ->orWhere('tipo', 'like', '%' . $this->search . '%');
        })
        ->orderByDesc('fecha_hora')
        ->paginate($this->perPage);

    return view('livewire.asistencias.asistencias-lista', compact('movimientos'))
        ->layout('layouts.app');
    }
}
