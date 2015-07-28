<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class LoginAdmin extends Controller
{
    public function getLogin()
    {
        return $this->view('admin.login');
    }

    public function getAuth()
    {

    }

    public function getLogout()
    {

    }
}
