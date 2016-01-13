<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Models\Usuario\Usuario;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginUsuario extends BaseUsuario
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$this->data['form_login'] = [
			'route'        => 'app.auth',
			'id'           => 'form-signin',
			'role'         => 'form',
			'autocomplete' => 'off'
		];

		return $this->view('usuario.sign-in');
	}

	public function postAuth(Request $request)
	{
		if ($request->ajax() && $request->wantsJson())
		{
			$validator = Validator::make(
				$request->all(),
				[
					'email'    => 'required|email|max:45',
					'password' => 'required'
				]
			);

			if ($validator->passes())
			{
				$credenciales = ['email' => $request->get('email'), 'password' => $request->get('password')];

				if ($this->usuario->attempt($credenciales, true))
				{
					$model = new Usuario;
					$admin = $model::find($this->usuario->user()->id);
					$admin->ultima_sesion = date('Y-m-d H:i:s');
					$admin->save();

					$response = [
						'exito'  => true,
						'titulo' => 'Bienvenido ' . $this->usuario->user()->NombreCompleto(),
						'texto'  => 'Espere unos momentos...',
						'url'    => route('app.principal')
					];
				}
				else
				{
					$response = [
						'exito'  => false,
						'titulo' => 'No existen datos.',
						'texto'  => 'El email o la contraseña son incorrectos.',
						'url'    => null
					];
				}
			}
			else
			{
				$errores = $validator->errors()->all();
				foreach ($errores as $index => $error)
				{
					$errores[$index] = ucfirst($error);
				}

				$response = [
					'exito'   => false,
					'titulo'  => 'Ups...',
					'texto'   => 'Hay problemas con los datos. ',
					'url'     => null,
					'errores' => $errores
				];
			}

			return $this->responseJSON($response);
		}
		else
		{
			return response('Unauthorized.', 401);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
