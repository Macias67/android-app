<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Models\Cliente\Categorias;
use App\Http\Models\Cliente\Cliente;
use App\Http\Requests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CategoriasCliente extends BaseCliente
{
    public function __construct()
    {
        parent::__construct();
        $this->data['activo_categorias'] = TRUE;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->view('cliente.categorias.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $clientes = Cliente::where('propietario_id', $this->infoPropietario->id)->get(['id',  'nombre'])->ToArray();
        $optionsClientes = [];
        foreach ($clientes as $index => $cliente) {
            $optionsClientes[$cliente['id']] = $cliente['nombre'];
        }

        $categorias = Categorias::where('cliente_id', $this->infoPropietario->id)
            ->orderBy('categoria', 'ASC')
            ->get(['id', 'categoria'])
            ->toArray();
        $optionsCategorias = array();
        foreach ($categorias as $key => $categoria) {
            $optionsCategorias[$categoria['id']] = $categoria['categoria'];
        }
        $llaves = array_keys($optionsCategorias);

        $llaves = (empty($llaves)) ? NULL : $llaves;

        $this->data['negocios'] = $optionsClientes;
        $this->data['categorias'] = $optionsCategorias;
        $this->data['llaves'] = $llaves;
        $this->data['array_form'] = array(
            'url'          => route('cliente.categoria.store'),
            'role'         => 'form',
            'id'           => 'form_categoria',
            'autocomplete' => 'off'
        );

        return $this->view('cliente.categorias.form-nuevo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if($request->ajax() &&  $request->wantsJson()){
            $categoria = new Categorias;
            $categoria->id = $categoria->getUniqueID();
            $categoria->cliente_id = $request->get('cliente_id');
            $categoria->categoria = mb_convert_case(trim(mb_strtolower($request->get('categoria'))), MB_CASE_TITLE, "UTF-8");

            if ($categoria->save()) {
                $response = [
                    'exito'  => TRUE,
                    'titulo' => 'Subcategoria añadida',
                    'texto'  => 'Se ha registrado "' . $categoria->categoria . '" correctamente.',
                    'url'    => ''
                ];
            } else {
                $response = [
                    'exito'  => FALSE,
                    'titulo' => 'Ups...',
                    'texto'  => 'No se guardo el registro en la base de datos',
                    'url'    => NULL,
                    'status' => 422
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

    public function datatable(Request $request, $cliente_id)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $order = $request->get('order');
        $columns = $request->get('columns');
        $search = $request->get('search');
        $total = Categorias::where('cliente_id', '=', $cliente_id)->count();

        if ($length == -1) {
            $length = NULL;
            $start = NULL;
        }

        $tCategoria = Categorias::getTableName();

        $campos = [
            $tCategoria . '.id',
            $tCategoria . '.categoria'
        ];

        $pos_col = $order[0]['column'];
        $order = $order[0]['dir'];
        $campo = $columns[$pos_col]['data'];

        $categorias =
            DB::table($tCategoria)
              ->select($campos)
              ->where($tCategoria . '.cliente_id', $cliente_id)
              ->where($tCategoria . '.categoria', 'LIKE', '%' . $search['value'] . '%')
              ->take($length)
              ->skip($start)
              ->orderBy($campo, $order)->get();

        $proceso = array();
        foreach ($categorias as $index => $categoria) {
            array_push(
                $proceso,
                [
                    "DT_RowId" => $categoria->id,
                    'categoria' => $categoria->categoria
                ]
            );
        }
        $data = [
            'draw' => $draw,
            'recordsTotal' => count($categorias),
            'recordsFiltered' => $total,
            'data' => $proceso
        ];

        return new JsonResponse($data, 200);
    }

    public function select (Request $request, $id)
    {
        if($request->ajax()){
            $categorias = Categorias::where('cliente_id', $id)->get(['id', 'categoria'])->ToArray();
            $options = '<option value=""></option>';

            foreach($categorias as $categoria){
                $options .= '<option value="'.$categoria['id'].'">'.$categoria['categoria'].'</option>';
            }

            return $options;
        }
    }
}
