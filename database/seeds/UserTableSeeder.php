<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Gloriana',
            'primerApellido' => 'Vega',
            'segundoApellido' => 'Obregón',
            'email'=>'glorivega22@gmail.com',
            'password'=>crypt('usuario123',null),
            'sexo' => 'Femenino',
            'especialidad_id' => null,
            'rol_id'=>1
        ]);

        DB::table('users')->insert([
            'name' => 'Keylor',
            'primerApellido' => 'Martínez',
            'segundoApellido' => 'Rodríguez',
            'email'=>'keylorskatecr@gmail.com',
            'sexo' => 'Masculino',
            'especialidad_id' => null,
            'password'=>crypt('usuario123',null),
            'rol_id'=>1
        ]);


        DB::table('users')->insert([
            'name' => 'Carlos',
            'primerApellido' => 'Duran',
            'segundoApellido' => 'Rojas',
            'email'=>'doctor@gmail.com',
            'sexo' => 'Masculino',
            'especialidad_id' => 1,
            'especialidad' => 'Medicina General',
            'password'=>crypt('usuario123',null),
            'rol_id'=>2
        ]);

        DB::table('users')->insert([
            'name' => 'Jean Paul',
            'primerApellido' => 'Rojas',
            'segundoApellido' => 'Morales',
            'email'=>'jprojas@gmail.com',
            'password'=>crypt('usuario123',null),
            'sexo' => 'Otro',
            'especialidad_id' => null,
            'rol_id'=>3
        ]);
    }
}
