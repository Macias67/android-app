<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class BaseUsuario extends Controller
{
	protected $infoUsuario;

	public function __construct()
	{
		$this->infoAdmin = Auth::usuario()->user();
		$this->data['user'] = $this->infoAdmin;
	}
}
