<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFumadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fumados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cantidadCigarrosPorDia');
            $table->integer('tiempoComenzoAFumar');
            $table->string('observaciones');
            $table->integer('expediente_id');
            $table->foreign('expediente_id')->
            references('id')->
            on('expedientes');
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
        Schema::table('fumados', function (Blueprint $table) {
            $table->dropForeign('fumados_expediente_id_foreign');
            $table->dropColumn('expediente_id');
        });
        Schema::dropIfExists('fumados');
    }
}
