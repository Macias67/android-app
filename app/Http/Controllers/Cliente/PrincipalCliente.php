<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests;
use App\Interfaces\CRUDInterface;

class PrincipalCliente extends BaseController implements CRUDInterface
{
    public function login()
    {
        return view('cliente.login');
    }

    public function index()
    {
        return view('admin.principal.principal');
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function read()
    {
        // TODO: Implement read() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
