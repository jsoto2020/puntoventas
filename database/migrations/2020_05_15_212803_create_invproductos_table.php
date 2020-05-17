<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvproductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invproductos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_categoria');
            $table->integer('id_brand');
            $table->string('codigo',100);
            $table->string('descripcion',500);
            $table->string('descripcion_us',500);
            $table->string('unidadMed',25);
            $table->string('imagen',100);
            $table->string('referencia',100);
            $table->string('ultimoproveedor',100);
            $table->date('ultimaFechaCompra');
            $table->float('stock');
            $table->float('precio_compra');
            $table->float('precio_venta');
            $table->integer('ventas');
            $table->string('estado',100);
            $table->string('usuario_creador',500);
            $table->string('usuario_modificador',500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invproductos');
    }
}
