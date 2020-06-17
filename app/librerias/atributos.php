<?php

namespace App\librerias;

use Illuminate\Database\Eloquent\Model;

class atributos extends Model
{
    protected $fillable = ['id_atributo', 'nombre','descripcion','tipo', 'usuario_creador', 'usuario_modificador','estado','configuracion'];
}
