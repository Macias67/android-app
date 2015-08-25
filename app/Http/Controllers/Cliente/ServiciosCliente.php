<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Models\Cliente\Cliente;
use App\Http\Models\Cliente\Servicios;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreateServicio;;

class ServiciosCliente extends BaseCliente
{
    /*public function __construct()
    {
        parent::__construct();
        $this->data['activo_servicios'] = TRUE;
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->view('cliente.servicios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->data['param'] = [
            'route'        => 'cliente.servicios.store',
            'class'        => 'form-horizontal form-nuevo-servicio',
            'role'         => 'form',
            'autocomplete' => 'off'
        ];
        $clientes = Cliente::where('propietario_id', $this->infoPropietario->id)->get(['id',  'nombre'])->ToArray();
        $options = [];
        foreach ($clientes as $index => $cliente) {
            $options[$cliente['id']] = $cliente['nombre'];
        }
        $this->data['negocios'] = $options;

        return $this->view('cliente.servicios.form-nuevo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateServicio $request
     * @return \App\Http\Controllers\Cliente\Response
     */
    public function store(CreateServicio  $request)
    {
       if($request->ajax() && $request->wantsJson()){
            $servicio = new Servicios;;
            $servicio->preparaDatos($request);

            if ($servicio->save()) {
                $response = [
                    'exito'  => TRUE,
                    'titulo' => 'Servicio registrado',
                    'texto'  =>'¡Felicidades! <b>' . $servicio->nombre . '</b> se ha registrado.',
                    'url'    => route('servicios-cliente')
                ];
            }
            else {
                $response = [
                    'exito'  => FALSE,
                    'titulo' =>  'No se registró',
                    'texto'  =>'Parece que no hubo registro en la BD',
                    'url'    => NULL
                ];
            }
            return $this->responseJSON($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
