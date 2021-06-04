<?php

namespace App\Models;

use App\Models\User as User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'id',
    ];

    public function creadaPor(){
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function comentariosNotica(){
        return $this->hasMany(comentario::class,'idNoticia','id');
    }

    public function nombreUserComentario(){
        return $this->hasMany(User::class,'users_id','id');
    }


}
