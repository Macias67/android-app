<?php
/**
 * Created by PhpStorm.
 * User: Julio
 * Date: 22/10/2015
 * Time: 10:20
 */


Route::group(
	['namespace' => 'ApiV1', 'prefix' => 'api/v1'],
	function ()
	{
		Route::group(
			['prefix' => 'clientes'],
			function ()
			{
				Route::get('/', [
					'as'   => 'apiV1-get-clientes',
					'uses' => 'ClienteApi@index'
				]);
			}
		);

		Route::group(
			['prefix' => 'usuarios'],
			function ()
			{
				Route::get('/', ['uses' => 'UsuarioApi@index']);
				Route::post('/', ['uses' => 'UsuarioApi@store']);
			}
		);
	}
);

