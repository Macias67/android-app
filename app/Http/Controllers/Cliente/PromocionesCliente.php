<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Models\Cliente\Cliente;
use App\Http\Models\Cliente\Promociones;
use App\Http\Requests;
use App\Http\Requests\CreatePromociones;
use Illuminate\Http\Request;

class PromocionesCliente extends BaseCliente
{
    public function __construct()
    {
        parent::__construct();
        $this->data['activo_productos'] = TRUE;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->view('cliente.promociones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->data['param'] = [
            'route'        => 'cliente.promociones.store',
            'class'        => 'form-horizontal form-nuevo-promociones',
            'role'         => 'form',
            'autocomplete' => 'off'
        ];

        $clientes = Cliente::where('propietario_id', $this->infoPropietario->id)->get(['id',  'nombre'])->ToArray();
        $options = [];
        foreach ($clientes as $index => $cliente) {
            $options[$cliente['id']] = $cliente['nombre'];
        }

        $this->data['negocios'] = $options;

        return $this->view('cliente.promociones.form-nuevo');
    }


    public function store(CreatePromociones $request)
    {
        if($request->ajax() && $request->wantsJson()){
            $promociones = new Promociones;
            $promociones->preparaDatos($request);

            if ($promociones->save()) {
                $response = [
                    'exito'  => TRUE,
                    'titulo' => 'Promocion registrada',
                    'texto'  =>'¡Felicidades! <b>' . $promociones->nombre . '</b> se ha registrado.',
                    'url'    => route('promociones-cliente')
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
    public function edit(CreatePromociones $request, $id)
    {
        $promociones = Promociones::findOrFail($id);

        return view(compact('promociones'));
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
