<?php

namespace App\Http\Collections;

use Illuminate\Database\Eloquent\Collection;

class ClienteCollection extends Collection
{

	/**
	 * ClienteCollection constructor.
	 */
	public function __construct(array $models = [])
	{
		parent::__construct($models);
	}

	/**
	 * Get the collection of items as a plain array.
	 *
	 * @return array
	 */
	public function toArrayFull()
	{
		foreach ($this->items as $cliente)
		{
			$array = parent::toArray();
			$array['logo'] = $cliente->logo();
			$ciudad = ['ciudad' => $cliente->ciudad->toArray()];
			$propietario = ['propietario' => $cliente->propietario->toArray()];
			$detalles = ['detalles' => $cliente->detalles->toArray()];
			$horarios = ['horarios' => $cliente->horarios->toArray()];
			$subcategorias = ['subcategorias' => $cliente->subcategorias->toArray()];

			$arraycategorias = [];
			foreach ($cliente->subcategorias as $subcategoria)
			{
				array_push($arraycategorias, $subcategoria->categoria->toArray());
			}

			$categorias = ['categorias' => $arraycategorias];
			$redes_sociales = ['redes_sociales' => $cliente->redesSociales->toArray()];

			return array_merge($array, $ciudad, $propietario, $detalles, $horarios, $categorias, $subcategorias, $redes_sociales);
		}

	}


}
