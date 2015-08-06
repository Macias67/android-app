<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Admin\Ciudades;
use App\Http\Models\Cliente\Cliente;
use App\Http\Models\Cliente\Propietario;
use App\Http\Requests\CreateCliente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ClientesAdmin extends BaseAdmin
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
        $this->data['param'] = [
            'route'        => 'adm.cliente.store',
            'class'        => 'form-horizontal form-nuevo-cliente',
            'role'         => 'form',
            'autocomplete' => 'off'
        ];

        $ciudades = Ciudades::get()->ToArray();
        $options  = [];
        foreach ($ciudades as $index => $ciudad) {
            $options[$ciudad['id']] = $ciudad['ciudad'] . ', ' . $ciudad['estado'];
        }

        $this->data['options_ciudades'] = $options;

        return $this->view('admin.clientes.form-nuevo');
    }

    /**
     * @param \App\Http\Requests\CreateCliente $request
     *
     * @return mixed
     */
    public function store (CreateCliente $request)
    {
        if ($request->ajax() && $request->wantsJson()) {
            $cliente = new Cliente;
            $cliente->preparaDatos($request);

            if ($cliente->save()) {
                $texto = '¡Felicidades! <b>' . $cliente->nombre . '</b> se ha registrado.';

                return $this->responseJSON(TRUE, 'Cliente registrado', $texto, route('clientes'));
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

    public function datatable (Request $request)
    {
        $draw    = $request->get('draw');
        $start   = $request->get('start');
        $length  = $request->get('length');
        $order   = $request->get('order');
        $columns = $request->get('columns');
        $search  = $request->get('search');
        $total   = Cliente::count();
        if ($length == -1) {
            $length = NULL;
            $start  = NULL;
        }

        $tCliente = Cliente::getTableName();
        $tCiduad  = Ciudades::getTableName();

        $campos  = [
            $tCliente.'.id',
            $tCliente.'.nombre',
            $tCliente.'.estatus',
            $tCliente.'.created_at',
            $tCiduad.'.ciudad',
            $tCiduad.'.estado'
        ];

        $pos_col = $order[0]['column'];
        $order   = $order[0]['dir'];
        $campo   = $columns[$pos_col]['data'];

        $clientes =
            DB::table($tCliente)
              ->select($campos)
              ->join($tCiduad, $tCiduad.'.id', '=', $tCliente.'.id')
              ->where($tCliente.'.nombre', 'LIKE', '%' . $search['value'] . '%')
              ->orwhere($tCiduad.'.ciudad', 'LIKE', '%' . $search['value'] . '%')
              ->orwhere($tCiduad.'.estado', 'LIKE', '%' . $search['value'] . '%')
              ->orwhere($tCliente.'.estatus', 'LIKE', '%' . $search['value'] . '%')
              ->orderBy($campo, $order)
              ->get();


        $proceso  = array();
        foreach ($clientes as $index => $cliente) {
            array_push(
                $proceso,
                [
                    "DT_RowId"    => $cliente->id,
                    'estatus'     => ($cliente->estatus == 'online') ? TRUE : FALSE,
                    'nombre'      => $cliente->nombre,
                    'propietario' => '',
                    'ciudad'      => $cliente->ciudad . ', ' . $cliente->estado,
                    'registro'    => $cliente->created_at
                ]
            );
        }
        $data = [
            'draw'            => $draw,
            'recordsTotal'    => count($clientes),
            'recordsFiltered' => $total,
            'data'            => $proceso
        ];

        return new JsonResponse($data, 200);
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
