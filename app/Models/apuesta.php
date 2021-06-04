<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apuesta extends Model
{
    use HasFactory;

    protected $fillable = [
        'idCarrera',
        'nombreCarrera',
        'primerPiloto',
        'segundoPiloto',
        'tercerPiloto',
        'safetyCar',
        'equipoGanador',
        'esCorrecta',
        'users_id'
    ];
}
