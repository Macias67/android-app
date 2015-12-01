<?php

namespace App\Http\Models\Cliente;

use App\Http\Models\Traits\UniqueID;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
	use UniqueID;
	public $incrementing = false;
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cl_servicios';
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $fillable = [
		'id',
		'cliente_id',
		'categoria_id',
		'nombre',
		'slug',
		'descripcion',
		'descripcion_corta',
		'disp_inicio',
		'disp_fin',
		'estatus',
		'precio'
	];

	public function preparaDatos(Request $request)
	{
		foreach ($this->fillable as $field)
		{
			$this->{$field} = $request->get($field);
		}

		$this->id = (isset($this->id)) ? $this->id : $this->getUniqueID();
		$this->estatus = (isset($this->estatus) && $this->estatus == 'on') ? 'online' : 'offline';
		$this->_cleanData();
	}

	private function _cleanData()
	{
		$this->nombre = mb_convert_case(trim(mb_strtolower($this->nombre)), MB_CASE_TITLE, "UTF-8");
		$this->slug = trim(strtolower($this->slug));
		$this->descripcion = trim(ucfirst($this->descripcion));
		$this->descripcion_corta = trim(ucfirst($this->descripcion_corta));
		$this->disp_inicio = trim($this->disp_inicio);
		$this->disp_fin = trim($this->disp_fin);
		$this->estatus = trim($this->estatus);
		$this->precio = trim($this->precio);
	}

	public function categoria()
	{
		return $this->hasOne(Categorias::class, 'categoria_id');
	}

	public function idPropietario($id_propietario, $id_servicio)
	{
		$cl_clientes = Cliente::getTableName();
		$cl_propietario = Propietario::getTableName();
		$query = $this
			->select($cl_propietario . '.id')
			->join($cl_clientes, $this->table . '.cliente_id', '=', $cl_clientes . '.id')
			->join($cl_propietario, $cl_clientes . '.propietario_id', '=', $cl_propietario . '.id')
			->where($cl_propietario . '.id', '=', $id_propietario)
			->where($this->table . '.id', '=', $id_servicio)
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
		$cl_servicios = Servicios::getTableName();
		$cl_clientes = Cliente::getTableName();
		$cl_propietario = Propietario::getTableName();

		return $query
			->select(
				$cl_servicios . '.*',
				$cl_clientes . '.nombre as nombre_cliente'
			)
			->join($cl_clientes, $cl_servicios . '.cliente_id', '=', $cl_clientes . '.id')
			->join($cl_propietario, $cl_clientes . '.propietario_id', '=', $cl_propietario . '.id')
			->where($cl_propietario . '.id', $id_propietario)
			->orderBy($cl_servicios . '.created_at', 'DESC')
			->take(10)
			->get();
	}

	public static function getTableName()
	{
		return with(new static)->getTable();
	}

}

