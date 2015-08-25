<?php

namespace App\Http\Requests;

class CreateServicio extends Request
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
            'cliente_id'        => 'required|exists:cl_clientes,id|integer',
            'categoria_id'   => 'required|exists:cl_categorias,id|integer',
            'nombre'            => 'required|max:45',
            'slug'              => 'required|max:45|alpha_dash',
            'descripcion'       => 'required|max:255',
            'descripcion_corta' => 'required|max:45',
            'disp_inicio'       => 'required|date_format:Y-m-d H:i:s',
            'disp_fin'          => 'required|date_format:Y-m-d H:i:s',
            'precio'            => 'required|numeric'
        ];
    }
}