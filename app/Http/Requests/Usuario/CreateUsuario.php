<?php

namespace App\Http\Requests\Usuario;

use App\Http\Requests\Request;

class CreateUsuario extends Request
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
			'nombre'           => 'required|max:45',
			'apellido'         => 'required|max:45',
			'fecha_nacimiento' => 'required|date_format:d/m/Y',
			'email'            => 'required|email|max:45|unique:usr_usuarios,email',
			'sexo'             => 'required|in:H,M',
			'password'         => 'required'
		];
	}
}
