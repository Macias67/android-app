<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Traits\GetImagesCliente;
use App\Http\Models\Cliente\Cliente;
use App\Http\Models\Cliente\Evento;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CreateEvento;

class EventosCliente extends BaseCliente
{
    use GetImagesCliente;

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $eventos = Evento::all()->toArray();
        $this->data['eventosMasGustados'] = $eventos;

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
        $evento = Evento::find($id);

        $fechaInicio = str_replace("-", "/", $evento->fecha_inicio .' '.$evento->hora_inicio);
        $fechaFin = str_replace("-", "/", $evento->fecha_termina .' '.$evento->hora_termina);
        $fecha_inicio   = strftime("%A, %d"." de "."%B"." de "."%Y",strtotime($fechaInicio));
        $fecha_fin   = strftime("%A, %d"." de "."%B"." de "."%Y",strtotime($fechaFin));

        $this->data['param'] = [
            'route'        => 'cliente.evento.store',
            'class'        => 'form-horizontal form-nuevo-evento',
            'role'         => 'form',
            'autocomplete' => 'off'
        ];

//        $this->data['img_producto'] = asset('img/cliente/1/eventos/chamarra.jpg');
        $this->data['current_cliente_id'] = $id;
        $this->data['evento'] = $evento;
        $this->data['finicio'] = $fecha_inicio;
        $this->data['ffin'] = $fecha_fin;
        $this->data['img_producto'] = $this->_getImageProducto($evento->cliente_id, 'eventos', $id);
        return $this->view('cliente.eventos.perfil.settings');
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
