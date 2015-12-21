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
			'as'   => 'principal',
			'uses' => 'PrincipalUsuario@index'
		]);

		Route::post('quick-view', [
			'as'   => 'quick-view',
			'uses' => 'PrincipalUsuario@quickView'
		]);
	}
);
