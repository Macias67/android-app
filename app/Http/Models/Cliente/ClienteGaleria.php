<?php

namespace App\Http\Models\Cliente;

use App\Http\Collections\ClienteGaleriaCollection;
use App\Http\Models\Traits\UniqueID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

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

	/**
	 * Sobrescribo la collection
	 *
	 * @param array $models
	 *
	 * @return \App\Http\Collections\ClienteCollection
	 */
	public function newCollection(array $models = [])
	{
		return new ClienteGaleriaCollection($models);
	}

	public function scopeThumbnail()
	{
		$GCS_URL = Config::get('path.storage');

		if ($this->nombre)
		{
			return $GCS_URL . Config::get('path.clientes') . '/' . $this->cliente_id . '/galeria/thumbnail/' . $this->nombre;
		}
		else
		{
			return '';
		}
	}

	public function scopeOriginal()
	{
		$GCS_URL = Config::get('path.storage');

		if ($this->nombre)
		{
			return $GCS_URL . Config::get('path.clientes') . '/' . $this->cliente_id . '/galeria/' . $this->nombre;
		}
		else
		{
			return '';
		}
	}

	/**
	 * Galeria  pertenece a Cliente
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function cliente()
	{
		return $this->belongsTo(Cliente::class, 'id');
	}
}