<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Admin\SubCategorias;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoriasAdmin extends BaseAdmin
{
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

    public function dropdown (Request $request, $id)
    {
        if ($request->ajax() && $request->wantsJson()) {
            $subcategorias = SubCategorias::where('subcategoria', $id);

            dd($subcategorias);
        }
    }
}
