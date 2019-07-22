<?php

use Illuminate\Database\Seeder;

class EspecialidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('especialidades')->insert([
            'nombre' => 'Médicina General'
        ]);


        DB::table('especialidades')->insert([
            'nombre' => 'Cardiología'
        ]);

        DB::table('especialidades')->insert([
            'nombre' => 'Gastroenterología'
        ]);

        DB::table('especialidades')->insert([
            'nombre' => 'Neurología'
        ]);

        DB::table('especialidades')->insert([
            'nombre' => 'Pediatría'
        ]);

        DB::table('especialidades')->insert([
            'nombre' => 'Psiquiatría'
        ]);

        DB::table('especialidades')->insert([
            'nombre' => 'Nutriología'
        ]);

        DB::table('especialidades')->insert([
            'nombre' => 'Oftalmología'
        ]);

        DB::table('especialidades')->insert([
            'nombre' => 'Urología'
        ]);
    }
}
