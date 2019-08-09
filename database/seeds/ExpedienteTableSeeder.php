<?php

use Illuminate\Database\Seeder;

class ExpedienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expedientes')->insert([
            'perfil_id' => 1,
            'tipo_sangre_id' => 1
        ]);
    }
}
