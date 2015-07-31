<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests;

class PrincipalCliente extends BaseController
{
    public function index ()
    {
        return $this->view('admin.principal.principal');
    }
}
