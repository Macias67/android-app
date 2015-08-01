<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests;

class PrincipalAdmin extends BaseController
{

    public function __construct()
    {
        $this->data['activo_inicio'] = TRUE;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->view('admin.principal.index');
    }

}
