<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use App\Http\Models\Usuario\Usuario;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioApi extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
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
	 * @return \Illuminate\Http\Response
	 */
	public function store(Requests\Usuario\CreateUsuario $request)
	{
		$usuario = new Usuario;
		$usuario->preparaDatos($request);
		if ($usuario->save())
		{
			$credenciales = ['email' => $request->get('email'), 'password' => $request->get('password')];
			if (Auth::usuario()->attempt($credenciales, true))
			{
				$usuario->ultima_sesion = date('Y-m-d H:i:s');
				$usuario->save();
			}

			return response()->json(['status' => true, 'data' => $request->all()], 200, [], JSON_PRETTY_PRINT);
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
