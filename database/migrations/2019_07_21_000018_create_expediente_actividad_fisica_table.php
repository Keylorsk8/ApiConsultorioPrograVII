<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpedienteActividadFisicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expediente_actividad_fisica', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('expediente_id');
            $table->unsignedInteger('actividadFisica_id');
            $table->foreign('expediente_id')->
            references('id')->
            on('expedientes')->onDelete('cascade');
            $table->foreign('actividadFisica_id')->
            references('id')->
            on('actividad_fisicas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expediente_actividad_fisica', function (Blueprint $table) {
            $table->dropForeign('expediente_actividadFisica_expediente_id_foreign');
            $table->dropColumn('expediente_id');
            $table->dropForeign('expediente_actividadFisica_actividadFisica_id_foreign');
            $table->dropColumn('actividadFisica_id');
        });
          Schema::dropIfExists('expediente_actividadFisica');
    }
}
