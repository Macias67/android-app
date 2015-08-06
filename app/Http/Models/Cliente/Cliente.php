<?php

namespace App\Http\Models\Cliente;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Cliente extends Model
{
    /**
     * Nombre de la tabla usada por el modelo
     *
     * @var string
     */
    protected $table = 'cl_clientes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'calle',
        'numero',
        'colonia',
        'codigo_postal',
        'referencia',
        'latlng_gmaps',
        'ciudad_id',
        'estatus'
    ];

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
        $this->nombre        = mb_convert_case(trim(mb_strtolower($this->nombre)), MB_CASE_TITLE, "UTF-8");
        $this->calle         = mb_convert_case(trim(mb_strtolower($this->calle)), MB_CASE_TITLE, "UTF-8");
        $this->numero        = trim($this->numero);
        $this->colonia       = mb_convert_case(trim(mb_strtolower($this->colonia)), MB_CASE_TITLE, "UTF-8");
        $this->codigo_postal = trim($this->codigo_postal);
        $this->referencia    = mb_convert_case(trim(mb_strtolower($this->referencia)), MB_CASE_TITLE, "UTF-8");
        $this->latlng_gmaps  = trim($this->latlng_gmaps);
        $this->ciudad_id     = trim($this->ciudad_id);
        $this->estatus       = trim($this->estatus);
    }
}
