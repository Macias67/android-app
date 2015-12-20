<?php
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

/**
 * User: Luis
 * Date: 20/12/2015
 * Time: 02:16 PM
 */

function cleanPath($id_cliente)
{
	$dir = Config::get('path.temporal') . '/' . Config::get('path.clientes') . '/' . $id_cliente;

	if ((($files = @scandir($dir)) && count($files) <= 2))
	{
		File::deleteDirectory($dir);
	}
}