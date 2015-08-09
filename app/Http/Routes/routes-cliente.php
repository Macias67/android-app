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
        | USUARIOS
        |--------------------------------------------------------------------------
        */
        Route::get('usuarios', [
            'as' => 'usuarios-cliente',
            'uses' => 'UsuariosCliente@index'
        ]);

        /*
       |--------------------------------------------------------------------------
       | PRODUCTOS
       |--------------------------------------------------------------------------
       */
        Route::get('productos', [
            'as' => 'productos',
            'uses' => 'ProductosCliente@index'
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
            'as' => 'categorias',
            'uses' => 'CategoriasCliente@index'
        ]);

	}
);