<?php

use Illuminate\Database\Seeder;

class ActividadesFisicasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('actividad_fisicas')->insert([
            'nombre' => 'Correr',
            'minutosDeDuracion' => '40',
            'cantidadVecesPorSemana' => '3',
            'creadaPorAdmin' => 1
        ]);

        DB::table('actividad_fisicas')->insert([
            'nombre' => 'FitBall',
            'minutosDeDuracion' => '20',
            'cantidadVecesPorSemana' => '2',
            'creadaPorAdmin' => 1
        ]);

        DB::table('actividad_fisicas')->insert([
            'nombre' => 'Baloncesto',
            'minutosDeDuracion' => '60',
            'cantidadVecesPorSemana' => '2',
            'creadaPorAdmin' => 1
        ]);

        DB::table('actividad_fisicas')->insert([
            'nombre' => 'Futbol',
            'minutosDeDuracion' => '60',
            'cantidadVecesPorSemana' => '2',
            'creadaPorAdmin' => 1
        ]);

        DB::table('actividad_fisicas')->insert([
            'nombre' => 'Yoga',
            'minutosDeDuracion' => '90',
            'cantidadVecesPorSemana' => '2',
            'creadaPorAdmin' => 1
        ]);

        DB::table('actividad_fisicas')->insert([
            'nombre' => 'RáquetBol',
            'minutosDeDuracion' => '60',
            'cantidadVecesPorSemana' => '1',
            'creadaPorAdmin' => 1
        ]);

        DB::table('actividad_fisicas')->insert([
            'nombre' => 'Natación',
            'minutosDeDuracion' => '40',
            'cantidadVecesPorSemana' => '3',
            'creadaPorAdmin' => 1
        ]);

        $actividadFisica8 = \App\ActividadFisica::create([
            'nombre' => 'Zumba',
            'minutosDeDuracion' => '20',
            'cantidadVecesPorSemana' => '4',
            'creadaPorAdmin' => 1
        ]);

        $actividadFisica9 = \App\ActividadFisica::create([
            'nombre' => 'Hooping',
            'minutosDeDuracion' => '30',
            'cantidadVecesPorSemana' => '4',
            'creadaPorAdmin' => 1
        ]);

        $actividadFisica10 = \App\ActividadFisica::create([
            'nombre' => 'Patinaje',
            'minutosDeDuracion' => '60',
            'cantidadVecesPorSemana' => '4',
            'creadaPorAdmin' => 1
        ]);
    }
}
