<?php

use Illuminate\Database\Seeder;

class PerfilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfils')->insert([
            'nombre' => 'Jean Paul',
            'primerApellido' => 'Rojas',
            'segundoApellido' => 'Morales',
            'sexo' => 'Otro',
            'fechaNacimiento' => '1997-12-16',
            'perfilPrincipal' => 1,
            'user_id' => 4
        ]);
    }
}
