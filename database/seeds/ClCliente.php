<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ClCliente extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 30; $i++) {
            \DB::table('cl_clientes')->insert(array(
                'nombre' => $faker->word . $faker->word . $faker->word,
                'calle' => $faker->streetName,
                'numero' => $faker->buildingNumber,
                'colonia' => $faker->citySuffix,
                'codigo_postal' => $faker->postcode,
                'referencia' => $faker->paragraph,
                'latlng_gmaps' => $faker->latitude . ', ' . $faker->longitude,
                'ciudad_id' => $faker->randomElement($array = array('1', '2')),
                'propietario_id' => 1,
                'estatus' => $faker->randomElement($array = array('online', 'offline'))
            ));
        }


    }
}