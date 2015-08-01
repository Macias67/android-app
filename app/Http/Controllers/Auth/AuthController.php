<?php

namespace App\Http\Controllers\Auth;


use App\Http\Models\Admin\Admin;
use App\Http\Models\Cliente\Propietario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

trait AuthController
{
    /**
     * Vista de logue del Admin
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        $type = $this->auth->getName();

        if (config('app.debug')) {
            $this->data['email'] = ($type == 'admin') ? Admin::first()->email : Propietario::first()->email;
        }
        $this->data['param'] = ['route' => 'auth.' . $type, 'class' => 'login-form'];
        return $this->view('login');
    }

    /**
     * Método de autenticación del admin
     *
     * @param Request $request
     * @return mixed
     */
    public function postAuth(Request $request)
    {
        return $this->_validation($request);
    }

    /**
     * Método de logout del admin
     *
     * @param Redirect $redirect
     * @return mixed
     */
    public function getLogout(Redirect $redirect)
    {
        $this->auth->logout();
        Session::flush();

        return $redirect::route('login.' . $this->auth->getName())->header(
            'Cache-Control',
            'no-store, no-cache, must-revalidate, post-check=0, pre-check=0'
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    private function _validation(Request $request)
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
                if ($this->auth->attempt(
                    ['email' => $request->get('email'), 'password' => $request->get('password'), 'estatus' => 'online']
                )
                ) {
                    $mensaje = 'Bienvenido ' . $this->auth->user()->NombreCompleto();

                    return $this->responseJSON(TRUE, $mensaje, route($this->auth->getName()));
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
        else {
            return response('Unauthorized.', 401);
        }
    }
}