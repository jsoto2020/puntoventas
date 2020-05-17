<?php

namespace App\librerias;

use Illuminate\Database\Eloquent\Model;

class brands extends Model
{
    protected $fillable = ['id_brand', 'descripcion', 'usuario_creador', 'usuario_modificador','estado'];
}
