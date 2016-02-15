<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Models\Usuario\Usuario;
use App\Http\Requests\Usuario\CreateUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistroUsuario extends BaseUsuario
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$this->data['form_registro'] = [
			'route'        => 'app.registro.store',
			'id'           => 'form-register',
			'role'         => 'form',
			'autocomplete' => 'off'
		];

		return $this->view('usuario.registro');
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
	 * @param \App\Http\Requests\Usuario\CreateUsuario $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(CreateUsuario $request)
	{
		if ($request->ajax() && $request->wantsJson())
		{
			$usuario = new Usuario;
			$usuario->preparaDatos($request);
			if ($usuario->save())
			{

				$credenciales = ['email' => $request->get('email'), 'password' => $request->get('password')];
				if(Auth::usuario()->attempt($credenciales, true))
				{
					$usuario->ultima_sesion = date('Y-m-d H:i:s');
					$usuario->save();

					$response = [
						'exito'  => true,
						'titulo' => '',
						'texto'  => '',
						'url'    => route('app.principal')
					];
				} else {
					$response = [
						'exito'  => false,
						'titulo' => 'Datos incorrectos',
						'texto'  => 'datos erroneos',
						'url'    => route('app.principal')
					];
				}
			}
			else
			{
				$response = [
					'exito'  => false,
					'titulo' => 'No se registró',
					'texto'  => 'Parece que no hubo registro en la BD',
					'url'    => null
				];
			}

			return $this->responseJSON($response);
		}
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
