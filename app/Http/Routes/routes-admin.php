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

        Route::post('clientes/json', [
            'as' => 'table-json-clientes',
            'uses' => 'ClientesAdmin@datatable'
        ]);

        Route::group(['prefix' => 'cliente'], function () {

            Route::get('nuevo', [
                'as' => 'adm.nuevo.cliente',
                'uses' => 'ClientesAdmin@create'
            ]);

            Route::post('nuevo/password',['uses' => 'ClientesAdmin@genPassword']);

            Route::post('store', [
                'as' => 'adm.cliente.store',
                'uses' => 'ClientesAdmin@store'
            ]);

            Route::get('editar/{id}', [
                'as' => 'edita-cliente',
                'uses' => 'ClientesAdmin@edit'
            ])->where('id', '[0-9]+');
        });

        /*
       |--------------------------------------------------------------------------
       | PROPIETARIOS
       |--------------------------------------------------------------------------
       */
        Route::get('propietarios', [
            'as' => 'propietarios',
            'uses' => 'PropietarioAdmin@index'
        ]);

        Route::post('propietarios/json', [
            'as' => 'select-json-propietarios',
            'uses' => 'PropietarioAdmin@jsonSelect'
        ]);

        Route::group(['prefix' => 'propietario'], function () {
            Route::get('nuevo', [
                'as' => 'adm.nuevo.propietario',
                'uses' => 'PropietarioAdmin@create'
            ]);

            Route::post('store', [
                'as' => 'adm.propietario.store',
                'uses' => 'PropietarioAdmin@store'
            ]);
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
