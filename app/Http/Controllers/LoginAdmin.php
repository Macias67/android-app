<?php

namespace App\Http\Controllers;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

/**
 * Controlador para LoginAdmin
 *
 * @author  Luis Macias
 * @package App\Http\Controllers
 */
class LoginAdmin extends Controller
{
    /**
     * Vista de logue del Admin
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin ()
    {
        if(config('app.debug')){
            $this->data['admin'] = Admin::find(1);
        }
        return $this->view('admin.login');
    }

    /**
     * Método de autenticación del admin
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function postAuth (Request $request)
    {
        if ($request->ajax() && $request->wantsJson()) {

            $validator = Validator::make(
                $request->all(),
                [
                    'email'    => 'required|email|max:45',
                    'password' => 'required'
                ]
            );

            if ($validator->passes()) {
                if (Auth::admin()->attempt(
                    ['email' => $request->get('email'), 'password' => $request->get('password')]
                )
                ) {
                    $mensaje = 'Bienvenido ' . Auth::admin()->user()->NombreCompleto();

                    return $this->responseJSON(TRUE, $mensaje, route('admin'));
                }
                else {
                    $mensaje = 'No existen datos.';
                    $errores = ['El email o la contraseña son incorrectos.'];

                    return $this->responseJSON(FALSE, $mensaje, NULL, $errores, 422);
                }
            }
            else {
                $mensaje = 'Hay problemas con los datos: ';
                $errores = $validator->errors()->all();
                foreach ($errores as $index => $error) {
                    $errores[$index] = ucfirst($error);
                }

                return $this->responseJSON(FALSE, $mensaje, NULL, $errores, 422);
            }

        }
    }

    /**
     * Método de logout del admin
     *
     * @param \Illuminate\Support\Facades\Redirect $redirect
     *
     * @return mixed
     */
    public function getLogout (Redirect $redirect)
    {
        Auth::admin()->logout();
        Session::flush();

        return $redirect::route('login.admin')->header(
            'Cache-Control',
            'no-store, no-cache, must-revalidate, post-check=0, pre-check=0'
        );
    }
}
