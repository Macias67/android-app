<?php

namespace App\Http\Controllers;

use App\Http\Models\Cliente\Cliente;
use App\Http\Requests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class Android extends Controller
{

	var $logoDefault = 'assets/admin/pages/media/profile/profile_user.jpg';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$negocios = Cliente::orderBy('id', 'ASC')->get()->toArray();
		foreach ($negocios as $index => $negocio)
		{
			$negocios[$index]['logo'] = $this->_getLogo($negocio['id']);
		}

		return new JsonResponse(["negocios" => $negocios]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Request $request
	 * @param  int    $id
	 *
	 * @return Response
	 */
	public function show(Request $request, $id)
	{
		if (!is_null($cliente = Cliente::find($id)))
		{
			$data = [
				'cliente'        => $cliente->toArray(),
				'logo'           => $this->_getLogo($id),
				'subcategorias'  => $cliente->subcategorias->toArray(),
				'detalles'       => $cliente->detalles->toArray(),
				'redes-sociales' => $cliente->redesSociales->toArray(),
				'horarios'       => $cliente->horarios->toArray()
			];

			return new JsonResponse($data);
		}
		else
		{
			return new JsonResponse(['error' => 'No existe cliente'], 500);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request $request
	 * @param  int     $id
	 *
	 * @return Response
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
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	private function  _getLogo($id)
	{
		$files = File::files('img/cliente/' . $id . '/logo');
		$count = count($files);
		if ($count > 1 || $count == 0)
		{
			if ($count > 1)
			{
				foreach ($files as $file)
				{
					unlink($file);
				}
			}

			return $this->logoDefault;
		}
		else if ($count == 1)
		{
			list($width, $height) = getimagesize($files[0]);
			if ($width != 500 || $height != 500)
			{
				unlink($files[0]);

				return $this->logoDefault;
			}
			else if ($width == 500 && $height == 500)
			{
				return $files[0];
			}
		}
	}
}
