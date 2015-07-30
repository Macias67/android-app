<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginAdmin extends Controller
{

    public function getLogin()
    {
        return $this->view('admin.login');
    }

    public function postAuth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:45',
            'password' => 'required|max:2'
        ]);

        if ($validator->passes()) {

        } else {
            $exito = false;
            $mensaje = 'Hay problemas con los datos: ';
            $ruta = '';
            $errores = $validator->errors()->all();
            foreach ($errores as $index => $error) {
                $errores[$index] = ucfirst($error);
            }
        }

        return $this->responseJSON($exito, $mensaje, $ruta, $errores, 422);
    }

    public function getLogout()
    {

    }
}
