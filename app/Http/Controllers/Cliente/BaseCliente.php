<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Models\Cliente\Cliente;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

/**
 * Clase abstracta para todos los controladores del Cliente
 *
 * @package App\Http\Controllers\Cliente
 * @author  Luis Macias
 */
class BaseCliente extends Controller
{
	/**
	 * @var Object Modelo con la infromación del propietario logueado
	 */
	protected $infoPropietario;

	/**
	 * @var array Array de modelos con los clientes registrados por el
	 * propietario logueado.
	 */
	protected $clientesRegistrados = [];

	public function __construct()
	{
		$this->infoPropietario = Auth::propietario()->user();
		$this->clientesRegistrados = Cliente::where('propietario_id', $this->infoPropietario->id)->get();

		$this->data['user'] = $this->infoPropietario;
		$this->data['clientesRegistrados'] = $this->clientesRegistrados;
	}
}
