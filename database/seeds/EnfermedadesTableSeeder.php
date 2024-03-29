<?php

use Illuminate\Database\Seeder;

class EnfermedadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('enfermedads')->insert([
            'nombre' => 'Neumonía',
            'observaciones'=>'Inflamación con daño pulmonar.',
            'creadaPorAdmin'=>1,
            'imagen' => 'neumonia.jpg'
        ]);

        DB::table('enfermedads')->insert([
            'nombre' => 'Bronquitis',
            'observaciones'=>'Inflamación de los Bronquios.',
            'creadaPorAdmin'=>1,
            'imagen' => 'bronquitis.jpg'
        ]);

        DB::table('enfermedads')->insert([
            'nombre' => 'Depresión',
            'observaciones'=>'Afección de la capacidad para relacionarse, trabajar o afrontar el días.',
            'creadaPorAdmin'=>1,
            'imagen' => 'depresion.jpg'
        ]);

        DB::table('enfermedads')->insert([
            'nombre' => 'Faringitis',
            'observaciones'=>'Inflamación de la garganta o faringe.',
            'creadaPorAdmin'=>1,
            'imagen' => 'faringitis.jpg'
        ]);

        DB::table('enfermedads')->insert([
            'nombre' => 'Gastritis',
            'observaciones'=>'Inflamación de la mucosa que recubre las paredes del estomago.',
            'creadaPorAdmin'=>1,
            'imagen' => 'gastritis.jpg'
        ]);

        DB::table('enfermedads')->insert([
            'nombre' => 'Cistitis',
            'observaciones'=>'Infección de la orina, provocada por invasión de microorganismo en el tacto urinario.',
            'creadaPorAdmin'=>1,
            'imagen' => 'cistitis.jpg'
        ]);

        DB::table('enfermedads')->insert([
            'nombre' => 'Varicela',
            'observaciones'=>'Infección viral contagiosa.',
            'creadaPorAdmin'=>1,
            'imagen' => 'varicela.jpg'
        ]);

        DB::table('enfermedads')->insert([
            'nombre' => 'Cancer de Colon',
            'observaciones'=>'Crecimiento incontrolado de las células del colon.',
            'creadaPorAdmin'=>1,
            'imagen' => 'colon.jpg'
        ]);

        DB::table('enfermedads')->insert([
            'nombre' => 'Acidez Estomacal',
            'observaciones'=>'Quemasón o ardor que sube hasta la laringe.',
            'creadaPorAdmin'=>1,
            'imagen' => 'acidez.jpg'
        ]);

        DB::table('enfermedads')->insert([
            'nombre' => 'Torticolis',
            'observaciones'=>'Contracción muscular en la región del cuello.',
            'creadaPorAdmin'=>1,
            'imagen' => 'torticolis.jpg'
        ]);
    }
}
