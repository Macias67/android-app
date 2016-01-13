<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreatePropietario extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'nombre'   => 'required|max:45',
			'apellido' => 'required|max:45',
			'movil'    => 'required|max:14',
			'email'    => 'required|email|max:45|unique:cl_propietario,email',
			'password' => 'required'
		];
	}
}
