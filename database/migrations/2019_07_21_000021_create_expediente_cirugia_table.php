<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExpedienteCirugia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expediente_cirugia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expediente_id');
            $table->integer('cirugia_id');
            $table->foreign('expediente_id')->
            references('id')->
            on('expedientes')->onDelete('cascade');
            $table->foreign('cirugia_id')->
            references('id')->
            on('cirugias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expediente_cirugia', function (Blueprint $table) {
            $table->dropForeign('expediente_cirugia_expediente_id_foreign');
            $table->dropColumn('expediente_id');
            $table->dropForeign('expediente_cirugia_cirugia_id_foreign');
            $table->dropColumn('cirugia_id');
        });
          Schema::dropIfExists('expediente_cirugia');
    }
}
