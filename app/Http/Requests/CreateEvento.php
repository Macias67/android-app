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
            'nombre'        => 'required|max:45|',
            'slug'          => 'max:45|alpha_dash',
            'direccion'     => 'max:145',
            'descripcion'   => 'required|max:255',
            'latitud'       => 'max:45',
            'longitud'      => 'max:45'
        ];
    }
}
