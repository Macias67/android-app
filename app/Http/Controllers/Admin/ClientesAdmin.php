<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Cliente\Propietario;
use App\Http\Requests\CreatePropietario;
use App\Interfaces\CRUDInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ClientesAdmin extends BaseAdmin implements CRUDInterface
{
    public function __construct ()
    {
        parent::__construct();
        $this->data['activo_clientes'] = TRUE;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index ()
    {
        return $this->view('admin.clientes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create ()
    {
        $this->data['param'] =
            [
                'route'        => 'adm.cliente.store',
                'class'        => 'form-horizontal form-nuevo-cliente',
                'role'         => 'form',
                'autocomplete' => 'off'
            ];

        return $this->view('admin.clientes.form-nuevo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CreatePropietario $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store (CreatePropietario $request)
    {
        if ($request->ajax() && $request->wantsJson()) {

            $propietario = new Propietario;
            $propietario->preparaDatos($request);

            if($propietario->save()){
                $texto = $propietario->NombreCompleto() . ' se registro como propietario';
                return $this->responseJSON(TRUE, 'Propietario registrado', $texto, '');
            } else{
                return $this->responseJSON(FALSE, 'No se registró', 'Parece que no hubo registro en la BD', '');
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
        // TODO: Implement show() method.
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
        // TODO: Implement edit() method.
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
        // TODO: Implement update() method.
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
        // TODO: Implement destroy() method.
    }

    public function genPassword ()
    {
        $cadena         = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena = strlen($cadena);
        $pass           = "";
        $longitudPass   = rand(7, 10);
        for ($i = 1; $i <= $longitudPass; $i++) {
            $pos = rand(0, $longitudCadena - 1);
            $pass .= substr($cadena, $pos, 1);
        }

        return response($pass, 200);
    }
}
