<?php
/**
 * Created by PhpStorm.
 * User: Julio
 * Date: 22/10/2015
 * Time: 10:20
 */


Route::group(
    ['namespace' => 'Api', 'prefix' => 'api'],
    function () {

        Route::get('cliente', [
            'uses' => 'ClienteApi@index'
        ]);

        Route::get('cliente/{id_cliente?}',[
            'uses'=> 'ClienteApi@show'
        ])->where('id_cliente', '[0-9a-zA-Z]+');

        Route::get('propietario',[
            'uses'=> 'PropietarioApi@index'
        ]);

        Route::get('propietario/{id_propietario?}',[
            'uses'=> 'PropietarioApi@show'
        ])->where('id_propietario', '[0-9a-zA-Z]+');

        Route::get('propietario/{id_propietario?}/negocio',[
            'uses'=> 'PropietarioNegocioApi@index'
        ])->where('id_propietario', '[0-9a-zA-Z]+');

        Route::get('propietario/{id_propietario?}/negocio/{id_negocio}',[
            'uses'=> 'PropietarioNegocioApi@show'
        ])->where('id_propietario', '[0-9a-zA-Z]+')
          ->where('id_negocio', '[0-9a-zA-Z]+');

        Route::get('eventos',[
            'uses' => 'EventosApi@index'
        ]);
    }
);

