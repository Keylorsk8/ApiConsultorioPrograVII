<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadFisicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad_fisicas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('minutosDeDuracion');
            $table->integer('cantidadVecesPorSemana');
            $table->boolean('creadaPorAdmin')->default(false);
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
        Schema::dropIfExists('actividad_fisicas');
    }
}
