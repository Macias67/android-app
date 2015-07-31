<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests;

class PrincipalAdmin extends BaseController
{
    public function index()
    {
        return $this->view('admin.principal.principal');
    }

}
