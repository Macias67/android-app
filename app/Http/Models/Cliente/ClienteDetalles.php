<?php

namespace App\Http\Models\Cliente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ClienteDetalles extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cl_clientes_detalles';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'telefono1',
		'telefono2',
		'telefono3',
		'descripcion',
		'slogan',
		'website',
		'email_negocio',
		'pago_tarjeta',
		'reservaciones',
		'servicio_domicilio',
		'mesa_aire_libre',
		'wifi',
		'estacionamiento'
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

		$this->pago_tarjeta = (isset($this->pago_tarjeta) && $this->pago_tarjeta == 'on') ? 1 : 0;
		$this->reservaciones = (isset($this->reservaciones) && $this->reservaciones == 'on') ? 1 : 0;
		$this->servicio_domicilio = (isset($this->servicio_domicilio) && $this->servicio_domicilio == 'on') ? 1 : 0;
		$this->mesa_aire_libre = (isset($this->mesa_aire_libre) && $this->mesa_aire_libre == 'on') ? 1 : 0;
		$this->wifi = (isset($this->wifi) && $this->wifi == 'on') ? 1 : 0;
		$this->estacionamiento = (isset($this->estacionamiento) && $this->estacionamiento == 'on') ? 1 : 0;
		$this->_cleanData();
	}

	private function _cleanData()
	{
		$this->descripcion = trim(ucfirst($this->descripcion));
		$this->slogan = trim(ucfirst($this->slogan));
		$this->website = trim($this->website);
		$this->email_negocio = trim($this->email_negocio);
		$this->telefono1 = trim($this->telefono1);
		$this->telefono2 = trim($this->telefono2);
		$this->telefono3 = trim($this->telefono3);
	}
}
