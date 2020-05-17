<?php

namespace App\librerias;

use Illuminate\Database\Eloquent\Model;

class invgrupos extends Model
{
    protected $fillable = ['id_grupo', 'descripcion', 'usuario_creador', 'usuario_modificador','estado'];
}
