<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Models\Admin\Categorias;
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

        $categorias = Categorias::all(['id', 'categoria'])->ToArray();
        $options_categorias = ['' => ''];
        foreach($categorias as $categoria){
            $options_categorias[$categoria['id']] = $categoria['categoria'];
        }

        $this->data['options_categorias'] = $options_categorias;

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
                $response = [
                    'exito'  => TRUE,
                    'titulo' => 'Cliente registrado',
                    'texto'  =>'¡Felicidades! <b>' . $cliente->nombre . '</b> se ha registrado.',
                    'url'    => route('negocios-cliente')
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
