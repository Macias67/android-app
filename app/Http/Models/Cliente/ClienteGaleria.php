<?php

namespace App\Http\Models\Cliente;

use App\Http\Models\Traits\UniqueID;
use Illuminate\Database\Eloquent\Model;

class ClienteGaleria extends Model
{
	use UniqueID;

	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table        = 'cl_clientes_galeria';
	protected $primaryKey   = 'id';
	public    $incrementing = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'cliente_id',
		'nombre',
		'tamano'
	];

	protected $hidden = [
		'created_at',
		'updated_at'
	];
}