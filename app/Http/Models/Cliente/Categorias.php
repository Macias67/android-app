<?php

namespace App\Http\Models\Cliente;

use App\Http\Models\Traits\UniqueID;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use UniqueID;
    /**
     * Nombre de la tabla usada por el modelo
     *
     * @var string
     */
    protected $table = 'cl_categorias';

    /**
     * Categoria tiene muchas subcategorias
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria_id');
    }

    public static function getTableName ()
    {
        return with(new static)->getTable();
    }
}
