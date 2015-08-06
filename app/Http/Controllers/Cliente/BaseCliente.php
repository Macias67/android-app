<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class BaseCliente extends Controller
{
    protected $infoCliente;

    public function __construct ()
    {
        $this->infoCliente         = Auth::cliente()->user();
        $this->data['user'] = $this->infoCliente;
    }
}
