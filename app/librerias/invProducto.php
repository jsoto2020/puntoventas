<?php

namespace App\librerias;

use Illuminate\Database\Eloquent\Model;

class invProducto extends Model
{
    protected $table = 'invproductos';
    protected $fillable = ['codigo', 'descripcion', 'descripcion_us','unidadMed','stock','precio_venta','precio_compra','usuario_creador',
                            'usuario_modificador','id_categoria','id_brand','imagen','estado','referencia','ultimoproveedor',
                            'ultimaFechaCompra','ventas','atributos'];
}
