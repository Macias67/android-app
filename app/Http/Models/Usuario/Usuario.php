<?php

namespace App\Http\Models\Usuario;

use App\Http\Models\Traits\UniqueID;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model implements AuthenticatableContract, CanResetPasswordContract
{
	use UniqueID, Authenticatable, CanResetPassword;

	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'usr_usuarios';

	protected $primaryKey = 'id';

	public $incrementing = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'nombre',
		'apellido',
		'email',
		'password'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * Nombre de la tabla
	 *
	 * @return mixed string Nombre de la tabla
	 */
	public static function getTableName()
	{
		return with(new static)->getTable();
	}
}
