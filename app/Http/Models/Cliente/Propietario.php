<?php

namespace App\Http\Models\Cliente;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class Propietario extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * Nombre de la tabla usada por el modelo
     *
     * @var string
     */
    protected $table = 'cl_propietario';

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
