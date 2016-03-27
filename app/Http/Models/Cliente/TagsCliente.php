<?php

namespace App\Http\Models\Cliente;

use App\Http\Models\Traits\UniqueID;
use Illuminate\Database\Eloquent\Model;

class TagsCliente extends Model
{
	use UniqueID;
	public $incrementing = false;
	public $timestamps   = false;

	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'tg_tag_cliente';

	/**
	 * Nombre de los campos a mostrar
	 *
	 * @var string
	 */
	protected $fillable = [
		'id',
		'tag_id',
		'cliente_id'
	];

	public function tag()
	{
		return $this->hasOne(Tags::class, 'id', 'tag_id');
	}
}
