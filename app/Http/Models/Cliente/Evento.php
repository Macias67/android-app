<?php

namespace App\Http\Models\Cliente;

use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    /**
     * Nombre de la tabla usada por el modelo
     *
     * @var string
     */
    protected $table = 'cl_eventos';

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
        'fecha_inicio',
        'hora_inicio',
        'fecha_termina',
        'hora_termina',
        'cupo',
        'costo',
        'direccion',
        'latlng_gmaps',
        'url_exterior',
        'estatus',
        'disponible',
    ];

    public function preparaDatos (Request $request)
    {
        foreach ($this->fillable as $field) {
            $this->{$field} = $request->get($field);
        }

        $this->disponible = (isset($this->disponible) && $this->disponible == 'on') ? 'online' : 'offline';
        $this->_cleanData();
    }

    public function idPropietario($id_propietario, $id_evento)
    {
        $cl_clientes = Cliente::getTableName();
        $cl_propietario = Propietario::getTableName();
        $query = $this
            ->select($cl_propietario.'.id')
            ->join($cl_clientes, $this->table.'.cliente_id', '=', $cl_clientes.'.id')
            ->join($cl_propietario, $cl_clientes.'.propietario_id', '=', $cl_propietario.'.id')
            ->where($cl_propietario.'.id', '=', $id_propietario)
            ->where($this->table.'.id', '=', $id_evento)
            ->get()
            ->toArray();

        return$query;
    }

    private function _cleanData ()
    {
        $this->nombre           = mb_convert_case(trim(mb_strtolower($this->nombre)), MB_CASE_TITLE, "UTF-8");
        $this->slug             = trim(strtolower($this->slug));
        $this->descripcion      = trim(ucfirst($this->descripcion));
        $this->fecha_inicio     = trim($this->fecha_inicio);
        $this->hora_inicio      = trim($this->hora_inicio);
        $this->fecha_termina    = trim($this->fecha_termina);
        $this->hora_termina     = trim($this->hora_termina);
        $this->cupo             = trim($this->cupo);
        $this->costo            = trim($this->costo);
        $this->direccion        = trim($this->direccion);
        $this->latlng_gmaps     = trim($this->latlng_gmaps);
        $this->url_exterior     = trim($this->url_exterior);
        $this->estatus          = trim($this->estatus);
        $this->disponible       = trim($this->disponible);
    }
}