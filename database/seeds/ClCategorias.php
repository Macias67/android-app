<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ClCategorias extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 30; $i++) {
            \DB::table('cl_categorias')->insert(array(
                'cliente_id' => $faker->numberBetween($min = 1, $max = 30),
                'categoria' => $faker->word
            ));
        }


    }
}