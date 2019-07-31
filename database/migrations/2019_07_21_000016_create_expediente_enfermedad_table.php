<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpedienteEnfermedadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expediente_enfermedad', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expediente_id')->unsigned();
            $table->integer('enfermedad_id')->unsigned();
            $table->timestamps();
            $table->foreign('expediente_id')->
            references('id')->
            on('expedientes')->onDelete('cascade');
            $table->foreign('enfermedad_id')->
            references('id')->
            on('enfermedads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expediente_enfermedad', function (Blueprint $table) {
            $table->dropForeign('expediente_enfermedad_expediente_id_foreign');
            $table->dropColumn('expediente_id');
            $table->dropForeign('expediente_enfermedad_enfermedad_id_foreign');
            $table->dropColumn('enfermedad_id');
        });
          Schema::dropIfExists('expediente_enfermedad');
    }
}
