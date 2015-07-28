<?php

namespace App\Models\Admin;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
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
}