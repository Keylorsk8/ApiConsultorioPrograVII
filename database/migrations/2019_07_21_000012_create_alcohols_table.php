<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlcoholsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alcohols', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tiempoDeComienzo');
            $table->integer('frecueciaDeConsumo');
            $table->boolean('tomaActualmente');
            $table->string('observaciones')->nullable();;
            $table->boolean('cerveza')->nullable();;
            $table->integer('consumoCerveza')->nullable();;
            $table->boolean('vino')->nullable();;
            $table->integer('consumoVino')->nullable();;
            $table->boolean('licor')->nullable();;
            $table->integer('consumoLicor')->nullable();;
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
        Schema::table('alcohols', function (Blueprint $table) {
            $table->dropForeign('alcohols_expediente_id_foreign');
            $table->dropColumn('expediente_id');
        });
        Schema::dropIfExists('alcohols');
    }
}
