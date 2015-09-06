<?php

namespace App\Http\Requests\Cliente;

use App\Http\Models\Cliente\Cliente;
use App\Http\Requests\Request;

/**
 * Class EditCliente
 *
 * @author  Luis Macias
 * @package App\Http\Requests\Cliente
 */
class EditCliente extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize ()
    {
        if (!is_null($cliente = Cliente::find($this->get('id')))) {
            $propietario_id = $this->get('propietario_id');

            return ($cliente->propietario->id == $propietario_id);
        }
        else {
            return FALSE;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ()
    {
        $tipo = $this->segment(4);

        switch ($tipo) {
            case 'principal':
                return $this->getRulesCliente();
                break;
            case 'adicional':
                return $this->getRulesClienteDetalles();
                break;
            case 'redessociales':
                return $this->getRulesClienteRedesSociales();;
                break;
        }

    }

    public function getRulesCliente ()
    {
        return [
            'id'             => 'required|exists:cl_clientes,id|integer',
            'nombre'         => 'required|max:45|unique:cl_clientes,nombre,' . $this->get('id'),
            'calle'          => 'required|max:45',
            'numero'         => 'required|max:5',
            'colonia'        => 'required|max:45',
            'codigo_postal'  => 'required|size:5',
            'referencia'     => 'max:140',
            'latitud'        => 'max:45',
            'longitud'       => 'max:45',
            'ciudad_id'      => 'exists:adm_ciudades,id|integer',
            'propietario_id' => 'exists:cl_clientes,propietario_id|integer'
        ];
    }

    public function getRulesClienteDetalles ()
    {
        return [
            'id'             => 'required|exists:cl_clientes,id|integer',
            'telefono1'      => 'max:14',
            'telefono2'      => 'max:14',
            'telefono3'      => 'max:14',
            'descripcion'    => 'max:200',
            'slogan'         => 'max:140',
            'website'        => 'max:45|url',
            'email_negocio'  => 'max:45|email',
            'propietario_id' => 'exists:cl_clientes,propietario_id|integer'
        ];
    }

    public function getRulesClienteRedesSociales ()
    {
        return [
            'id'             => 'required|exists:cl_clientes,id|integer',
            'facebook'        => 'max:100|url',
            'twitter'        => 'max:100|url',
            'instagram'        => 'max:100|url',
            'youtube'        => 'max:100|url',
            'googleplus'        => 'max:100|url',
            'propietario_id' => 'exists:cl_clientes,propietario_id|integer'
        ];
    }
}