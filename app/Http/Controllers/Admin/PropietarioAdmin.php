<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Cliente\Propietario;
use App\Http\Requests\CreatePropietario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PropietarioAdmin extends BaseAdmin
{
    public function __construct ()
    {
        parent::__construct();
        $this->data['activo_propietarios'] = TRUE;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index ()
    {
        return $this->view('admin.propietarios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create ()
    {
        $this->data['param'] = [
            'route'        => 'adm.propietario.store',
            'class'        => 'form-horizontal form-nuevo-propietario',
            'role'         => 'form',
            'autocomplete' => 'off'
        ];

        return $this->view('admin.propietarios.form-nuevo');
    }

    /**
     * @param \App\Http\Requests\CreatePropietario $request
     *
     * @return mixed
     */
    public function store (CreatePropietario $request)
    {
        if ($request->ajax() && $request->wantsJson()) {
            $propietario = new Propietario;
            $propietario->preparaDatos($request);

            if ($propietario->save()) {
                $texto = $propietario->NombreCompleto() . ' se registro como propietario';

                return $this->responseJSON(
                    TRUE,
                    'Propietario registrado',
                    $texto,
                    route('propietarios'),
                    NULL,
                    ['addCliente' => route('adm.nuevo.cliente')]
                );
            }
            else {
                return $this->responseJSON(FALSE, 'No se registró', 'Parece que no hubo registro en la BD', NULL);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show ($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit ($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int     $id
     *
     * @return Response
     */
    public function update (Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy ($id)
    {
        //
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Http\Controllers\Admin\JsonResponse
     */
    public function jsonSelect (Request $request)
    {
        if ($request->ajax() && $request->wantsJson()) {
            $propietarios = Propietario::get()->ToArray();
            $res          = [];
            if (!empty($propietarios)) {
                foreach ($propietarios as $propietario) {
                    $text =
                        $propietario['nombre'] . ' ' . $propietario['apellido'] . ' (' . $propietario['email'] . ')';
                    array_push($res, ['id' => (int) $propietario['id'], 'text' => $text]);
                }
            }

            return new JsonResponse($res, 200);
        }
    }
}
