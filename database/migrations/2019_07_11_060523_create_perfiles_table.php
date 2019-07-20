<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('primerApellido');
            $table->string('segundoApellido');
            $table->string('sexo');
            $table->date('fechaNacimiento');
            $table->integer('tipoSangre');
            $table->integer('usuario_id');
            $table->foreign('usuario_id')->
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
        Schema::table('perfiles', function (Blueprint $table) {
            $table->dropForeign('perfiles_users_id_foreign');
            $table->dropColumn('role_id');
        });
        Schema::dropIfExists('perfiles');
    }
}
