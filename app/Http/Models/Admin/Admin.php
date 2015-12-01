<?php

namespace App\Http\Models\Admin;

use App\Http\Models\Traits\UniqueID;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements AuthenticatableContract, CanResetPasswordContract
{
	use Authenticatable, CanResetPassword, UniqueID;

	/**
	 * Nombre de la tabla usada por el modelo
	 *
	 * @var string
	 */
	protected $table = 'adm_admin';

	/**
	 * Atributos excluidos del modelo JSON
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * Scope para retornar nombre completo del Admin
	 *
	 * @return string
	 */
	public function scopeNombreCompleto()
	{
		return $this->nombre . ' ' . $this->apellido;
	}
}
