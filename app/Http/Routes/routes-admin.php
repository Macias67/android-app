<?php
/**
 * Created by PhpStorm.
 * User: Luis Macias
 * Date: 26/07/2015
 * Time: 02:48 AM
 */

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', ['as' => 'login.admin', 'uses' => 'LoginAdmin@getLogin']);
    Route::post('auth', ['as' => 'auth.admin', 'uses' => 'LoginAdmin@postAuth']);
    Route::get('logout', ['as' => 'logout.admin', 'uses' => 'LoginAdmin@getLogout']);
});

Route::group(
    ['middleware' => 'auth.admin', 'namespace' => 'Admin', 'prefix' => 'admin'],
    function () {

        /*
       |--------------------------------------------------------------------------
       | Principal
       |--------------------------------------------------------------------------
       */
        Route::get('/', ['as' => 'admin', 'uses' => 'PrincipalAdmin@index']);

        /*
        |--------------------------------------------------------------------------
        | CLIENTE
        |--------------------------------------------------------------------------
        */
        Route::get('clientes', [
            'as' => 'clientes',
            'uses' => 'ClientesAdmin@index'
        ]);

        Route::post('clientes/json', array(
            'as' => 'table-json-clientes',
            'uses' => 'ClientesAdmin@jsonListado'
        ));

        Route::group(['prefix' => 'cliente'], function () {
            Route::get('nuevo', array(
                'as' => 'adm.nuevo.cliente',
                'uses' => 'ClientesAdmin@create'
            ));

            Route::get('editar/{id}', array(
                'as' => 'edita-cliente',
                'uses' => 'ClientesAdmin@edit'
            ))->where('id', '[0-9]+');
        });

        /*
        |--------------------------------------------------------------------------
        | USUARIOS
        |--------------------------------------------------------------------------
        */
        Route::get('usuarios', [
            'as' => 'usuarios',
            'uses' => 'UsuariosAdmin@index'
        ]);

        /*
       |--------------------------------------------------------------------------
       | CIUDADES
       |--------------------------------------------------------------------------
       */
        Route::get('ciduades', [
            'as' => 'ciudades',
            'uses' => 'CiudadesAdmin@index'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Categorias
        |--------------------------------------------------------------------------
        */
        Route::get('categorias', [
            'as' => 'categorias',
            'uses' => 'CategoriasAdmin@index'
        ]);

    }
);
