<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class LoginCliente extends Controller
{
    public function vistaLogin()
    {
        return $this->view('admin.login');
    }
}
