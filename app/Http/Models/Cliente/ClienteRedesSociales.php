<?php

namespace App\Http\Models\Cliente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ClienteRedesSociales extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cl_clientes_redes_sociales';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'facebook',
		'twitter',
		'instagram',
		'youtube',
		'googleplus'
	];

	protected $hidden = ['id', 'created_at', 'updated_at'];

	public static function getTableName()
	{
		return with(new static)->getTable();
	}

	/**
	 * Detalles pertenece a Cliente
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function cliente()
	{
		return $this->belongsTo(Cliente::class, 'id');
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 */
	public function preparaDatos(Request $request)
	{
		foreach ($this->fillable as $field)
		{
			$this->{$field} = $request->get($field);
		}
		$this->_cleanData();
	}

	private function _cleanData()
	{
		$this->facebook = trim($this->facebook);
		$this->twitter = trim($this->twitter);
		$this->instagram = trim($this->instagram);
		$this->youtube = trim($this->youtube);
		$this->googleplus = trim($this->googleplus);
	}
}
