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
            'tipoSangre_id' => 1
        ]);
    }
}
