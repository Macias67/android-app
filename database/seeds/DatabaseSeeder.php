<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(AdmAdmin::class);
        $this->call(CLPropietario::class);
        $this->call(AdmCiudades::class);
        $this->call(AdmCategorias::class);

        Model::reguard();
    }
}
