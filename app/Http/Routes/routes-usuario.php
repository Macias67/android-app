<?php
/**
 * Created by PhpStorm.
 * User: Luis Macias
 * Date: 27/07/2015
 * Time: 10:05 AM
 */

Route::get(
	'/',
	function ()
	{
		$files = Storage::files('cliente/qwerty/logo');
		dd(storage_path());
	}
);