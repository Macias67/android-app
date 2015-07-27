<?php

use Illuminate\Database\Seeder;

class AdmAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('adm_admin')->insert(
            [
                'nombre'     => 'Luis',
                'apellido'   => 'Macias',
                'genero'     => 'H',
                'movil'      => '(392) 941 8119',
                'email'      => 'luismacias.angulo@gmail.com',
                'password'   => bcrypt('qwerty'),
                'estatus'    => 'online',
                'privilegio' => 'admin'
            ]
        );
    }
}
