<?php

use Illuminate\Database\Seeder;

class CLPropietario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('cl_propietario')->insert(
            [
                'nombre' => 'Juan',
                'apellido' => 'Angulo',
                'genero' => 'H',
                'movil' => '(392) 941 8119',
                'email' => 'juan.macias@gmail.com',
                'password' => bcrypt('qwerty'),
                'estatus' => 'online'
            ]
        );
    }
}
