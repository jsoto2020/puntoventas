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
            $table->string('imagen',100)->nullable();
            $table->string('referencia',100)->nullable();
            $table->string('ultimoproveedor',100)->nullable();
            $table->date('ultimaFechaCompra')->nullable();
            $table->float('stock')->nullable();
            $table->float('precio_compra')->nullable();
            $table->float('precio_venta')->nullable();
            $table->float('fechadescuento')->nullable();
            $table->float('porcientodescuento')->nullable();
            $table->integer('ventas');
            $table->json('atributos')->nullable();
            $table->string('estado',100);
            $table->string('usuario_creador',500);
            $table->string('usuario_modificador',500)->nullable();
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
