<?php
/**
 * Created by PhpStorm.
 * User: Luis Macias
 * Date: 27/07/2015
 * Time: 10:05 AM
 */

Route::group(
	['namespace' => 'Usuario'],
	function()
	{
		/*
		|--------------------------------------------------------------------------
		| PRINCIPAL
		|--------------------------------------------------------------------------
		*/
		Route::get('/', [
			'as'   => 'app.principal',
			'uses' => 'PrincipalUsuario@index'
		]);

		Route::match(['get', 'post'], 'quick-view/{cliente_id}', [
			'as'   => 'quick-view',
			'uses' => 'PrincipalUsuario@quickView'
		])->where('cliente_id', '[0-9a-zA-Z]+');

		/*
		|--------------------------------------------------------------------------
		| PERFIL NEGOCIO
		|--------------------------------------------------------------------------
		*/
		Route::get('{slug}', [
			'as'   => 'app.perfil.negocio',
			'uses' => 'PerfilNegocioUsuario@show'
		])->where('slug', '[a-z\-]+');

		/*
		|--------------------------------------------------------------------------
		| LOGIN & LOGOUT
		|--------------------------------------------------------------------------
		*/
		Route::get('signin', [
			'as'   => 'app.signin',
			'uses' => 'LoginUsuario@index'
		]);

		Route::post('auth', ['as' => 'app.auth', 'uses' => 'LoginUsuario@postAuth']);

		Route::get('signout', [
			'as'   => 'app.signout',
			'uses' => 'LoginUsuario@index'
		]);

		/*
		|--------------------------------------------------------------------------
		| REGISTRO
		|--------------------------------------------------------------------------
		*/
		Route::get('signup', [
			'as'   => 'app.registro',
			'uses' => 'RegistroUsuario@index'
		]);

		Route::post('go/user', [
			'as'   => 'app.registro.store',
			'uses' => 'RegistroUsuario@store'
		]);
	}
);
