<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCirugiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cirugias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->date('fecha');
            $table->integer('lugar');
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
        Schema::table('cirugias', function (Blueprint $table) {
            $table->dropForeign('cirugias_expedientes_id_foreign');
            $table->dropColumn('expediente_id');
        });
        Schema::dropIfExists('cirugias');
    }
}
