<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Models\Cliente\Categorias;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
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
        $categorias = Categorias::where('cliente_id', $this->infoPropietario->id)
            ->orderBy('categoria', 'ASC')
            ->get(['id', 'categoria'])
            ->toArray();
        $options = array();
        foreach ($categorias as $key => $categoria) {
            $options[$categoria['id']] = $categoria['categoria'];
        }
        $llaves = array_keys($options);

        $llaves = (empty($llaves)) ? NULL : $llaves;

        $this->data['options'] = $options;
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
            $categoria->cliente_id = $this->infoPropietario->id;
            $categoria->categoria = mb_convert_case(trim(mb_strtolower($request->get('categoria'))), MB_CASE_TITLE, "UTF-8");
            $categoria->save();
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

    public function datatable(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $order = $request->get('order');
        $columns = $request->get('columns');
        $search = $request->get('search');
        $total = Categorias::count();

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
              ->where($tCategoria . '.cliente_id', $this->infoPropietario->id)
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
}
