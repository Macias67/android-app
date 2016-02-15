<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Cliente\Cliente;
use App\Http\Models\Usuario\Usuario;
use App\Http\Requests;
use App\Http\Requests\Usuario\CreateUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteApi extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json(['status' => 'ok', 'data' => Cliente::online()->get()->toArrayFull()], 200);
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
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
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
		}

		return response()->json( ['status' => true, 'data' => $usuario->all()], 200);
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
		// Buscamos un cliente por el id.
		$cliente = Cliente::find($id);

		// Si no existe ese cliente devolvemos un error.
		if (!$cliente)
		{
			// Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
			// En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
			return response()->json(['errors' => [['code' => 404, 'message' => 'No se encuentra el cliente con ese código.']]], 404);
		}
		elseif ($cliente->estatus == 'offline')
		{
			return response()->json(['status' => [['code' => 404, 'message' => 'El cliente no se encuentra disponible.']]], 404);
		}

		return response()->json(['status' => 'ok', 'data' => $cliente->toArrayFull()], 200);
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
