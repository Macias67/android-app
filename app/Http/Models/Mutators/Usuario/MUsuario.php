<?php

namespace App\Http\Models\Mutators\Usuario;

use Jenssegers\Date\Date;

trait MUsuario
{
	public function setNombreAttribute($value)
	{
		$this->attributes['nombre'] = mb_convert_case(trim(mb_strtolower($value)), MB_CASE_TITLE, "UTF-8");
	}

	public function setApellidoAttribute($value)
	{
		$this->attributes['apellido'] = mb_convert_case(trim(mb_strtolower($value)), MB_CASE_TITLE, "UTF-8");
	}

	public function setEmailAttribute($value)
	{
		$this->attributes['email'] = trim($value);
	}

	public function setFechaNacimientoAttribute($value)
	{
		$this->attributes['fecha_nacimiento'] =  Date::createFromFormat('d/m/Y', $value)->format('Y-m-d');
	}

	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] =  bcrypt($value);
	}
}