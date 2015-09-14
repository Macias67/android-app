<?php

namespace App\Http\Models\Cliente;

use App\Http\Models\Admin\SubCategorias;
use App\Http\Models\Traits\UniqueID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Cliente extends Model
{
    use UniqueID;
    /**
     * Nombre de la tabla usada por el modelo
     *
     * @var string
     */
    protected $table = 'cl_clientes';

    protected $primaryKey = 'id';

    public $incrementing  = FALSE;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'slug',
        'calle',
        'numero',
        'colonia',
        'codigo_postal',
        'referencia',
        'latitud',
        'longitud',
        'ciudad_id',
        'propietario_id',
        'estatus'
    ];

    protected $guarded = ['id'];

    /**
     * Cliente pertenece a un propietario
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function propietario ()
    {
        return $this->belongsTo(Propietario::class, 'propietario_id');
    }

    public function subcategorias()
    {
        return $this->belongsToMany(SubCategorias::class, 'cl_categoria_negocio', 'cliente_id', 'subcategoria_id');
    }

    /**
     * Cliente tiene una tabla Detalles
     *
     */
    public function detalles ()
    {
        return $this->hasOne(ClienteDetalles::class, 'id');
    }

    /**
     * Cliente tiene una tabla Redes Sociales
     *
     */
    public function redesSociales ()
    {
        return $this->hasOne(ClienteRedesSociales::class, 'id');
    }

    /**
     * Cliente tiene una tabla Horarios
     *
     */
    public function horarios ()
    {
        return $this->hasMany(ClienteHorarios::class, 'cliente_id');
    }

    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    /**
     * @param Request $request
     */
    public function preparaDatos (Request $request)
    {
        foreach ($this->fillable as $field) {
            $this->{$field} = $request->get($field);
        }

        $this->id = (isset($this->id)) ? $this->id : $this->getUniqueID();
        $this->estatus = (isset($this->estatus) && $this->estatus == 'on') ? 'online' : 'offline';
        $this->_cleanData();
    }

    private function _cleanData ()
    {
        $this->nombre         = mb_convert_case(trim(mb_strtolower($this->nombre)), MB_CASE_TITLE, "UTF-8");
        $this->slug         = str_slug($this->nombre);
        $this->calle          = mb_convert_case(trim(mb_strtolower($this->calle)), MB_CASE_TITLE, "UTF-8");
        $this->numero         = trim(strtoupper($this->numero));
        $this->colonia        = mb_convert_case(trim(mb_strtolower($this->colonia)), MB_CASE_TITLE, "UTF-8");
        $this->codigo_postal  = trim($this->codigo_postal);
        $this->referencia     = trim(ucfirst($this->referencia));
        $this->latitud   = trim($this->latitud);
        $this->longitud   = trim($this->longitud);
        $this->ciudad_id      = trim($this->ciudad_id);
        $this->propietario_id = trim($this->propietario_id);
        $this->estatus        = trim($this->estatus);
    }
}
