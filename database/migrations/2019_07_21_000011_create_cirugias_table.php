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
            $table->increments('id');
            $table->string('nombre');
            $table->date('fecha');
            $table->string('lugar');
            $table->boolean('creadaPorAdmin')->default(false);
            $table->unsignedInteger('expediente_id')->nullable();
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
            $table->dropForeign('expedientes_cirugia_id_foreign');
            $table->dropColumn('expediente_id');
        });
        Schema::dropIfExists('cirugias');
    }
}
