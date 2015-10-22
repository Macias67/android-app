<?php

use Hashids\Hashids;
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
        $hashid = new Hashids(md5('android.app'), 16);
        $unique_id = $hashid->encode(time());
        $unique_id2 = $hashid->encode(date('m'));
        \DB::table('cl_propietario')->insert(
            [
                'id' => $unique_id,
                'nombre' => 'Juan',
                'apellido' => 'Angulo',
                'genero' => 'H',
                'movil' => '(392) 941 8119',
                'email' => 'juan.macias@gmail.com',
                'password' => bcrypt('qwerty'),
                'estatus' => 'online'
            ]
        );

        \DB::table('cl_propietario')->insert(
        [
            'id' => $unique_id2,
            'nombre' => 'Jesús',
            'apellido' => 'de Nazaret',
            'genero' => 'H',
            'movil' => '(777) 777 7777',
            'email' => 'jesucristo@gmail.com',
                'password' => bcrypt('qwerty'),
            'estatus' => 'online'
        ]
        );
    }
}
