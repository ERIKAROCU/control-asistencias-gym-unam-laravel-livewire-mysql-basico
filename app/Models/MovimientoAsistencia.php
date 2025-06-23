<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovimientoAsistencia extends Model
{
    use HasFactory;

    protected $table = 'movimientos_asistencia';

    protected $fillable = [
        'estudiante_id',
        'fecha_hora',
        'tipo',
        'semestre_academico',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}
