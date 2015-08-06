<?php

use Illuminate\Database\Seeder;

class AdmCiudades extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        \DB::table('adm_ciudades')->insert(
            [
                'ciudad'       => 'Ocotlán',
                'estado'       => 'Jalisco',
                'latlng_gmaps' => '20.3417485, -102.76523259999999',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        \DB::table('adm_ciudades')->insert(
            [
                'ciudad'       => 'Chapala',
                'estado'       => 'Jalisco',
                'latlng_gmaps' => '20.3051576,-103.18460160000001',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );
    }
}
