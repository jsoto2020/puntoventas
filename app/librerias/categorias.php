<?php

namespace App\librerias;

use Illuminate\Database\Eloquent\Model;

class categorias extends Model
{
    protected $fillable = ['id_categoria', 'descripcion', 'usuario_creador', 'usuario_modificador','estado'];
}
