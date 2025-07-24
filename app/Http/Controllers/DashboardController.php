<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Escuela;
use App\Models\MovimientoAsistencia;
use App\Models\SemestreElegido;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalEstudiantes' => Estudiante::count(),
            'totalEscuelas' => Escuela::count(),
            'totalAsistencias' => MovimientoAsistencia::count(),
            'ultimoSemestre' => SemestreElegido::latest()->first(),
            'estudiantes' => Estudiante::with('movimientos')->get(),
            'asistencias' => MovimientoAsistencia::with('estudiante')->latest()->take(10)->get(),
        ]);
    }
}
