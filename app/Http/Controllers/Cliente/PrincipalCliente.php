<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Requests;

class PrincipalCliente extends Controller
{
    public function login()
    {
        return view('loginAdmin');
    }

    public function index()
    {
        return view('admin.principal.principal');
    }
}
