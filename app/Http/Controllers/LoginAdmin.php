<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginAdmin extends Controller
{
    public function getLogin()
    {
        return $this->view('admin.login');
    }

    public function postAuth(Request $request)
    {
        if ($request->ajax() && $request->wantsJson()) {

            $validator = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email|max:45',
                    'password' => 'required'
                ]
            );

            if ($validator->passes()) {
                if (Auth::admin()
                        ->attempt(['email' => $request->get('email'), 'password' => $request->get('password')])
                ) {
                    $exito = TRUE;
                    $mensaje = 'Bienvenido ' . Auth::admin()->user()->nombre;
                    $ruta = route('admin');
                    $errores = null;
                    $status = 200;
                } else {
                    $exito = FALSE;
                    $mensaje = 'No existen los datos.';
                    $ruta = '';
                    $errores = ['El email o la contraseña son incorrectos.'];
                    $status = 422;
                }
            } else {
                $exito = FALSE;
                $mensaje = 'Hay problemas con los datos: ';
                $ruta = '';
                $errores = $validator->errors()->all();
                foreach ($errores as $index => $error) {
                    $errores[$index] = ucfirst($error);
                }
                $status = 422;
            }

            return $this->responseJSON($exito, $mensaje, $ruta, $errores, $status);
        }
    }

    public function getLogout(Redirect $redirect)
    {
        Auth::admin()->logout();
        return $redirect::route('login.admin');
    }
}
