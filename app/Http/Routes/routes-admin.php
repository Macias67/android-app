<?php
/**
 * Created by PhpStorm.
 * User: Luis Macias
 * Date: 26/07/2015
 * Time: 02:48 AM
 */

Route::controller(
    'admin',
    'LoginAdmin',
    [
        'getLogin'  => 'login.admin',
        'postAuth'      => 'auth.admin',
        'getLogout' => 'logout.admin',
    ]
);

Route::group(
    ['middleware' => 'auth.admin', 'namespace' => 'Admin'],
    function () {

        // Principal
        Route::get(
            'admin',
            [
                'as'   => 'admin',
                'uses' => 'PrincipalAdmin@index'
            ]
        );

        Route::get(
            'admin/hola',
            function () {
                return 'ola';
            }
        );

    }
);
