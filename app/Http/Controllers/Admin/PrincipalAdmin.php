<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;

class PrincipalAdmin extends BaseAdmin
{
    public function __construct()
    {
        parent::__construct();
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
