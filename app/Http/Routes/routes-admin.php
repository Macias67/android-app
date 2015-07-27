<?php
/**
 * Created by PhpStorm.
 * User: Luis Macias
 * Date: 26/07/2015
 * Time: 02:48 AM
 */

Route::get('admin/login', ['as' => 'login-admin', 'uses' => 'Admin\PrincipalAdmin@login']);

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
