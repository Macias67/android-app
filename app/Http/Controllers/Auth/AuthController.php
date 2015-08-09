<?php

namespace App\Http\Controllers\Auth;


use App\Http\Models\Admin\Admin;
use App\Http\Models\Cliente\Cliente;
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
        $this->data['param'] =
            ['route' => 'auth.' . $this->_type(), 'class' => 'login-form animated bounceInDown', 'autocomplete' => 'off'];

        return $this->view('login');
    }

    /**
     * Método de autenticación del admin
     *
     * @param Request $request
     *
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
     *
     * @return mixed
     */
    public function getLogout(Redirect $redirect)
    {
        $this->auth->logout();
        Session::flush();

        return $redirect::route('login.' . $this->_type())->header(
            'Cache-Control',
            'no-store, no-cache, must-revalidate, post-check=0, pre-check=0'
        );
    }

    /**
     * @param Request $request
     *
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
                $credenciales = ['email' => $request->get('email'), 'password' => $request->get('password'), 'estatus' => 'online'];
                if ($this->auth->attempt($credenciales)) {
                    $model = ($this->auth->getName() == 'admin') ? new Admin : new Propietario;
                    $admin = $model::find($this->auth->user()->id);
                    $admin->ultima_sesion = date('Y-m-d H:i:s');
                    $admin->save();

                    $titulo = 'Bienvenido ' . $this->auth->user()->NombreCompleto();
                    $texto = 'Espere unos momentos...';

                    return $this->responseJSON(TRUE, $titulo, $texto, route($this->_type()));
                }
                else {
                    $titulo = 'No existen datos.';
                    $mensaje = 'Espere unos momentos...';
                    $errores = ['El email o la contraseña son incorrectos.'];

                    return $this->responseJSON(FALSE, $titulo, $mensaje, NULL, $errores, NULL, 422);
                }
            }
            else {
                $mensaje = 'Ups...';
                $texto = 'Hay problemas con los datos. ';
                $errores = $validator->errors()->all();
                foreach ($errores as $index => $error) {
                    $errores[$index] = ucfirst($error);
                }

                return $this->responseJSON(FALSE, $mensaje, $texto, NULL, $errores, NULL, 422);
            }
        }
        else {
            return response('Unauthorized.', 401);
        }
    }

    private function _type() {
        return ($this->auth->getName() == 'propietario') ? 'cliente' : $this->auth->getName();
    }
}