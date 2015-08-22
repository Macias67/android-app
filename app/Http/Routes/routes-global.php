<?php

Route::group(
    ['prefix' => 'global'],
    function () {
        /*
        |--------------------------------------------------------------------------
        | SUBCATEGORIAS DE NEGOCIOS
        |--------------------------------------------------------------------------
        */
        Route::get('subcategorias/select/{id?}', [
            'as' => 'global-select-subcategorias',
            'uses' => 'Admin\SubCategoriasAdmin@dropdown'
        ])->where('id', '[0-9]+');
    });