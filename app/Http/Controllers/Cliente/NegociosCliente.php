<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Models\Admin\Ciudades;
use App\Http\Models\Cliente\Cliente;
use App\Http\Requests;
use App\Http\Requests\CreateCliente;
use Illuminate\Http\Request;

class NegociosCliente extends BaseCliente
{
    public function __construct()
    {
        parent::__construct();
        $this->data['activo_negocio'] = TRUE;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->view('cliente.negocios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->data['param'] = [
            'route' => 'cliente.negocio.store',
            'class' => 'form-horizontal form-nuevo-cliente',
            'role' => 'form',
            'autocomplete' => 'off'
        ];

        $ciudades = Ciudades::get()->ToArray();
        $options = [];
        foreach ($ciudades as $index => $ciudad) {
            $options[$ciudad['id']] = $ciudad['ciudad'] . ', ' . $ciudad['estado'];
        }

        $this->data['options_ciudades'] = $options;
        $this->data['activo_negocio_nuevo'] = TRUE;

        return $this->view('cliente.negocios.form-nuevo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCliente $request
     * @return Response
     */
    public function store(CreateCliente $request)
    {
        if ($request->ajax() && $request->wantsJson()) {
            $cliente = new Cliente;
            $cliente->preparaDatos($request);

            if ($cliente->save()) {
                $texto = '¡Felicidades! <b>' . $cliente->nombre . '</b> se ha registrado.';

                return $this->responseJSON(TRUE, 'Cliente registrado', $texto, route('negocios-cliente'));
            }
            else {
                return $this->responseJSON(FALSE, 'No se registró', 'Parece que no hubo registro en la BD', NULL);
            }
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
