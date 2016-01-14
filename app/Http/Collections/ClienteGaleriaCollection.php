<?php
/**
 * User: Luis
 * Date: 21/12/2015
 * Time: 04:01 PM
 */

namespace App\Http\Collections;


use App\Http\Models\Cliente\ClienteGaleria;
use Illuminate\Database\Eloquent\Collection;

class ClienteGaleriaCollection extends Collection
{
	
	/**
	 * ClienteGaleriaCollection constructor.
	 *
	 * @param array $models
	 */
	public function __construct(array $models = [])
	{
		parent::__construct($models);
	}

	public function toArrayFull()
	{
		$arrays = [];
		if (empty($this->items))
		{
			$foto = new ClienteGaleria();
			$foto->original = '';
			$foto->thumbnail = '';
			array_push($arrays, $foto->toArray());
		}
		foreach ($this->items as $foto)
		{
			$foto->thumbnail = $foto->thumbnail();
			$foto->original = $foto->original();
			$cliente_array = $foto->toArray();
			array_push($arrays, $cliente_array);
		}
		shuffle($arrays);

		return $arrays;
	}
}