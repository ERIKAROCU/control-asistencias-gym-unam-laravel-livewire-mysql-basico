<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SemestreElegido extends Model
{
    use HasFactory;

    protected $table = 'semestre_elegido';

    protected $fillable = [
        'semestre_elegido',
    ];
}
