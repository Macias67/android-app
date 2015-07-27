<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests;
use App\Interfaces\CRUDInterface;

class PrincipalAdmin extends BaseController implements CRUDInterface
{

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
