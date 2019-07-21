<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('ubicacion');
            $table->double('precio');
            $table->date('fechayHora');
            $table->integer('doctor_id');
            $table->foreign('doctor_id')->
            references('id')->
            on('users');
            $table->integer('perfil_id');
            $table->foreign('perfil_id')->
            references('id')->
            on('perfiles');
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
        Schema::table('consultas', function (Blueprint $table) {
            $table->dropForeign('consultas_user_id_foreign');
            $table->dropColumn('doctor_id');
            $table->dropForeign('consultas_perfil_id_foreign');
            $table->dropColumn('perfil_id');
        });
        Schema::dropIfExists('consultas');
    }
}
