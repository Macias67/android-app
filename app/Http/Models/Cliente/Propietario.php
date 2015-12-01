<?php

namespace App\Http\Models\Cliente;

use App\Http\Models\Traits\UniqueID;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Propietario extends Model implements AuthenticatableContract, CanResetPasswordContract
{
	use Authenticatable, CanResetPassword, UniqueID;

	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'cl_propietario';

	public $incrementing = false;

	/**
	 * Atributos excluidos del modelo JSON
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['nombre', 'apellido', 'genero', 'movil', 'email', 'password', 'estatus'];

	/**
	 * El Propietario tiene muchos negocios que puede dirigir
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function clientes()
	{
		return $this->hasMany(Cliente::class, 'id');
	}

	/**
	 * Scope para retornar nombre completo del Admin
	 *
	 * @return string
	 */
	public function scopeNombreCompleto()
	{
		return $this->nombre . ' ' . $this->apellido;
	}

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

		$this->id = $this->getUniqueID();
		$this->genero = (isset($this->genero) && $this->genero == 'on') ? 'H' : 'M';
		$this->estatus = (isset($this->estatus) && $this->estatus == 'on') ? 'online' : 'offline';
		$this->_cleanData();
	}

	private function _cleanData()
	{
		$this->nombre = mb_convert_case(trim(mb_strtolower($this->nombre)), MB_CASE_TITLE, "UTF-8");
		$this->apellido = mb_convert_case(trim(mb_strtolower($this->apellido)), MB_CASE_TITLE, "UTF-8");
		$this->genero = trim($this->genero);
		$this->movil = trim($this->movil);
		$this->email = mb_convert_case(trim(mb_strtolower($this->email)), MB_OVERLOAD_MAIL, "UTF-8");
		$this->password = bcrypt($this->password);
		$this->estatus = trim($this->estatus);
	}
}
