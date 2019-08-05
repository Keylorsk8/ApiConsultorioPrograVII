<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//Gloriana
class CreatePerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfils', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('primerApellido');
            $table->string('segundoApellido');
            $table->string('sexo');
            $table->date('fechaNacimiento');
            $table->boolean('perfilPrincipal')->default('0');
            $table->unsignedInteger('usuario_id');
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
        Schema::table('perfils', function (Blueprint $table) {
            $table->dropForeign('perfiles_usuario_id_foreign');
            $table->dropColumn('usuario_id');
        });
        Schema::dropIfExists('perfils');
    }
}