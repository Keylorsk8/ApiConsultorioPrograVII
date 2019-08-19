<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('name');
            $table->string('primerApellido');
            $table->string('segundoApellido');
            $table->string('password');
            $table->string('sexo');
            $table->unsignedInteger('rol_id');
            $table->unsignedInteger('especialidad_id')->nullable();
            $table->string('especialidad')->nullable();
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->foreign('rol_id')->
            references('id')->
            on('roles')->onDelete('cascade');
            $table->foreign('especialidad_id')->
            references('id')->
            on('especialidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_rol_id_foreign');
            $table->dropColumn('rol_id');
            $table->dropForeign('users_especialidad_id_foreign');
            $table->dropColumn('especialidad_id');
        });
         Schema::dropIfExists('users');
    }
}
