<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EspecialidadesTableSeeder::class);
        $this->call(RolTableSeeder::class);
        $this->call(AlergiasTableSeeder::class);
        $this->call(ActividadesFisicasTableSeeder::class);
        $this->call(EnfermedadesTableSeeder::class);
        $this->call(TipoSangreTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(PerfilTableSeeder::class);
        $this->call(ExpedienteTableSeeder::class);
    }
}
