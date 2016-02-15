<?php
/**
 * Created by PhpStorm.
 * User: Julio
 * Date: 22/10/2015
 * Time: 10:20
 */


Route::group(
	['namespace' => 'Api', 'prefix' => 'api'],
	function ()
	{

		/*
		|--------------------------------------------------------------------------
		| CLIENTE
		|--------------------------------------------------------------------------
		*/
		Route::get('clientes', [
			'as' => 'get-clientes',
			'uses' => 'ClienteApi@index'
		]);

		Route::post('cliente/store', [
			'as' => 'store-cliente',
			'uses' => 'ClienteApi@store'
		]);

		Route::get('cliente/{id_cliente?}', [
		        'as' => 'get-cliente',
			'uses' => 'ClienteApi@show'
		])->where('id_cliente', '[0-9a-zA-Z]+');


		/*
		|--------------------------------------------------------------------------
		| CLIENTE
		|--------------------------------------------------------------------------
		*/
		Route::get('propietario', [
			'uses' => 'PropietarioApi@index'
		]);

		Route::get('propietario/{id_propietario?}', [
			'uses' => 'PropietarioApi@show'
		])->where('id_propietario', '[0-9a-zA-Z]+');

		Route::get('propietario/{id_propietario?}/negocio', [
			'uses' => 'PropietarioNegocioApi@index'
		])->where('id_propietario', '[0-9a-zA-Z]+');

		Route::get('propietario/{id_propietario?}/negocio/{id_negocio}', [
			'uses' => 'PropietarioNegocioApi@show'
		])->where('id_propietario', '[0-9a-zA-Z]+')
		     ->where('id_negocio', '[0-9a-zA-Z]+');

		/*
		|--------------------------------------------------------------------------
		| EVENTOS
		|--------------------------------------------------------------------------
		*/
		Route::get('eventos', [
			'uses' => 'EventosApi@index'
		]);
	}
);

