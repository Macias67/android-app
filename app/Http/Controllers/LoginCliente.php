<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador para LoginCliente
 *
 * @author  Luis Macias
 * @package App\Http\Controllers
 */
class LoginCliente extends Controller
{
    use AuthController;

    /**
     * Nombre de la vistas y modelos a usar
     *
     * @var string
     */
    private $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth::propietario();
    }
}
