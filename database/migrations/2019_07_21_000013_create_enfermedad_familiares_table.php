<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnfermedadFamiliaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enfermedad_familiares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('quien');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->
            references('id')->
            on('users');
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
        Schema::table('enfermedad_familiares', function (Blueprint $table) {
            $table->dropForeign('enfermedad_familiares_user_id_foreign');
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('enfermedad_familiares');
    }
}
