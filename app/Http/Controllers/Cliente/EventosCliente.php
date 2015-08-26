<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Models\Cliente\Cliente;
use App\Http\Models\Cliente\Evento;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CreateEvento;

class EventosCliente extends BaseCliente
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return $this->view('cliente.eventos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $this->data['param'] = [
            'route' => 'cliente.evento.store',
            'class' => 'form-horizontal form-nuevo-evento',
            'role' => 'form',
            'autocomplete' => 'off'
        ];

        $clientes = Cliente::where('propietario_id', $this->infoPropietario->id)->get(['id',  'nombre'])->ToArray();
        $options = [];
        foreach ($clientes as $index => $cliente) {
            $options[$cliente['id']] = $cliente['nombre'];
        }

        $this->data['negocios'] = $options;

        return $this->view('cliente.eventos.form-nuevo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CreateEvento $request
     *
     * @return \App\Http\Controllers\Cliente\Response $response
     */
    public function store(CreateEvento $request)
    {
        if($request->ajax() && $request->wantsJson()){
            $evento = new Evento;
            $evento->preparaDatos($request);

            if ($evento->save()) {
                $response = [
                    'exito'  => TRUE,
                    'titulo' => 'Evento registrado',
                    'texto'  => '¡Felicidades! <b>' . $evento->nombre . '</b> se ha registrado.',
                    'url'    => route('eventos-cliente')
                ];
            }
            else {
                $response = [
                    'exito'  => FALSE,
                    'titulo' => 'No se registró el evento',
                    'texto'  =>'Parece que no hubo registro en la base de datos.',
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
