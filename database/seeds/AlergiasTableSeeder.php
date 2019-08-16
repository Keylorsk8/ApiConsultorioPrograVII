<?php

use Illuminate\Database\Seeder;

class AlergiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alergias')->insert([
            'nombre' => 'Alergia al Polen',
            'categoria' => 'Respiratoria',
            'reaccion' => 'Conjuntivitis, Estornudos',
            'observacion' => '',
            'creadaPorAdmin' => '1',
            'imagen' => 'polen.jpg',
            'created_at' => '2018-07-08 01:27:58',
            'updated_at' => '2018-07-08 01:28:27',
        ]);

        DB::table('alergias')->insert([
            'nombre' => 'Alergia a los hongos',
            'categoria' => 'Contacto',
            'reaccion' => 'Conjuntivitis, Lagrimeo, Estornudos',
            'observacion' => '',
            'creadaPorAdmin' => '1',
            'imagen' => 'hongo.jpg'
        ]);

        DB::table('alergias')->insert([
            'nombre' => 'Alergia al Polvo',
            'categoria' => 'Respiratoria',
            'reaccion' => 'Renitis, Estornudos, Lagrimeo',
            'observacion' => '',
            'creadaPorAdmin' => '1',
            'imagen' => 'polvo.jpg'
        ]);

        DB::table('alergias')->insert([
            'nombre' => 'Alergia a Pescado',
            'categoria' => 'Alimenticia',
            'reaccion' => 'Hinchazon, Picason, tos, diarrea',
            'observacion' => '',
            'creadaPorAdmin' => '1',
            'imagen' => 'pescado.jpg'
        ]);

        DB::table('alergias')->insert([
            'nombre' => 'Alergia a la Leche',
            'categoria' => 'Alimenticia',
            'reaccion' => 'Ronchas, Vomito, Dificultad para respirar, Picazón',
            'observacion' => '',
            'creadaPorAdmin' => '1',
            'imagen' => 'leche.jpg',
        ]);

        DB::table('alergias')->insert([
            'nombre' => 'Alergia al huevo',
            'categoria' => 'Alimenticia',
            'reaccion' => 'Tos, Ronquera, Dificultad para respirar',
            'observacion' => '',
            'creadaPorAdmin' => '1',
            'imagen' => 'huevo.jpg'
        ]);

        DB::table('alergias')->insert([
            'nombre' => 'Urticaria',
            'categoria' => 'Cutanea',
            'reaccion' => 'Aparición de habones en la piel con mucho picor, Dolor adominal, Dificultad para respirar',
            'observacion' => '',
            'creadaPorAdmin' => '1',
            'imagen' => 'urticaria.jpg'
        ]);

        DB::table('alergias')->insert([
            'nombre' => 'Dermatitis',
            'categoria' => 'Cutanea',
            'reaccion' => 'Inflación de la piel, Heritemas, Pápulas, Costras',
            'observacion' => '',
            'creadaPorAdmin' => '1',
            'imagen' => 'dermatitis.jpg',
        ]);

        DB::table('alergias')->insert([
            'nombre' => 'Picaduras de Insectos',
            'categoria' => 'Cutanea',
            'reaccion' => 'Ampollas, Ronchas, Picazón',
            'observacion' => '',
            'creadaPorAdmin' => '1',
            'imagen' => 'insectos.jpg',
        ]);

        DB::table('alergias')->insert([
            'nombre' => 'Alergia al Mani',
            'categoria' => 'Alimenticia',
            'reaccion' => 'Hormigueo, Picazón, Congestión Nasal',
            'observacion' => '',
            'creadaPorAdmin' => '1',
            'imagen' => 'mani.jpg',
        ]);
    }
}
