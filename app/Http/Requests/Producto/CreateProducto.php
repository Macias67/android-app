<?php

namespace App\Http\Requests\Producto;

use App\Http\Models\Cliente\Cliente;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class CreateProducto extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$cliente_id = $this->get('cliente_id');
		if (!is_null($cliente = Cliente::find($cliente_id)))
		{
			return ($cliente->propietario->id == Auth::propietario()->user()->id);
		}
		else
		{
			return false;
		}
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'cliente_id'        => 'required|exists:cl_clientes,id|alpha_num|size:16',
			'categoria_id'      => 'required|exists:cl_categorias,id|alpha_num|size:16',
			'nombre'            => 'required|max:45',
			'slug'              => 'required|max:45|alpha_dash',
			'descripcion'       => 'required|max:255',
			'descripcion_corta' => 'required|max:45',
			'disp_inicio'       => 'required|date_format:Y-m-d H:i:s',
			'disp_fin'          => 'required|date_format:Y-m-d H:i:s',
			'precio'            => 'required|numeric',
			'cantidad'          => 'required|integer'
		];
	}
}
