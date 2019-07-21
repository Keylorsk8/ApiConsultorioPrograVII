<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExpedienteTipoSangre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expediente_tipoSangre', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expediente_id');
            $table->integer('tipoSangre_id');
            $table->foreign('expediente_id')->
            references('id')->
            on('expedientes')->onDelete('cascade');
            $table->foreign('tipoSangre_id')->
            references('id')->
            on('tipoSangres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expediente_tipoSangre', function (Blueprint $table) {
            $table->dropForeign('expediente_tipoSangre_expediente_id_foreign');
            $table->dropColumn('expediente_id');
            $table->dropForeign('expediente_tipoSangre_tipoSangre_id_foreign');
            $table->dropColumn('tipoSangre_id');
        });
          Schema::dropIfExists('expediente_tipoSangre');
    }
}
