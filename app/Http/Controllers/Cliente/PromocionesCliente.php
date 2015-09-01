<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Models\Cliente\Cliente;
use App\Http\Models\Cliente\Promociones;
use App\Http\Models\Cliente\Propietario;
use App\Http\Requests;
use App\Http\Requests\CreatePromociones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPImageWorkshop\ImageWorkshop;
use App\Http\Controllers\Traits\GetImagesCliente;

class PromocionesCliente extends BaseCliente
{
    use GetImagesCliente;

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
        $cl_promociones = Promociones::getTableName();
        $cl_clientes = Cliente::getTableName();
        $cl_propietario = Propietario::getTableName();

        $promociones = DB::table($cl_promociones)
            ->select(
                $cl_promociones.'.id',
                $cl_clientes.'.id as cliente_id',
                $cl_clientes.'.nombre as nombre_cliente',
                $cl_promociones.'.nombre as nombre_promocion',
                DB::raw('COUNT(usr_usuario_gusta_promocion.promocion_id) AS totalLikes')
            )
            ->join($cl_clientes, $cl_promociones.'.cliente_id', '=', $cl_clientes.'.id')
            ->join($cl_propietario, $cl_clientes.'.propietario_id', '=', $cl_propietario.'.id')
            ->join('usr_usuario_gusta_promocion', $cl_promociones.'.id', '=', 'usr_usuario_gusta_promocion.promocion_id')
            ->where($cl_propietario.'.id', '=', $this->infoPropietario->id)
            ->groupBy($cl_promociones.'.nombre')
            ->orderBy('totalLikes', 'DESC')
            ->take(10)
            ->get();

        foreach($promociones as $promocion) {
            $promocion->imagen = $this->_getImagePromociones($promocion->cliente_id, 'promociones', $promocion->id);
        }
        $this->data['promocionesMasGustadas'] = $promociones;

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
    public function edit()
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(CreatePromociones $request)
    {
        var_dump("ola k ase");
        if($request->ajax() && $request->wantsJson()){

            if(!is_null($promocion = Promociones::find($request->get('id')))) {
                $promocion->preparaDatos($request);

                if ($promocion->save()) {
                    $response = [
                        'exito'  => TRUE,
                        'titulo' => 'Producto actualizado',
                        'texto'  =>'<b>' . $promocion->nombre . '</b> se ha actualizado.',
                        'url' => route('promociones-cliente')
                    ];
                }
                else {
                    $response = [
                        'exito'  => FALSE,
                        'titulo' =>  'No se actualizó',
                        'texto'  =>'Parece que no hubo cambios en la BD',
                        'url'    => NULL
                    ];
                }
                return $this->responseJSON($response);

            }
        }
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
