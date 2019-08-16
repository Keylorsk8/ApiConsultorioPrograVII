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
            'creadaPorAdmin' => 1,
            'imagen' => 'correr.jpg'
        ]);

        DB::table('actividad_fisicas')->insert([
            'nombre' => 'FitBall',
            'minutosDeDuracion' => '20',
            'cantidadVecesPorSemana' => '2',
            'creadaPorAdmin' => 1,
            'imagen' => 'fitball.jpg',
        ]);

        DB::table('actividad_fisicas')->insert([
            'nombre' => 'Baloncesto',
            'minutosDeDuracion' => '60',
            'cantidadVecesPorSemana' => '2',
            'creadaPorAdmin' => 1,
            'imagen' => 'baloncesto.jpg'
        ]);

        DB::table('actividad_fisicas')->insert([
            'nombre' => 'Futbol',
            'minutosDeDuracion' => '60',
            'cantidadVecesPorSemana' => '2',
            'creadaPorAdmin' => 1,
            'imagen' => 'football.jpg'
        ]);

        DB::table('actividad_fisicas')->insert([
            'nombre' => 'Yoga',
            'minutosDeDuracion' => '90',
            'cantidadVecesPorSemana' => '2',
            'creadaPorAdmin' => 1,
            'imagen' => 'yoga.jpg'
        ]);

        DB::table('actividad_fisicas')->insert([
            'nombre' => 'RáquetBol',
            'minutosDeDuracion' => '60',
            'cantidadVecesPorSemana' => '1',
            'creadaPorAdmin' => 1,
            'imagen' => 'raquet.jpg'
        ]);

        DB::table('actividad_fisicas')->insert([
            'nombre' => 'Natación',
            'minutosDeDuracion' => '40',
            'cantidadVecesPorSemana' => '3',
            'creadaPorAdmin' => 1,
            'imagen' => 'natacion.jpg'
        ]);

        $actividadFisica8 = \App\ActividadFisica::create([
            'nombre' => 'Zumba',
            'minutosDeDuracion' => '20',
            'cantidadVecesPorSemana' => '4',
            'creadaPorAdmin' => 1,
            'imagen' => 'zumba.jpg'
        ]);

        $actividadFisica9 = \App\ActividadFisica::create([
            'nombre' => 'Hooping',
            'minutosDeDuracion' => '30',
            'cantidadVecesPorSemana' => '4',
            'creadaPorAdmin' => 1,
            'imagen' => 'hooping.jpg'
        ]);

        $actividadFisica10 = \App\ActividadFisica::create([
            'nombre' => 'Patinaje',
            'minutosDeDuracion' => '60',
            'cantidadVecesPorSemana' => '4',
            'creadaPorAdmin' => 1,
            'imagen' => 'patinaje.jpg',
        ]);
    }
}
