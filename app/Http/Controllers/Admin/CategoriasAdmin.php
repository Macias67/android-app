<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Admin\Categorias;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CategoriasAdmin extends BaseAdmin
{

	public function __construct()
	{
		parent::__construct();
		$this->data['activo_categorias'] = true;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->view('admin.categorias.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categorias = Categorias::orderBy('categoria', 'ASC')->get()->toArray();
		$options = [];
		foreach ($categorias as $key => $categoria)
		{
			$options[$categoria['id']] = $categoria['categoria'];
		}
		$llaves = array_keys($options);

		$llaves = (empty($llaves)) ? null : $llaves;

		$this->data['options'] = $options;
		$this->data['llaves'] = $llaves;
		$this->data['array_form'] = [
			'url'          => route('adm.categoria.store'),
			'role'         => 'form',
			'id'           => 'form_categoria',
			'autocomplete' => 'off'
		];

		return $this->view('admin.categorias.form-nuevo');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if ($request->ajax() && $request->wantsJson())
		{
			$categoria = new Categorias();
			$categoria->categoria = mb_convert_case(trim(mb_strtolower($request->get('categoria'))), MB_CASE_TITLE, "UTF-8");

			if ($categoria->save())
			{
				$response = [
					'exito'  => true,
					'titulo' => 'Categoria añadida',
					'texto'  => 'Se ha registrado "' . $categoria->categoria . '" correctamente.',
					'url'    => ''
				];
			}
			else
			{
				$response = [
					'exito'  => false,
					'titulo' => 'Ups...',
					'texto'  => 'No se guardo el registro en la base de datos',
					'url'    => null,
					'status' => 422
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
	public function show($id)
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
	public function edit($id)
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
	public function update(Request $request, $id)
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
	public function destroy($id)
	{
		// TODO: Implement destroy() method.
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

		if ($length == -1)
		{
			$length = null;
			$start = null;
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
			  ->where($tCategoria . '.categoria', 'LIKE', '%' . $search['value'] . '%')
			  ->take($length)
			  ->skip($start)
			  ->orderBy($campo, $order)->get();

		$proceso = [];
		foreach ($categorias as $index => $categoria)
		{
			array_push(
				$proceso,
				[
					"DT_RowId"  => $categoria->id,
					'categoria' => $categoria->categoria
				]
			);
		}
		$data = [
			'draw'            => $draw,
			'recordsTotal'    => count($categorias),
			'recordsFiltered' => $total,
			'data'            => $proceso
		];

		return new JsonResponse($data, 200);
	}

	public function select2()
	{

	}
}
