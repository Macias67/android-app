<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class BaseUsuario extends Controller
{
	protected $usuario;

	public function __construct()
	{
		$this->usuario = Auth::usuario();

		$this->data['isGuest'] = $this->usuario->guest();
		$this->data['isAuth'] = $this->usuario->check();
		$this->data['user'] = $this->usuario->user();
	}
}
