<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvgruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invgrupos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_grupo');
            $table->string('descripcion',500);
            $table->string('usuario_creador',500);
            $table->string('usuario_modificador',500);
            $table->string('estado',100);
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
        Schema::dropIfExists('invgrupos');
    }
}
