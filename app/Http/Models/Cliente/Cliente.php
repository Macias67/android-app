<?php

namespace App\Http\Models\Cliente;

use App\Http\Collections\AppCollection;
use App\Http\Collections\ClienteCollection;
use App\Http\Models\Admin\Ciudades;
use App\Http\Models\Admin\SubCategorias;
use App\Http\Models\Traits\UniqueID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class Cliente extends Model
{
	use UniqueID;

	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cl_clientes';

	protected $primaryKey = 'id';

	public $incrementing = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'nombre',
		'slug',
		'calle',
		'numero',
		'colonia',
		'codigo_postal',
		'referencia',
		'latitud',
		'longitud',
		'ciudad_id',
		'propietario_id',
		'estatus'
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
		return new ClienteCollection($models);
	}

	/**
	 * Nombre de la tabla
	 *
	 * @return mixed string Nombre de la tabla
	 */
	public static function getTableName()
	{
		return with(new static)->getTable();
	}

	/**
	 * Cliente pertenece a un propietario
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function propietario()
	{
		return $this->belongsTo(Propietario::class, 'propietario_id');
	}

	/**
	 * Cliente tiene muchas subcategorias
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function subcategorias()
	{
		return $this->belongsToMany(SubCategorias::class, 'cl_categoria_negocio', 'cliente_id', 'subcategoria_id');
	}

	/**
	 * Cliente tiene una columna detalles
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function detalles()
	{
		return $this->hasOne(ClienteDetalles::class, 'id');
	}

	/**
	 * Cliente tiene una columna de redes sociales
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function redesSociales()
	{
		return $this->hasOne(ClienteRedesSociales::class, 'id');
	}

	/**
	 * Cliente tiene muchas columnas en horarios
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function horarios()
	{
		return $this->hasMany(ClienteHorarios::class, 'cliente_id');
	}

	/**
	 * Cliente pertence a una ciudad
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function ciudad()
	{
		return $this->belongsTo(Ciudades::class, 'ciudad_id');
	}

	/**
	 * Cliente tiene fotos en Galeria
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function galeria()
	{
		return $this->hasMany(ClienteGaleria::class, 'cliente_id');
	}

	/**
	 * Funcion para optener el logotipo del cliente
	 *
	 * @return string Ruta de la imagen del logotipo
	 */
	public function scopeLogo()
	{
		$logoDefault = 'assets/admin/pages/media/default/logo.jpg';
		$GCS_URL = Config::get('path.storage');

		if ($this->logo)
		{
			return $GCS_URL . Config::get('path.clientes') . '/' . $this->id . '/logo/' . $this->logo;
		}
		else
		{
			return asset($logoDefault);
		}
	}

	public function scopeDireccionCompleta()
	{
		return $this->calle . ' ' . $this->numero . ' Col. ' . $this->colonia . ', ' . $this->ciudad->ciudadCompleto().'. ';
	}

	/**
	 * Scope para encontrar negocios que esten ONLINE
	 *
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeOnline($query)
	{
		return $query->where('estatus', 'online');
	}

	/**
	 * Obtienes todos los negocios del cliente por ID
	 *
	 * @param $query
	 * @param $propietario_id ID del propietario
	 *
	 * @return mixed null|array
	 */
	public function scopeNegociosPropietarioArray($query, $propietario_id)
	{
		return $query->where('propietario_id', $propietario_id)->get(['id', 'nombre'])->ToArray();
	}

	/**
	 * @param Request $request
	 */
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
		$this->slug = str_slug($this->nombre);
		$this->calle = mb_convert_case(trim(mb_strtolower($this->calle)), MB_CASE_TITLE, "UTF-8");
		$this->numero = trim(strtoupper($this->numero));
		$this->colonia = mb_convert_case(trim(mb_strtolower($this->colonia)), MB_CASE_TITLE, "UTF-8");
		$this->codigo_postal = trim($this->codigo_postal);
		$this->referencia = trim(ucfirst($this->referencia));
		$this->latitud = trim($this->latitud);
		$this->longitud = trim($this->longitud);
		$this->ciudad_id = trim($this->ciudad_id);
		$this->propietario_id = trim($this->propietario_id);
		$this->estatus = trim($this->estatus);
	}

	/**
	 * Convert the model instance to an array.
	 *
	 * @return array
	 */
	public function toArrayFull()
	{
		$array = parent::toArray();
		$array['logo'] = $this->logo();
		$ciudad = ['ciudad' => $this->ciudad->toArray()];
		$propietario = ['propietario' => $this->propietario->toArray()];
		$detalles = ['detalles' => $this->detalles->toArray()];
		$horarios = ['horarios' => $this->horarios->toArray()];
		$subcategorias = ['subcategorias' => $this->subcategorias->toArray()];

		$arraycategorias = [];
		foreach ($this->subcategorias as $subcategoria)
		{
			array_push($arraycategorias, $subcategoria->categoria->toArray());
		}

		$categorias = ['categorias' => $arraycategorias];
		$redes_sociales = ['redes_sociales' => $this->redesSociales->toArray()];

		return array_merge($array, $ciudad, $propietario, $detalles, $horarios, $categorias, $subcategorias, $redes_sociales);
	}
}
