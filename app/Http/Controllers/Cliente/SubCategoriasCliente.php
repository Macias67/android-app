<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Models\Cliente\SubCategorias;
use App\Http\Requests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoriasCliente extends BaseCliente
{
    public function store (Request $request)
    {
        if($request->ajax() &&  $request->wantsJson()) {
            $subcategoria = new SubCategorias;
            $subcategoria->categoria_id = $request->get('categoria_id');
            $subcategoria->subcategoria = mb_convert_case(trim(mb_strtolower($request->get('sub'))), MB_CASE_TITLE, "UTF-8");

            if ($subcategoria->save()) {
                $response = [
                    'exito'  => TRUE,
                    'titulo' => 'Subcategoria añadida',
                    'texto'  => 'Se ha registrado "' . $subcategoria->subcategoria . '" correctamente.',
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

    public function datatable (Request $request, $id)
    {
        $draw    = $request->get('draw');
        $start   = $request->get('start');
        $length  = $request->get('length');
        $order   = $request->get('order');
        $columns = $request->get('columns');
        $search  = $request->get('search');
        $total   = SubCategorias::where('categoria_id', '=', $id)->count();

        if ($length == -1) {
            $length = NULL;
            $start  = NULL;
        }

        $tSubCategoria = SubCategorias::getTableName();

        $campos = [
            $tSubCategoria . '.id',
            $tSubCategoria . '.categoria_id',
            $tSubCategoria . '.subcategoria'
        ];

        $pos_col = $order[0]['column'];
        $order   = $order[0]['dir'];
        $campo   = $columns[$pos_col]['data'];

        $subcategorias =
            DB::table($tSubCategoria)->select($campos)->where($tSubCategoria . '.categoria_id', '=', $id)->where(
                $tSubCategoria . '.subcategoria',
                'LIKE',
                '%' . $search['value'] . '%'
            )->take($length)->skip($start)->orderBy($campo, $order)->get();

        $proceso = array();
        foreach ($subcategorias as $index => $subcategoria) {
            array_push(
                $proceso,
                [
                    "DT_RowId"     => $subcategoria->id,
                    'subcategoria' => $subcategoria->subcategoria
                ]
            );
        }
        $data = [
            'draw'            => $draw,
            'recordsTotal'    => count($subcategorias),
            'recordsFiltered' => $total,
            'data'            => $proceso
        ];

        return new JsonResponse($data, 200);
    }
}