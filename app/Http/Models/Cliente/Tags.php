<?php

namespace App\Http\Models\Cliente;

use App\Http\Models\Traits\UniqueID;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
	use UniqueID;
	public $incrementing = false;

	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'tg_tags';

	/**
	 * Nombre de los campos a mostrar
	 *
	 * @var string
	 */
	protected $fillable = [
		'id',
	        'tag'
	];
}
