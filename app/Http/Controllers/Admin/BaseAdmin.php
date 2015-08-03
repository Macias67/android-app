<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class BaseAdmin extends Controller
{
    protected $admin;

    public function __construct ()
    {
        $this->admin         = Auth::admin()->user();
        $this->data['admin'] = $this->admin;
    }
}
