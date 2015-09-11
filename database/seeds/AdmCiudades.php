<?php

use Hashids\Hashids;
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
        $hashid = new Hashids(microtime(TRUE), 16);
        \DB::table('adm_ciudades')->insert(
            [
                'id' => $hashid->encode(1),
                'ciudad'       => 'Ocotlán',
                'estado'       => 'Jalisco',
                'latlng_gmaps' => '20.3417485, -102.76523259999999',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );
        \DB::table('adm_ciudades')->insert(
            [
                'id' => $hashid->encode(2),
                'ciudad'       => 'Chapala',
                'estado'       => 'Jalisco',
                'latlng_gmaps' => '20.3051576,-103.18460160000001',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );
    }
}
