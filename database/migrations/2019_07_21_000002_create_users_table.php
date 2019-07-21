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
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('name');
            $table->string('primerApellido');
            $table->string('segundoApellido');
            $table->string('password');
            $table->string('sexo');
            $table->unsignedInteger('rol_id');
            $table->unsignedInteger('especialidad_id')->nullable();
            $table->foreign('especialidad_id')->
            references('id')->
            on('especialidades');
            $table->foreign('role_id')->
            references('id')->
            on('roles');
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_role_id_foreign');
            $table->dropColumn('role_id');
        });
         Schema::dropIfExists('users');
    }
}
