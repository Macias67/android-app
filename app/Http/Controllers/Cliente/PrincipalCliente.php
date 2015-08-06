<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Requests;

class PrincipalCliente extends BaseCliente
{
    public function index ()
    {
        return $this->view('cliente.principal.principal');
    }
}
