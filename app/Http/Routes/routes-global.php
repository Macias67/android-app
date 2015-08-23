<?php

Route::group(
    ['prefix' => 'global'],
    function () {

        /*
        |--------------------------------------------------------------------------
        | SUBIDA LOGO DE NEGOCIO
        |--------------------------------------------------------------------------
        */
        Route::post('upload/logo', [
            'as' => 'global-upload-logo-negocio',
            'uses' => 'Cliente\NegociosCliente@uploadImage'
        ]);

        Route::post('crop/logo', [
            'as' => 'global-crop-logo-negocio',
            'uses' => 'Cliente\NegociosCliente@cropImage'
        ]);

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