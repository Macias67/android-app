<?php

namespace App\Http\Models\Admin;

use App\Http\Models\Cliente\Cliente;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    /**
     * Nombre de la tabla usada por el modelo
     *
     * @var string
     */
    protected $table = 'adm_categorias';

    /**
     * Categoria tiene muchas subcategorias
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcategorias ()
    {
        return $this->hasMany(SubCategorias::class, 'categoria_id');
    }

    public function getNegocios()
    {
        return $this->belongsToMany(Cliente::getTableName(), 'cl_categoria_negocio', 'id', 'id');
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
