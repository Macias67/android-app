<?php

namespace App\Http\Requests;

class CreateProducto extends Request
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
            'subcategoria_id'   => 'required|exists:cl_subcategorias,id|integer',
            'nombre'            => 'required|max:45',
            'slug'              => 'required|max:45|alpha_dash',
            'descripcion'       => 'required|max:255',
            'descripcion_corta' => 'required|max:45',
            'disp_inicio'       => 'required|date_format:m-d-Y H:i:s',
            'disp_fin'          => 'required|date_format:m-d-Y H:i:s',
            'precio'            => 'required|numeric',
            'cantidad'          => 'required|integer'
        ];
    }
}
