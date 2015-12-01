<?php

namespace App\Http\Models\Admin;

use App\Http\Models\Traits\UniqueID;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
	use UniqueID;
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'adm_categorias';

	protected $hidden = ['created_at', 'updated_at'];

	public static function getTableName()
	{
		return with(new static)->getTable();
	}

	/**
	 * Categoria tiene muchas subcategorias
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function getSubcategorias()
	{
		return $this->hasMany(SubCategorias::class, 'categoria_id');
	}
}
