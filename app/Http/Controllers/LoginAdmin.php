<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class LoginAdmin extends Controller
{
    public function getLogin()
    {
        return $this->view('admin.login');
    }

    public function auth()
    {

    }

    public function getLogout()
    {

    }
}
