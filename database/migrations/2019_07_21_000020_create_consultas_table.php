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
            $table->increments('id');
            $table->string('nombre');
            $table->string('ubicacion');
            $table->double('precio');
            $table->date('fecha');
            $table->string('hora');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->
            references('id')->
            on('users');
            $table->unsignedInteger('perfil_id')->nullable();
            $table->foreign('perfil_id')->
            references('id')->
            on('perfils');
            $table->timestamps();
            $table->softDeletes();
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
            $table->dropColumn('user_id');
            $table->dropForeign('consultas_perfil_id_foreign');
            $table->dropColumn('perfil_id');
        });
        Schema::dropIfExists('consultas');
    }
}
