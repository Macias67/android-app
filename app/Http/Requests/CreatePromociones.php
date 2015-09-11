<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreatePromociones extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cliente_id'        => 'required|alpha_num|size:16',
            'nombre'            => 'required|max:45',
            'slug'              => 'required|max:45|alpha_dash',
            'descripcion'       => 'required|max:255',
            'disp_inicio'      => 'required|date_format:Y-m-d H:i:s',
            'disp_fin'     => 'required|date_format:Y-m-d H:i:s'
        ];
    }


}
