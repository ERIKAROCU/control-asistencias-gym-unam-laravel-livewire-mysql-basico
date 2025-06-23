<?php

namespace App\Livewire\Asistencias;

use Livewire\Component;
use App\Models\Estudiante;
use App\Models\Asistencia;
use App\Models\SemestreElegido;
use App\Models\MovimientoAsistencia;
use Carbon\Carbon;


class AsistenciasRegistro extends Component
{
    public $entrada;

    protected $rules = [
        'entrada' => 'required',
    ];

    protected $messages = [
        'entrada.required' => 'Debes ingresar tu DNI o código de estudiante.',
    ];

    protected $listeners = ['swal' => 'swal'];

    public function submit()
    {
        $this->validate();
        $ahora = now();

        // Buscar estudiante
        $estudiante = Estudiante::where('dni', $this->entrada)
            ->orWhere('codigo_estudiante', $this->entrada)
            ->first();

        if (!$estudiante) {
            $this->dispatch('swal', [
                'title' => 'Error',
                'text' => 'Estudiante no encontrado.',
                'icon' => 'error'
            ]);
            return;
        }

        $semestre = SemestreElegido::first()?->semestre_elegido ?? 'No definido';

        // Buscar último movimiento de hoy
        $ultimoMovimiento = MovimientoAsistencia::where('estudiante_id', $estudiante->id)
            ->whereDate('fecha_hora', $ahora->toDateString())
            ->latest('fecha_hora')
            ->first();

        // Determinar si se registra una entrada o salida
        $nuevoTipo = 'entrada';

        if ($ultimoMovimiento && $ultimoMovimiento->tipo === 'entrada') {
            $nuevoTipo = 'salida';
        }

        MovimientoAsistencia::create([
            'estudiante_id' => $estudiante->id,
            'fecha_hora' => $ahora,
            'tipo' => $nuevoTipo,
            'semestre_academico' => $semestre,
        ]);

        $mensaje = $nuevoTipo === 'entrada' ? 'Entrada registrada correctamente.' : 'Salida registrada correctamente.';
        $icono = 'success';

        $this->dispatch('swal', [
            'title' => 'Asistencia',
            'text' => $mensaje,
            'icon' => $icono
        ]);

        $this->reset('entrada');
        session()->forget('message');
        session()->forget('error');
    }

    public function render()
    {
        return view('livewire.asistencias.asistencias-registro')->layout('layouts.app');
    }
}
