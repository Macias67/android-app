<?php
/**
 * Created by PhpStorm.
 * User: Luis Macias
 * Date: 26/07/2015
 * Time: 08:33 PM
 */

Route::get('cliente/login', ['as' => 'login-cliente', 'uses' => 'Admin\PrincipalAdmin@login']);

Route::group(
    ['middleware' => 'auth.cliente', 'namespace' => 'Cliente'],
    function () {

        // Principal
        Route::get(
            'cliente',
            [
                'as'   => 'cliente',
                'uses' => 'Cliente\PrincipalCliente@index'
            ]
        );

    }
);