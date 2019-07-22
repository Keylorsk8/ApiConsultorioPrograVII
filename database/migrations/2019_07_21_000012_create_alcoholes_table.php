<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlcoholesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alcoholes', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tiempoDeComienzo');
            $table->integer('frecueciaDeConsumo');
            $table->boolean('tomaActualmente');
            $table->string('observaciones');
            $table->boolean('cerveza');
            $table->integer('consumoCerveza');
            $table->boolean('vino');
            $table->integer('consumoVino');
            $table->boolean('licor');
            $table->integer('consumoLicor');
            $table->unsignedInteger('expediente_id');
            $table->foreign('expediente_id')->
            references('id')->
            on('expedientes');
            //hola mundo
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
        Schema::table('alcoholes', function (Blueprint $table) {
            $table->dropForeign('alcoholes_expediente_id_foreign');
            $table->dropColumn('expediente_id');
        });
        Schema::dropIfExists('alcoholes');
    }
}
