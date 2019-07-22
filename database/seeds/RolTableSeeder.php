<?php

use Illuminate\Database\Seeder;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'nombre'        => 'administrador'
        ]);

        DB::table('roles')->insert([
            'nombre'        => 'doctor'
        ]);

        DB::table('roles')->insert([
            'nombre'        => 'paciente'
        ]);
    }
}
