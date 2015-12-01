<?php

namespace App\http\models\Cliente;

use App\Http\Models\Traits\UniqueID;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;


class Promociones extends Model
{
	use UniqueID;
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cl_promociones';

	public $incrementing = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'cliente_id',
		'nombre',
		'slug',
		'descripcion',
		'siempre',
		'disp_inicio',
		'disp_fin',
		'estatus'
	];

	public static function getTableName()
	{
		return with(new static)->getTable();
	}

	public function preparaDatos(Request $request)
	{
		foreach ($this->fillable as $field)
		{
			$this->{$field} = $request->get($field);
		}

		$this->id = (isset($this->id)) ? $this->id : $this->getUniqueID();
		$this->estatus = (isset($this->estatus) && $this->estatus == 'on') ? 'online' : 'offline';
		$this->siempre = (isset($this->siempre) && $this->siempre == 'on') ? 1 : 0;
		$this->_cleanData();
	}

	public function cliente()
	{
		return $this->hasOne(Cliente::class, 'id', 'cliente_id');
	}

	private function _cleanData()
	{
		$this->cliente_id = mb_convert_case(trim(mb_strtolower($this->cliente_id)), MB_CASE_TITLE, "UTF-8");
		$this->nombre = mb_convert_case(trim(mb_strtolower($this->nombre)), MB_CASE_TITLE, "UTF-8");
		$this->slug = trim(strtolower($this->slug));
		$this->descripcion = trim(ucfirst($this->descripcion));
		$this->siempre = trim($this->siempre);
		$this->disp_inicio = trim($this->disp_inicio);
		$this->disp_fin = trim($this->disp_fin);
		$this->estatus = trim($this->estatus);
	}

	public function idPropietario($id_propietario, $id_promocion)
	{
		$cl_clientes = Cliente::getTableName();
		$cl_propietario = Propietario::getTableName();
		$query = $this
			->select($cl_propietario . '.id')
			->join($cl_clientes, $this->table . '.cliente_id', '=', $cl_clientes . '.id')
			->join($cl_propietario, $cl_clientes . '.propietario_id', '=', $cl_propietario . '.id')
			->where($cl_propietario . '.id', '=', $id_propietario)
			->where($this->table . '.id', '=', $id_promocion)
			->get()
			->toArray();

		return $query;
	}

	public function scopeByIdPropietario($query, $id_propietario)
	{
		$cl_promociones = Promociones::getTableName();
		$cl_clientes = Cliente::getTableName();
		$cl_propietario = Propietario::getTableName();

		return $query
			->select(
				$cl_promociones . '.*',
				$cl_clientes . '.nombre as nombre_cliente'
			)
			->join($cl_clientes, $cl_promociones . '.cliente_id', '=', $cl_clientes . '.id')
			->join($cl_propietario, $cl_clientes . '.propietario_id', '=', $cl_propietario . '.id')
			->where($cl_propietario . '.id', $id_propietario)
			->orderBy($cl_promociones . '.created_at', 'DESC')
			->take(10)
			->get();
	}

}
