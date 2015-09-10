<?php
use Hashids\Hashids;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ClCliente extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $hashid = new Hashids(md5('android.app'), 16);
        $unique_id = $hashid->encode(time());

        for ($i = 1; $i < 31; $i++) {
            \DB::table('cl_clientes')->insert(array(
                'nombre' => $faker->word . $faker->name . $faker->word,
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

            \DB::table('cl_categoria_negocio')->insert(array(
                'cliente_id' => $i,
                'subcategoria_id' => $faker->numberBetween($min = 1, $max = 382)
            ));
        }


    }
}