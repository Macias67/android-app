<?php

namespace App\Http\Requests;

class CreateEvento extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre_evento' => 'required|max:60|unique:cl_clientes,nombre',
            'slug'          => 'required|max:60|alpha_dash',
            'numero'        => 'required|max:5',
            'colonia'       => 'required|max:45',
            'codigo_postal' => 'required|size:5',
            'referencia'    => 'max:45',
            'latlng_gmaps'  => 'max:45',
            'ciudad_id'     => 'exists:adm_ciudades,id|integer'
        ];
    }
}
