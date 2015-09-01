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

            Route::get('{id?}', [
                'as' => 'cliente.producto.show',
                'uses' => 'ProductosCliente@show'
            ])->where('id', '[0-9]+');

            Route::post('update', [
                'as' => 'cliente.producto.update',
                'uses' => 'ProductosCliente@update'
            ]);


            Route::get('json/{id?}', [
                'as' => 'cliente.producto.procutos-json',
                'uses' => 'ProductosCliente@getProductosJson'
            ])->where('id', '[0-9]+');

            Route::post('upload/logo', [
                'as' => 'global-upload-logo-producto',
                'uses' => 'ProductosCliente@uploadImage'
            ]);

            Route::post('crop/logo', [
                'as' => 'global-crop-logo-producto',
                'uses' => 'ProductosCliente@cropImage'
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
            'as' => 'servicios-cliente',
            'uses' => 'ServiciosCliente@index'
        ]);

        Route::group(['prefix' => 'servicios'], function () {

            Route::get('nuevo', [
                'as' => 'cliente.servicios.create',
                'uses' => 'ServiciosCliente@create'
            ]);

            Route::post('store', [
                'as' => 'cliente.servicios.store',
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
            'as' => 'eventos-cliente',
            'uses' => 'EventosCliente@index'
        ]);

        Route::group(['prefix' => 'eventos'], function () {

            Route::get('nuevo', [
                'as' => 'cliente.evento.create',
                'uses' => 'EventosCliente@create'
            ]);

            Route::post('store', [
                'as' => 'cliente.evento.store',
                'uses' => 'EventosCliente@store'
            ]);

            Route::post('update', [
                'as' => 'cliente.evento.update',
                'uses' => 'EventosCliente@update'
            ]);

            Route::get('{id?}', [
                'as' => 'cliente.evento.show',
                'uses' => 'EventosCliente@show'
            ])->where('id', '[0-9]+');

            Route::post('upload/logo', [
                'as' => 'global-upload-logo-evento',
                'uses' => 'EventosCliente@uploadImage'
            ]);

            Route::post('crop/logo', [
                'as' => 'global-crop-logo-evento',
                'uses' => 'EventosCliente@cropImage'
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

            Route::get('editar', [
                'as' => 'cliente.promociones.edit',
                'uses' => 'PromocionesCliente@create'
            ]);

            Route::post('store', [
                'as' => 'cliente.promociones.store',
                'uses' => 'PromocionesCliente@store'
            ]);
        });

	}
);