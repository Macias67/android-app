<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

class PrincipalAdmin extends Controller
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
