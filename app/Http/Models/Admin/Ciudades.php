<?php

namespace App\Http\Models\Admin;

use App\Http\Models\Traits\UniqueID;
use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
	use UniqueID;
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'adm_ciudades';

	protected $hidden = ['created_at', 'updated_at'];

	public static function getTableName()
	{
		return with(new static)->getTable();
	}

	/**
	 * Scope para retornar nombre completo de la Ciudad
	 *
	 * @return string
	 */
	public function scopeCiudadCompleto()
	{
		return $this->ciudad . ', ' . $this->estado;
	}
}
