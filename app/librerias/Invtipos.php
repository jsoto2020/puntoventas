<?php

namespace App\librerias;

use Illuminate\Database\Eloquent\Model;

class Invtipos extends Model
{
    protected $fillable = ['id_tipo', 'descripcion', 'usuario_creador', 'usuario_modificador','estado'];
}
