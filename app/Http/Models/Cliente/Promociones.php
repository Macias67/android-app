<?php

namespace App\http\models\Cliente;

use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;


class Promociones extends Model
{
    /**
     * Nombre de la tabla usada por el modelo
     *
     * @var string
     */
    protected $table = 'cl_promociones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cliente_id',
        'nombre',
        'slug',
        'descripcion',
        'siempre',
        'disp_inicio',
        'disp_fin',
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
        $this->siempre = (isset($this->siempre) && $this->siempre == 'on') ? 1 : 0;
        $this->_cleanData();
    }

    private function _cleanData ()
    {
        $this->cliente_id         = mb_convert_case(trim(mb_strtolower($this->cliente_id)), MB_CASE_TITLE, "UTF-8");
        $this->nombre             = mb_convert_case(trim(mb_strtolower($this->nombre)), MB_CASE_TITLE, "UTF-8");
        $this->slug               = trim(strtolower($this->slug));
        $this->descripcion        = trim(ucfirst($this->descripcion));
        $this->siempre            = trim($this->siempre);
        $this->disp_inicio        = trim($this->disp_inicio);
        $this->disp_fin           = trim($this->disp_fin);
        $this->estatus            = trim($this->estatus);
    }

}