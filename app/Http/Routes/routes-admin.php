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
       | PRINCIPAL
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

            Route::post('nuevo/password',['uses' => 'PropietarioAdmin@genPassword']);

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
            'as' => 'usuarios-admin',
            'uses' => 'UsuariosAdmin@index'
        ]);

        /*
       |--------------------------------------------------------------------------
       | CIUDADES
       |--------------------------------------------------------------------------
       */
        Route::get('ciudades', [
            'as' => 'ciudades',
            'uses' => 'CiudadesAdmin@index'
        ]);

        /*
        |--------------------------------------------------------------------------
        | CATEGORIAS
        |--------------------------------------------------------------------------
        */
        Route::get('categorias', [
            'as' => 'categorias-admin',
            'uses' => 'CategoriasAdmin@index'
        ]);

        Route::post('categorias/json', [
            'as' => 'table-json-categorias',
            'uses' => 'CategoriasAdmin@datatable'
        ]);

        Route::post('categorias/select2', [
            'as' => 'select2-json-categorias',
            'uses' => 'CategoriasAdmin@select2'
        ]);

        Route::group(['prefix' => 'categoria'], function () {

            Route::get('nuevo', [
                'as' => 'adm.categoria.nuevo',
                'uses' => 'CategoriasAdmin@create'
            ]);

            Route::post('store', [
                'as' => 'adm.categoria.store',
                'uses' => 'CategoriasAdmin@store'
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | SUBCATEGORIAS
        |--------------------------------------------------------------------------
        */

        Route::post('subcategorias/json/{id?}', [
            'as' => 'table-json-subcategorias',
            'uses' => 'SubCategoriasAdmin@datatable'
        ])->where('id', '[0-9]+');

        // Función global
        //Route::get('subcategorias/select/{id?}', [
        //    'as' => 'select-subcategorias',
        //    'uses' => 'SubCategoriasAdmin@dropdown'
        //])->where('id', '[0-9]+');

        Route::group(['prefix' => 'subcategoria'], function () {
            Route::post('store', [
                'as' => 'admin.subcategoria.store',
                'uses' => 'SubCategoriasAdmin@store'
            ]);
        });

    }
);
