<?php

namespace App\Http\Models\Usuario;

use App\Http\Models\Mutators\Usuario\MUsuario;
use App\Http\Models\Traits\UniqueID;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Usuario extends Model implements AuthenticatableContract, CanResetPasswordContract
{
	use UniqueID, Authenticatable, CanResetPassword, MUsuario;

	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'usr_usuarios';

	public $incrementing = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id',
		'nombre',
		'apellido',
		'fecha_nacimiento',
		'email',
		'sexo',
		'password',
		'ultima_sesion',
		'remember_token'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['created_at', 'updated_at'];

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
	 * @param Request $request
	 */
	public function preparaDatos(Request $request)
	{
		foreach ($this->fillable as $field)
		{
			$this->{$field} = $request->get($field);
		}

		$id = $request->get('id');
		if (!isset($id))
		{
			$this->id = $this->getUniqueID();
		}
	}

	public function scopeNombreCompleto()
	{
		return $this->nombre . ' ' . $this->apellido;
	}
}
