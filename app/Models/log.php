<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log extends Model
{
    use HasFactory;

    //Todas las variables que añadamos aqui
    //no van a ser cuestionadas a la hora de
    //realizar peticiones a la bbdd
    protected $fillable = [
        'users_id',
        'descripcion',
    ];

    public function usuarioLog(){
        return $this->belongsTo(User::class,'users_id','id');
    }
}
