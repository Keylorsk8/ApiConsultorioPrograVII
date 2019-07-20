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
            $table->integer('idExpediente');
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
        Schema::dropIfExists('fumados');
    }
}
