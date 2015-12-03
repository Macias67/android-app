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
		$arrays = [];
		foreach ($this->items as $cliente)
		{
			$cliente_array = $cliente->toArray();
			$cliente_array['logo'] = $cliente->logo();
			$cliente_array['ciudad'] = $cliente->ciudad->toArray();
			$cliente_array['propietario'] = $cliente->propietario->toArray();
			$cliente_array['detalles'] = $cliente->detalles->toArray();
			$cliente_array['horarios'] = $cliente->horarios->toArray();
			$cliente_array['subcategorias'] = $cliente->subcategorias->toArray();

			$arraycategorias = [];
			foreach ($cliente->subcategorias as $subcategoria)
			{
				array_push($arraycategorias, $subcategoria->categoria->toArray());
			}

			$cliente_array['categorias'] = $arraycategorias;
			$cliente_array['redes_sociales'] = $cliente->redesSociales->toArray();
			array_push($arrays, $cliente_array);
		}

		return $arrays;
	}


}
