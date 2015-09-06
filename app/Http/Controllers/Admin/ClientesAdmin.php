<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Admin\Categorias;
use App\Http\Models\Admin\Ciudades;
use App\Http\Models\Cliente\Cliente;
use App\Http\Models\Cliente\Propietario;
use App\Http\Requests\CreateCliente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;

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
        $options_ciudades  = [];
        foreach ($ciudades as $index => $ciudad) {
            $options_ciudades[$ciudad['id']] = $ciudad['ciudad'] . ', ' . $ciudad['estado'];
        }

//        $optiong    = [];
//        $categorias = Categorias::get();
//        foreach ($categorias as $categoria) {
//            $subcategorias = $categoria->getSubcategorias->ToArray();
//            foreach ($subcategorias as $index => $subcategoria) {
//                $sub = [];
//                if ($subcategorias) {
//                    foreach ($subcategorias as $key => $subcategoria) {
//                        $sub[$subcategoria['id']] = $subcategoria['subcategoria'];
//                    }
//                }
//                $optiong[$categoria['categoria']] = $sub;
//            }
//        }
//        $this->data['optiong'] = $optiong;

        $categorias = Categorias::all(['id', 'categoria'])->ToArray();
        $options_categorias = ['' => ''];
        foreach($categorias as $categoria){
            $options_categorias[$categoria['id']] = $categoria['categoria'];
        }

        $this->data['options_categorias'] = $options_categorias;
        $this->data['options_ciudades'] = $options_ciudades;

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

                $subIDs = [];
                for ($i = 0; $i < 3; $i++) {
                    $var = $request->get("subcategoria".($i+1));
                    if(isset($var) && !empty($var)) {
                        array_push($subIDs, $var);
                    }
                }

                $cliente->subcategorias()->sync($subIDs);

                $detalles = new ClienteDetalles();
                $detalles->cliente_id = $cliente->id;
                $cliente->detalles()->save($detalles);

                $response = [
                    'exito'  => TRUE,
                    'titulo' => 'Cliente registrado',
                    'texto'  =>'¡Felicidades! <b>' . $cliente->nombre . '</b> se ha registrado.',
                    'url'    => route('clientes')
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

        $tCliente     = Cliente::getTableName();
        $tPropietario = Propietario::getTableName();
        $tCiduad      = Ciudades::getTableName();

        $campos = [
            $tCliente . '.id',
            $tCliente . '.nombre',
            $tCliente . '.estatus',
            $tCliente . '.created_at',
            $tPropietario . '.id as `propietario_id`',
            $tPropietario . '.nombre as propietario_nombre',
            $tPropietario . '.apellido as propietario_apellido',
            $tCiduad . '.ciudad',
            $tCiduad . '.estado'
        ];

        $pos_col = $order[0]['column'];
        $order   = $order[0]['dir'];
        $campo   = $columns[$pos_col]['data'];

        switch ($campo) {
            case 'estatus':
                $campo = $tCliente . '.estatus';
                break;
            case 'propietario':
                $campo = $tPropietario . '.nombre';
                break;
            case 'ciudad':
                $campo = $tCiduad . '.ciudad';
                break;
            case 'registro':
                $campo = $tCliente . '.created_at';
                break;
        }

        $clientes =
            DB::table($tCliente)
              ->select($campos)
              ->join($tCiduad, $tCiduad . '.id', '=', $tCliente . '.ciudad_id')
              ->join($tPropietario, $tPropietario . '.id', '=', $tCliente . '.propietario_id')
              ->where($tCliente . '.nombre', 'LIKE', '%' . $search['value'] . '%')
              ->orwhere($tPropietario . '.nombre', 'LIKE', '%' . $search['value'] . '%')
              ->orwhere($tPropietario . '.apellido', 'LIKE', '%' . $search['value'] . '%')
              ->orwhere($tCiduad . '.ciudad', 'LIKE', '%' . $search['value'] . '%')
              ->orwhere($tCiduad . '.estado', 'LIKE', '%' . $search['value'] . '%')
              ->orwhere($tCliente . '.estatus', 'LIKE', '%' . $search['value'] . '%')
              ->orderBy($campo, $order)
              ->get();

        $proceso = array();
        foreach ($clientes as $index => $cliente) {
            array_push(
                $proceso,
                [
                    "DT_RowId"    => $cliente->id,
                    'estatus'     => ($cliente->estatus == 'online') ? TRUE : FALSE,
                    'nombre'      => $cliente->nombre,
                    'propietario' => $cliente->propietario_nombre . ' ' . $cliente->propietario_apellido,
                    'ciudad'      => $cliente->ciudad . ', ' . $cliente->estado,
                    'registro'    => Date::createFromFormat('Y-m-d H:i:s', $cliente->created_at)->format(
                        'l, d \\d\\e F \\d\\e\\l Y'
                    )
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
}
