<?php

namespace App\Http\Models\Admin;

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
    public function getSubcategorias ()
    {
        return $this->hasMany(SubCategorias::getTableName(), 'categoria_id');
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
