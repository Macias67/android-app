<?php

namespace App\Http\Controllers\Api;

use App\Http\Models\Cliente\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PropietarioNegocioApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idPropietario)
    {

        // Devolverá todos los aviones.
        $negociosPropietario = Cliente::where('propietario_id', $idPropietario)
                        ->get();

        if (!$negociosPropietario)
        {
            // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
            // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
           return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentran los negocios con ese ID de propietario.'])], 404);
        }

        return response()->json(['status'=>'ok','data'=>$negociosPropietario],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idPropietario, $idNegocio)
    {

        //Devolverá un negocio por ID.
        $negociosPropietario = Cliente::where('propietario_id', $idPropietario)->get();
        $negocio = Cliente::where('id', $idNegocio)->get();

        if ($negociosPropietario->count() != 0)
        {
            if($negocio->count() != 0)
            {
                return response()->json(['status'=>'ok','data'=>$negocio],200);
            }
            // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
            // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra nungun negocio con ese ID.'])],404);
        }

        // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
        // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
        return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra ningun propietario con ese ID.'])],404);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
