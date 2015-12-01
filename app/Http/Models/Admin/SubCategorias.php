<?php

namespace App\Http\Models\Admin;

use App\Http\Models\Cliente\Cliente;
use App\Http\Models\Traits\UniqueID;
use Illuminate\Database\Eloquent\Model;

class SubCategorias extends Model
{
	use UniqueID;
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'adm_subcategorias';

	protected $hidden = ['created_at', 'updated_at'];

	/**
	 * Obtener nombre de la tabla
	 *
	 * @return mixed string
	 */
	public static function getTableName()
	{
		return with(new static)->getTable();
	}

	/**
	 * SubCategoria pertenece a una categoria
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function categoria()
	{
		return $this->belongsTo(Categorias::class, 'categoria_id');
	}

	public function negocios()
	{
		return $this->belongsToMany(Cliente::class, 'cl_categoria_negocio', 'subcategoria_id', 'cliente_id');
	}


}
