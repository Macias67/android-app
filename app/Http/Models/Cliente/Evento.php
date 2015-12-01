<?php

namespace App\Http\Models\Cliente;

use App\Http\Models\Traits\UniqueID;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
	use UniqueID;
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cl_eventos';

	public $incrementing = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'cliente_id',
		'nombre',
		'slug',
		'descripcion',
		'fecha_inicio',
		'hora_inicio',
		'fecha_termina',
		'hora_termina',
		'cupo',
		'costo',
		'direccion',
		'latitud',
		'longitud',
		'url_exterior',
		'estatus',
		'disponible',
	];

	public function preparaDatos(Request $request)
	{
		foreach ($this->fillable as $field)
		{
			$this->{$field} = $request->get($field);
		}

		$this->id = $this->getUniqueID();
		$this->disponible = (isset($this->disponible) && $this->disponible == 'on') ? 'online' : 'offline';
		$this->_cleanData();
	}

	public static function getTableName()
	{
		return with(new static)->getTable();
	}

	public function idPropietario($id_propietario, $id_evento)
	{
		$cl_clientes = Cliente::getTableName();
		$cl_propietario = Propietario::getTableName();
		$query = $this
			->select($cl_propietario . '.id')
			->join($cl_clientes, $this->table . '.cliente_id', '=', $cl_clientes . '.id')
			->join($cl_propietario, $cl_clientes . '.propietario_id', '=', $cl_propietario . '.id')
			->where($cl_propietario . '.id', '=', $id_propietario)
			->where($this->table . '.id', '=', $id_evento)
			->get()
			->toArray();

		return $query;
	}

	public function cliente()
	{
		return $this->hasOne(Cliente::class, 'id', 'cliente_id');
	}

	public function scopeByIdPropietario($query, $id_propietario)
	{
		$cl_eventos = Evento::getTableName();
		$cl_clientes = Cliente::getTableName();
		$cl_propietario = Propietario::getTableName();

		return $query
			->select(
				$cl_eventos . '.*',
				$cl_clientes . '.nombre as nombre_cliente'
			)
			->join($cl_clientes, $cl_eventos . '.cliente_id', '=', $cl_clientes . '.id')
			->join($cl_propietario, $cl_clientes . '.propietario_id', '=', $cl_propietario . '.id')
			->where($cl_propietario . '.id', $id_propietario)
			->orderBy($cl_eventos . '.created_at', 'DESC')
			->take(10)
			->get();
	}


	private function _cleanData()
	{
		$this->nombre = mb_convert_case(trim(mb_strtolower($this->nombre)), MB_CASE_TITLE, "UTF-8");
		$this->slug = trim(strtolower($this->slug));
		$this->descripcion = trim(ucfirst($this->descripcion));
		$this->fecha_inicio = trim($this->fecha_inicio);
		$this->hora_inicio = trim($this->hora_inicio);
		$this->fecha_termina = trim($this->fecha_termina);
		$this->hora_termina = trim($this->hora_termina);
		$this->cupo = trim($this->cupo);
		$this->costo = trim($this->costo);
		$this->direccion = trim($this->direccion);
		$this->latitud = trim($this->latitud);
		$this->longitud = trim($this->longitud);
		$this->url_exterior = trim($this->url_exterior);
		$this->estatus = trim($this->estatus);
		$this->disponible = trim($this->disponible);
	}
}