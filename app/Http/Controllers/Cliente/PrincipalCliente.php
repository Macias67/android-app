<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Requests;

class PrincipalCliente extends BaseCliente
{
	public function __construct()
	{
		parent::__construct();
		$this->data['activo_inicio'] = true;
	}

	public function index()
	{
		return $this->view('cliente.principal.index');
	}
}
