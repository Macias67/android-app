<?php
/**
 * Created by PhpStorm.
 * User: Luis Macias
 * Date: 26/07/2015
 * Time: 02:48 AM
 */

Route::get(
    '/',
    function () {
        return view('admin.principal.principal');
    }
);