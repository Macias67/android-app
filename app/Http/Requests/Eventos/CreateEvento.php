<?php

namespace App\Http\Requests\Eventos;

use App\Http\Models\Cliente\Cliente;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class CreateEvento extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $cliente_id = $this->get('cliente_id');
        if (!is_null($cliente = Cliente::find($cliente_id))) {
            return ($cliente->propietario->id == Auth::propietario()->user()->id);
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
    public function rules()
    {
        return [
            'cliente_id'    => 'required|exists:cl_clientes,id|alpha_num|size:16',
            'nombre'        => 'required|max:45',
            'slug'          => 'max:45|alpha_dash',
            'direccion'     => 'max:145',
            'descripcion'   => 'required|max:255',
            'latitud'       => 'max:45',
            'longitud'      => 'max:45'
        ];
    }
}
