<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_estudiante',
        'dni',
        'nombre',
        'apellido',
        'email',
        'escuela_profesional',
        'ciclo',
    ];

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

    public function movimientos()
    {
        return $this->hasMany(MovimientoAsistencia::class);
    }

}
