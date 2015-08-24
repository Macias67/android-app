<?php
/**
 * Created by PhpStorm.
 * User: Luis Macias
 * Date: 26/07/2015
 * Time: 08:33 PM
 */

Route::group(['prefix' => 'cliente'], function () {
	Route::get('login', ['as' => 'login.cliente', 'uses' => 'LoginCliente@getLogin']);
	Route::post('auth', ['as' => 'auth.cliente', 'uses' => 'LoginCliente@postAuth']);
	Route::get('logout', ['as' => 'logout.cliente', 'uses' => 'LoginCliente@getLogout']);
});

Route::group(
	['middleware' => 'auth.cliente', 'namespace' => 'Cliente', 'prefix' => 'cliente'],
	function () {

        /*
       |--------------------------------------------------------------------------
       | PRINCIPAL
       |--------------------------------------------------------------------------
       */
        Route::get('/', ['as' => 'cliente', 'uses' => 'PrincipalCliente@index']);

        /*
        |--------------------------------------------------------------------------
        | NEGOCIO
        |--------------------------------------------------------------------------
        */
        Route::get('negocios', [
            'as' => 'negocios-cliente',
            'uses' => 'NegociosCliente@index'
        ]);

        Route::group(['prefix' => 'negocio'], function () {

            Route::get('perfil/{cliente_id?}/{accion?}', [
                'as' => 'cliente.negocio.perfil',
                'uses' => 'NegociosCliente@show'
            ])->where('cliente_id', '[0-9]+')
                ->where('accion', '[a-z]+');

            Route::get('nuevo', [
                'as' => 'cliente.negocio.create',
                'uses' => 'NegociosCliente@create'
            ]);

            Route::post('store', [
                'as' => 'cliente.negocio.store',
                'uses' => 'NegociosCliente@store'
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | PRODUCTOS
        |--------------------------------------------------------------------------
        */
        Route::get('productos', [
            'as' => 'productos-cliente',
            'uses' => 'ProductosCliente@index'
        ]);

        Route::group(['prefix' => 'producto'], function () {

            Route::get('nuevo', [
                'as' => 'cliente.producto.create',
                'uses' => 'ProductosCliente@create'
            ]);

            Route::post('store', [
                'as' => 'cliente.producto.store',
                'uses' => 'ProductosCliente@store'
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | USUARIOS
        |--------------------------------------------------------------------------
        */
        Route::get('usuarios', [
            'as' => 'usuarios-cliente',
            'uses' => 'UsuariosCliente@index'
        ]);

        /*
      |--------------------------------------------------------------------------
      | SERVICIOS
      |--------------------------------------------------------------------------
      */
        Route::get('servicios', [
            'as' => 'servicios',
            'uses' => 'ServiciosCliente@index'
        ]);

        Route::group(['prefix' => 'servicios'], function () {

            Route::get('nuevo', [
                'as' => 'cliente.servicios.create',
                'uses' => 'ServiciosCliente@create'
            ]);

            Route::post('store', [
                'as' => 'cliente.servicio.store',
                'uses' => 'ServiciosCliente@store'
            ]);
        });
        /*
        |--------------------------------------------------------------------------
        | PROMOCIONES
        |--------------------------------------------------------------------------
        */
        Route::get('promociones', [
            'as' => 'promociones',
            'uses' => 'PromocionesCliente@index'
        ]);

        /*
        |--------------------------------------------------------------------------
        | EVENTOS
        |--------------------------------------------------------------------------
        */
        Route::get('eventos', [
            'as' => 'eventos',
            'uses' => 'EventosCliente@index'
        ]);

        Route::group(['prefix' => 'eventos'], function () {

            Route::get('nuevo', [
                'as' => 'cliente.evento.create',
                'uses' => 'EventosCliente@create'
            ]);

            Route::post('store', [
                'as' => 'cliente.negocio.store',
                'uses' => 'EventosCliente@store'
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | FLYERS
        |--------------------------------------------------------------------------
        */
        Route::get('flyers', [
            'as' => 'flyers',
            'uses' => 'FlyersCliente@index'
        ]);

        /*
        |--------------------------------------------------------------------------
        | CATEGORIAS
        |--------------------------------------------------------------------------
        */
        Route::get('categorias', [
            'as' => 'categorias-cliente',
            'uses' => 'CategoriasCliente@index'
        ]);

        Route::post('categorias/json/{cliente_id?}', [
            'as' => 'cliente-table-json-categorias',
            'uses' => 'CategoriasCliente@datatable'
        ])->where('cliente_id', '[0-9]+');

        Route::get('categorias/select/{cliente_id?}', [
            'as' => 'cliente-select-categorias',
            'uses' => 'CategoriasCliente@select'
        ])->where('cliente_id', '[0-9]+');

        Route::group(['prefix' => 'categoria'], function () {
            Route::get('nuevo', [
                'as' => 'cliente.categoria.nuevo',
                'uses' => 'CategoriasCliente@create'
            ]);

            Route::post('store', [
                'as' => 'cliente.categoria.store',
                'uses' => 'CategoriasCliente@store'
            ]);
        });

        /*
       |--------------------------------------------------------------------------
       | PROMOCIONES
       |--------------------------------------------------------------------------
       */
        Route::get('promociones', [
            'as' => 'promociones-cliente',
            'uses' => 'PromocionesCliente@index'
        ]);

        Route::group(['prefix' => 'promocion'], function () {

            Route::get('nuevo', [
                'as' => 'cliente.promociones.create',
                'uses' => 'PromocionesCliente@create'
            ]);

            Route::post('store', [
                'as' => 'cliente.promociones.store',
                'uses' => 'PromocionesCliente@store'
            ]);
        });

	}
);