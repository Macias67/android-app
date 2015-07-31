<?php
/**
 * Created by PhpStorm.
 * User: Luis Macias
 * Date: 26/07/2015
 * Time: 08:33 PM
 */

Route::controller(
    'cliente',
    'LoginCliente',
    [
        'getLogin' => 'login.cliente',
        'postAuth' => 'auth.cliente',
        'getLogout' => 'logout.cliente',
    ]
);

Route::group(
    ['middleware' => 'auth.cliente', 'namespace' => 'Cliente'],
    function () {

        // Principal
        Route::get(
            'cliente',
            [
                'as' => 'cliente',
                'uses' => 'PrincipalCliente@index'
            ]
        );

    }
);