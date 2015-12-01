<?php

Route::group(
	['prefix' => 'global'],
	function ()
	{

		/*
		|--------------------------------------------------------------------------
		| SUBIDA LOGO DE NEGOCIO
		|--------------------------------------------------------------------------
		*/
		Route::post('upload/logo', [
			'as'   => 'global-upload-logo-negocio',
			'uses' => 'Cliente\NegociosCliente@uploadImage'
		]);

		Route::post('crop/logo', [
			'as'   => 'global-crop-logo-negocio',
			'uses' => 'Cliente\NegociosCliente@cropImage'
		]);

		/*
		|--------------------------------------------------------------------------
		| SUBCATEGORIAS DE NEGOCIOS
		|--------------------------------------------------------------------------
		*/
		Route::get('subcategorias/select/{id?}', [
			'as'   => 'global-select-subcategorias',
			'uses' => 'Admin\SubCategoriasAdmin@dropdown'
		])->where('id', '[0-9a-zA-Z]+');

		Route::get('subcategorias/select2/{id?}', [
			'as'   => 'global-select2-subcategorias',
			'uses' => 'Admin\SubCategoriasAdmin@jsonSelect2'
		])->where('id', '[0-9a-zA-Z]+');

		/*
		|--------------------------------------------------------------------------
		| TEST ANDROID
		|--------------------------------------------------------------------------
		*/
		Route::get('negocios/json', [
			'uses' => 'Android@index'
		]);

		Route::get('negocio/{id?}', [
			'uses' => 'Android@show'
		])->where('id', '[0-9a-zA-Z]+');

	});