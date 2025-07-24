<?php

namespace App\Livewire\Reportes;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Estudiante;
use App\Models\MovimientoAsistencia;
use App\Models\Semestre;
use App\Models\Escuela;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportesAsistencias extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $fechaFiltro = '';
    public $perEstudiante = '';
    public $perSemestre = '';
    public $perEscuela = '';
    public $rangoFechas = ['inicio' => '', 'fin' => ''];
    public $estudiantes = [];
    public $semestres = [];
    public $escuelas = [];
    public $isLoading = false;

    public function resetFilters()
    {
        $this->reset([
            'search', 'fechaFiltro', 'perEstudiante', 'perSemestre', 
            'perEscuela', 'rangoFechas'
        ]);
    }

    public function downloadPdf()
    {
        $this->isLoading = true;
        
        $movimientos = $this->getFilteredMovimientos(false);

        // Obtener los meses y años de los movimientos
        $meses = [];
        $años = [];

        foreach ($movimientos as $movimiento) {
            if ($movimiento->fecha_hora) {
                $fecha = Carbon::parse($movimiento->fecha_hora);
                $mes = $fecha->locale('es')->isoFormat('MMMM');
                $año = $fecha->year;

                if (!in_array($mes, $meses)) $meses[] = $mes;
                if (!in_array($año, $años)) $años[] = $año;
            }
        }

        $logo = base64_encode(file_get_contents(public_path('img/UNAM.png')));

        $pdf = Pdf::loadView('pdf.asistencias', [
            'estudiante' => Estudiante::find($this->perEstudiante),
            'semestre' => Semestre::where('semestre', $this->perSemestre)->first(),
            'escuela' => Escuela::where('escuela', $this->perEscuela)->first(),
            'movimientos' => $movimientos,
            'logo' => $logo,
            'meses' => $meses,
            'años' => $años,
        ]);

        $this->isLoading = false;

        return response()->streamDownload(
            fn () => print($pdf->output()),
            'asistencia.pdf',
            ['Content-Type' => 'application/pdf']
        );
    }

    private function getFilteredMovimientos($paginate = true)
    {
        $query = MovimientoAsistencia::with(['estudiante'])
            ->when($this->search, function ($q) {
                $q->whereHas('estudiante', function ($subq) {
                    $subq->where('nombre', 'like', '%' . $this->search . '%')
                         ->orWhere('apellido', 'like', '%' . $this->search . '%')
                         ->orWhere('codigo_estudiante', 'like', '%' . $this->search . '%')
                         ->orWhere('escuela_profesional', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->perEstudiante, function ($q) {
                $q->where('estudiante_id', $this->perEstudiante);
            })
            ->when($this->perEscuela, function ($q) {
                $q->whereHas('estudiante', function ($subq) {
                    $subq->where('escuela_profesional', $this->perEscuela);
                });
            })
            ->when($this->perSemestre, function ($q) {
                $q->where('semestre_academico', $this->perSemestre);
            })
            ->when($this->fechaFiltro, function ($q) {
                $q->whereDate('fecha_hora', $this->fechaFiltro);
            })
            ->when($this->rangoFechas['inicio'] && $this->rangoFechas['fin'], function ($q) {
                $q->whereBetween('fecha_hora', [
                    $this->rangoFechas['inicio'],
                    $this->rangoFechas['fin']
                ]);
            })
            ->orderBy('fecha_hora', 'desc');

        return $paginate ? $query->paginate($this->perPage) : $query->get();
    }

    public function render()
    {
        $this->estudiantes = Estudiante::orderBy('nombre')->get();
        $this->semestres = Semestre::orderBy('semestre')->get();
        $this->escuelas = Escuela::orderBy('escuela')->get();

        return view('livewire.reportes.reportes-asistencias', [
            'movimientos' => $this->getFilteredMovimientos(),
            'estudiantes' => $this->estudiantes,
            'semestres' => $this->semestres,
            'escuelas' => $this->escuelas,
        ])->layout('layouts.app');
    }
}
