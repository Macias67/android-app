<?php

namespace App\Http\Models\Cliente;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ClienteHorarios extends Model
{
	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cl_clientes_dias_horarios';

	private $dias_semana = [
		'Lunes',
		'Martes',
		'Miércoles',
		'Jueves',
		'Viernes',
		'Sábado',
		'Domingo'
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'cliente_id',
		'grupo_id',
		'dia_semana',
		'int_dia_semana',
		'hora_abre',
		'hora_cierra'
	];

	/**
	 * Detalles pertenece a Cliente
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function cliente()
	{
		return $this->belongsTo(Cliente::class, 'id');
	}

	public static function getTableName()
	{
		return with(new static)->getTable();
	}

	public static function scopeGrupoId($query)
	{
		return $query->select('cliente_id')
		             ->select('grupo_id')
		             ->groupBy('grupo_id');
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return array
	 */
	public function preparaDatos(Request $request)
	{
		$dias = $request->get('dias');
		$cliente_id = $request->get('id');
		$hora_abre = $request->get('abre');
		$hora_cierra = $request->get('cierra');

		$total_dias = count($dias);
		$hashid = new Hashids(md5('Macias'), rand(10, 16));
		$unique_id = $hashid->encode(time());

		$data = [];
		for ($i = 0; $i < $total_dias; $i++)
		{
			array_push($data, [
				'cliente_id'     => $cliente_id,
				'grupo_id'       => $unique_id,
				'dia_semana'     => $this->dias_semana[$dias[$i] - 1],
				'int_dia_semana' => $dias[$i],
				'hora_abre'      => $hora_abre,
				'hora_cierra'    => $hora_cierra
			]);
		}

		return $data;
	}
}
