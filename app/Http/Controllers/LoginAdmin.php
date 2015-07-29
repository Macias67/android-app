<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginAdmin extends Controller
{
    public function getLogin()
    {
        return $this->view('admin.login');
    }

    public function postAuth(Request $request)
    {
        dd($request);
    }

    public function getLogout()
    {

    }
}
