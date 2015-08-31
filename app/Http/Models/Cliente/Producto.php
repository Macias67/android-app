<?php

namespace App\Http\Models\Cliente;

use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /**
     * Nombre de la tabla usada por el modelo
     *
     * @var string
     */
    protected $table = 'cl_productos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cliente_id',
        'categoria_id',
        'nombre',
        'slug',
        'descripcion',
        'descripcion_corta',
        'disp_inicio',
        'disp_fin',
        'estatus',
        'precio',
        'cantidad'
    ];

    public function categoria ()
    {
        return $this->hasOne(Categorias::class, 'id');
    }

    public function idPropietario($id_propietario, $id_producto)
    {
        $cl_clientes = Cliente::getTableName();
        $cl_propietario = Propietario::getTableName();
        $query = $this
            ->select($cl_propietario.'.id')
            ->join($cl_clientes, $this->table.'.cliente_id', '=', $cl_clientes.'.id')
            ->join($cl_propietario, $cl_clientes.'.propietario_id', '=', $cl_propietario.'.id')
            ->where($cl_propietario.'.id', '=', $id_propietario)
            ->where($this->table.'.id', '=', $id_producto)
            ->get()
            ->toArray();

        return$query;
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public function preparaDatos (Request $request)
    {
        foreach ($this->fillable as $field) {
            $this->{$field} = $request->get($field);
        }

        $this->estatus = (isset($this->estatus) && $this->estatus == 'on') ? 'online' : 'offline';
        $this->_cleanData();
    }

    private function _cleanData ()
    {
        $this->nombre         = mb_convert_case(trim(mb_strtolower($this->nombre)), MB_CASE_TITLE, "UTF-8");
        $this->slug         = trim(strtolower($this->slug));
        $this->descripcion  = trim(ucfirst($this->descripcion));
        $this->descripcion_corta  = trim(ucfirst($this->descripcion_corta));
        $this->disp_inicio      = trim($this->disp_inicio);
        $this->disp_fin      = trim($this->disp_fin);
        $this->estatus = trim($this->estatus);
        $this->precio        = trim($this->precio);
        $this->cantidad        = trim($this->cantidad);
    }
}
