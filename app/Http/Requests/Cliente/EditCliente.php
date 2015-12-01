<?php

namespace App\Http\Requests\Cliente;

use App\Http\Models\Cliente\Cliente;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class EditCliente
 *
 * @author  Luis Macias
 * @package App\Http\Requests\Cliente
 */
class EditCliente extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$id_cliente = $this->get('id');
		if (!is_null($cliente = Cliente::find($id_cliente)))
		{
			$propietario_id = $this->get('propietario_id');
			$auth_id = Auth::propietario()->user()->id;

			return ($auth_id == $propietario_id) && ($cliente->propietario->id == $propietario_id);
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
		$tipo = $this->segment(4);

		switch ($tipo)
		{
			case 'principal':
				return $this->getRulesCliente();
				break;
			case 'adicional':
				return $this->getRulesClienteDetalles();
				break;
			case 'redessociales':
				return $this->getRulesClienteRedesSociales();
				break;
			case 'horarios':
				return $this->getRulesClienteHorarios();
				break;
		}

	}

	public function getRulesCliente()
	{
		return [
			'id'             => 'required|exists:cl_clientes,id|alpha_num|size:16',
			'nombre'         => 'required|max:45|unique:cl_clientes,nombre,' . $this->get('id'),
			'calle'          => 'required|max:45',
			'numero'         => 'required|max:5',
			'colonia'        => 'required|max:45',
			'codigo_postal'  => 'required|size:5',
			'referencia'     => 'max:140',
			'latitud'        => 'max:45',
			'longitud'       => 'max:45',
			'ciudad_id'      => 'exists:adm_ciudades,id|alpha_num|size:16',
			'propietario_id' => 'required|exists:cl_clientes,propietario_id|alpha_num|size:16',
			'categoria1' => 'required|exists:adm_categorias,id|alpha_num|size:16',
		        'subcategoria1' => 'required|exists:adm_subcategorias,id|alpha_num|size:16',
		];
	}

	public function getRulesClienteDetalles()
	{
		return [
			'id'             => 'required|exists:cl_clientes,id|alpha_num|size:16',
			'telefono1'      => 'max:14',
			'telefono2'      => 'max:14',
			'telefono3'      => 'max:14',
			'descripcion'    => 'max:200',
			'slogan'         => 'max:140',
			'website'        => 'max:45|url',
			'email_negocio'  => 'max:45|email',
			'propietario_id' => 'required|exists:cl_clientes,propietario_id|alpha_num|size:16'
		];
	}

	public function getRulesClienteRedesSociales()
	{
		return [
			'id'             => 'required|exists:cl_clientes,id|alpha_num|size:16',
			'facebook'       => 'max:100|url',
			'twitter'        => 'max:100|url',
			'instagram'      => 'max:100|url',
			'youtube'        => 'max:100|url',
			'googleplus'     => 'max:100|url',
			'propietario_id' => 'required|exists:cl_clientes,propietario_id|alpha_num|size:16'
		];
	}

	public function getRulesClienteHorarios()
	{
		return [
			'id'             => 'required|exists:cl_clientes,id|alpha_num|size:16',
			'dias'           => 'required|array',
			'abre'           => 'required|date_format:H:i',
			'cierra'         => 'required|date_format:H:i',
			'propietario_id' => 'required|exists:cl_clientes,propietario_id|alpha_num|size:16'
		];
	}
}