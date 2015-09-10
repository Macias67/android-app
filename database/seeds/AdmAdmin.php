<?php

use Hashids\Hashids;
use Illuminate\Database\Seeder;

class AdmAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        $hashid = new Hashids(md5('android.app'), 16);
        $unique_id = $hashid->encode(time());

        \DB::table('adm_admin')->insert(
            [
                'id' => $unique_id,
                'nombre'     => 'Luis',
                'apellido'   => 'Macias',
                'genero'     => 'H',
                'movil'      => '(392) 941 8119',
                'email'      => 'luismacias.angulo@gmail.com',
                'password'   => bcrypt('qwerty'),
                'estatus'    => 'online',
                'privilegio' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );
    }
}
