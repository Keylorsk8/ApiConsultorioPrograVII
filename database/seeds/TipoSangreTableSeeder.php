<?php

use Illuminate\Database\Seeder;

class TipoSangreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_sangres')->insert([
            'nombre' => 'O-'
        ]);

        DB::table('tipo_sangres')->insert([
            'nombre' => 'O+'
        ]);

        DB::table('tipo_sangres')->insert([
            'nombre' => 'A-'
        ]);

        DB::table('tipo_sangres')->insert([
            'nombre' => 'A+'
        ]);

        DB::table('tipo_sangres')->insert([
            'nombre' => 'B-'
        ]);

        DB::table('tipo_sangres')->insert([
            'nombre' => 'B+'
        ]);

        DB::table('tipo_sangres')->insert([
            'nombre' => 'AB-'
        ]);

        DB::table('tipo_sangres')->insert([
            'nombre' => 'AB+'
        ]);
    }
}
