<?php

namespace App\Http\Requests\Cliente;

use App\Http\Models\Cliente\Propietario;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class CreateCliente extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $propietario_id = $this->get('propietario_id');

        if (!is_null($propietario = Propietario::find($propietario_id))) {
            return ($propietario->id == Auth::propietario()->user()->id);
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
            'nombre' => 'required|max:45|unique:cl_clientes,nombre',
            'calle' => 'required|max:45',
            'numero' => 'required|max:5',
            'colonia' => 'required|max:45',
            'codigo_postal' => 'required|size:5',
            'referencia' => 'max:140',
            'latitud' => 'max:45',
            'longitud' => 'max:45',
            'ciudad_id' => 'exists:adm_ciudades,id|alpha_num|size:16'
        ];
    }
}
