<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ClProductos extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i < 31; $i++) {
            \DB::table('cl_productos')->insert(array(
                'cliente_id' => $faker->numberBetween($min = 1, $max = 30),
                'categoria_id' => $faker->numberBetween($min = 1, $max = 30),
                'nombre' => $faker->word . $faker->name . $faker->word,
                'slug' => 'nombre',
                'descripcion' => $faker->paragraph($nbSentences = 3),
                'descripcion_corta' => $faker->paragraph($nbSentences = 1),
                'disp_inicio' => $faker->dateTime,
                'disp_fin' => $faker->dateTime,
                'estatus' => $faker->randomElement($array = array('online', 'offline')),
                'precio' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100000),
                'cantidad' => $faker->numberBetween($min = 1, $max = 99999999999)
            ));
        }

    }

}