<?php

namespace App\Http\Requests;

class CreateCliente extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize ()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules ()
    {
        return [
            'nombre'        => 'required|max:45|unique:cl_clientes,nombre',
            'calle'         => 'required|max:45',
            'numero'        => 'required|max:5',
            'colonia'       => 'required|max:45',
            'codigo_postal' => 'required|size:5',
            'referencia'    => 'max:45',
            'latlng_gmaps'  => 'max:45',
            'ciudad_id'     => 'exists:adm_ciudades|integer'
        ];
    }
}
