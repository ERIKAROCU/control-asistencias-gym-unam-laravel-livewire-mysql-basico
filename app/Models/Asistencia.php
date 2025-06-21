<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'estudiante_id',
        'fecha_asistencia',
        'hora_entrada',
        'hora_salida',
        'semestre_academico',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}
