<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('perfil_id');
            $table->foreign('perfil_id')->
            references('id')->
            on('perfils');
            $table->unsignedInteger('tipoSangre_id');
            $table->foreign('tipoSangre_id')->
            references('id')->
            on('tipo_sangres');
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
        Schema::table('expedientes', function (Blueprint $table) {
            $table->dropForeign('expedientes_perfil_id_foreign');
            $table->dropColumn('perfil_id');
            $table->dropForeign('expedientes_tipoSangre_id_foreign');
            $table->dropColumn('tipoSangre_id');
        });
        Schema::dropIfExists('expedientes');
    }
}
