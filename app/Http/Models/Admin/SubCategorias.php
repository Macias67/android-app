<?php

namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SubCategorias extends Model
{
    /**
     * Nombre de la tabla usada por el modelo
     *
     * @var string
     */
    protected $table = 'adm_subcategorias';

    /**
     * SubCategoria pertenece a una categoria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCategoria ()
    {
        return $this->belongsTo(Categorias::getTableName(), 'id');
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}