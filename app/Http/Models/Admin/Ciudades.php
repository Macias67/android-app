<?php

namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
    /**
     * Nombre de la tabla usada por el modelo
     *
     * @var string
     */
    protected $table = 'adm_ciudades';

    /**
     * Scope para retornar nombre completo de la Ciudad
     *
     * @return string
     */
    public function scopeCiudadCompleto ()
    {
        return $this->ciudad . ', ' . $this->estado;
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
