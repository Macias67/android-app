<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Models\Cliente\Cliente;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class BaseCliente extends Controller
{
    protected $infoPropietario;

    protected $clientesRegistrados = [];

    public function __construct()
    {
        $this->infoPropietario = Auth::propietario()->user();
        $this->clientesRegistrados = Cliente::where('propietario_id', $this->infoPropietario->id)->get();

        $this->data['user'] = $this->infoPropietario;
        $this->data['clientesRegistrados'] = $this->clientesRegistrados;
    }
}
