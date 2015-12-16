<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Traits\GetImagesCliente;
use App\Http\Models\Cliente\Categorias;
use App\Http\Models\Cliente\Cliente;
use App\Http\Models\Cliente\Producto;
use App\Http\Models\Cliente\Propietario;
use App\Http\Requests\Producto\CreateProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Date\Date;
use League\Flysystem\AdapterInterface;
use PHPImageWorkshop\ImageWorkshop;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductosCliente extends BaseCliente
{
	use GetImagesCliente;

	public function __construct()
	{
		parent::__construct();
		$this->data['activo_productos'] = true;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$cl_productos = Producto::getTableName();
		$cl_clientes = Cliente::getTableName();
		$cl_propietario = Propietario::getTableName();

		$productosMasGustados = DB::table($cl_productos)
                          ->select(
	                          $cl_productos . '.id',
	                          $cl_clientes . '.id as cliente_id',
	                          $cl_clientes . '.nombre as nombre_cliente',
	                          $cl_productos . '.nombre as nombre_producto',
	                          $cl_productos . '.descripcion_corta',
	                          DB::raw('COUNT(usr_usuario_gusta_producto.producto_id) AS totalLikes')
                          )
                          ->join($cl_clientes, $cl_productos . '.cliente_id', '=', $cl_clientes . '.id')
                          ->join($cl_propietario, $cl_clientes . '.propietario_id', '=', $cl_propietario . '.id')
                          ->join('usr_usuario_gusta_producto', $cl_productos . '.id', '=', 'usr_usuario_gusta_producto.producto_id')
                          ->where($cl_propietario . '.id', $this->infoPropietario->id)
                          ->groupBy($cl_productos . '.nombre')
                          ->orderBy('totalLikes', 'DESC')
                          ->take(10)
                          ->get();
		foreach ($productosMasGustados as $producto)
		{
			$producto->imagen = $this->_getImage($producto->cliente_id, 'productos', $producto->id);
		}

		$clientes = Cliente::where('propietario_id', $this->infoPropietario->id)->get(['id', 'nombre','logo']);

		$ultimosRegistrados = Producto::byIdPropietario($this->infoPropietario->id);
		foreach ($ultimosRegistrados as $producto)
		{
			$producto->imagen = $this->_getImage($producto->cliente_id, 'productos', $producto->id);
			$producto->fecha = Date::createFromFormat('Y-m-d H:i:s', $producto->created_at)->format('d \\d\\e F \\d\\e\\l Y');
		}

		$this->data['productosMasGustados'] = $productosMasGustados;
		$this->data['negocios'] = $clientes;
		$this->data['ultimosRegistrados'] = $ultimosRegistrados;

		return $this->view('cliente.productos.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->data['param'] = [
			'route'        => 'cliente.producto.store',
			'class'        => 'form-horizontal form-nuevo-producto',
			'role'         => 'form',
			'autocomplete' => 'off'
		];

		$clientes = Cliente::where('propietario_id', $this->infoPropietario->id)->get(['id', 'nombre'])->ToArray();
		$options = [];
		foreach ($clientes as $index => $cliente)
		{
			$options[$cliente['id']] = $cliente['nombre'];
		}
		$this->data['negocios'] = $options;

		return $this->view('cliente.productos.form-nuevo');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CreateProducto $request
	 *
	 * @return Response
	 */
	public function store(CreateProducto $request)
	{
		if ($request->ajax() && $request->wantsJson())
		{
			$producto = new Producto;
			$producto->preparaDatos($request);

			if ($producto->save())
			{
				$response = [
					'exito'  => true,
					'titulo' => 'Producto registrado',
					'texto'  => '¡Felicidades! <b>' . $producto->nombre . '</b> se ha registrado.',
					'url'    => route('productos-cliente')
				];
			}
			else
			{
				$response = [
					'exito'  => false,
					'titulo' => 'No se registró',
					'texto'  => 'Parece que no hubo registro en la BD',
					'url'    => null
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
		if (!is_null($producto = Producto::find($id)))
		{
			$idPropietario = $producto->idPropietario($this->infoPropietario->id, $id);
			if ($this->infoPropietario->id == $idPropietario[0]['id'])
			{
				$this->data['param'] = [
					'route'        => 'cliente.producto.update',
					'class'        => 'form-horizontal form-edita-producto',
					'role'         => 'form',
					'autocomplete' => 'off'
				];
				$categorias = Categorias::where('cliente_id', $producto->cliente_id)
				                        ->get(['id', 'categoria'])
				                        ->ToArray();
				$options = [];
				foreach ($categorias as $index => $categoria)
				{
					$options[$categoria['id']] = $categoria['categoria'];
				}

				$this->data['producto'] = $producto;
				$this->data['categorias'] = $options;
				$this->data['img_producto'] = $this->_getImage($producto->cliente_id, 'productos', $id);
				$this->data['current_producto_id'] = $id;

				return $this->view('cliente.productos.perfil.settings');
			}
			else
			{
				return response('No es tu producto.', 412);
			}
		}
		else
		{
			return response('No existe producto.', 412);
		}
	}

	public function showProductosCliente($id)
	{
		if (!is_null($cliente = Cliente::find($id)))
		{
			if ($cliente->propietario->id == $this->infoPropietario->id)
			{
				$categorias = Categorias::where('cliente_id', $cliente->id)->get(['id', 'categoria'])->ToArray();
				$optionsCategorias = [];
				foreach ($categorias as $index => $categoria)
				{
					$optionsCategorias[$categoria['id']] = $categoria['categoria'];
				}
				$llaves = array_keys($optionsCategorias);
				$llaves = (empty($llaves)) ? null : $llaves;

				$this->data['array_form'] = [
					'url'          => '',
					'role'         => 'form',
					'id'           => 'categoria_id',
					'autocomplete' => 'off'
				];
				$this->data['cliente'] = $cliente;
				$this->data['categorias'] = $optionsCategorias;
				$this->data['llaves'] = $llaves;

				return $this->view('cliente.productos.productos-cliente');
			}
		}
		else
		{
			return response('No existe Negocio.', 412);
		}
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param CreateProducto $request
	 *
	 * @return Response
	 */
	public function update(CreateProducto $request)
	{
		if ($request->ajax() && $request->wantsJson())
		{

			if (!is_null($producto = Producto::find($request->get('id'))))
			{
				$producto->preparaDatos($request);

				if ($producto->save())
				{
					$response = [
						'exito'  => true,
						'titulo' => 'Producto actualizado',
						'texto'  => '<b>' . $producto->nombre . '</b> se ha actualizado.',
						'url'    => route('productos-cliente')
					];
				}
				else
				{
					$response = [
						'exito'  => false,
						'titulo' => 'No se actualizó',
						'texto'  => 'Parece que no hubo cambios en la BD',
						'url'    => null
					];
				}

				return $this->responseJSON($response);

			}
		}
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
		//
	}

	/**
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function uploadImage(Request $request)
	{
		if ($request->ajax() && $request->file('img'))
		{
			$producto_id = $request->get('producto_id');
			$cliente_id = $request->get('cliente_id');
			$img = $request->file('img');

			$imagePath = 'cliente/' . $cliente_id . "/productos/" . $producto_id . '/';
			$allowedExts = ["gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG"];

			if (!File::isDirectory($imagePath))
			{
				File::makeDirectory($imagePath, 0777, true);
			}
			else
			{
				File::cleanDirectory($imagePath);
			}

			if (!File::isWritable($imagePath))
			{
				$response = [
					"status"  => 'error',
					"message" => 'Can`t upload File; no write Access'
				];

				return new JsonResponse($response);
			}

			if (in_array($img->getClientOriginalExtension(), $allowedExts))
			{
				if ($img->getError() === false)
				{
					$response = [
						"status"  => 'error',
						"message" => 'ERROR Return Code: ' . $img->getErrorMessage(),
					];
				}
				else
				{
					$name = str_random() . '.' . $img->getClientOriginalExtension();
					list($width, $height) = getimagesize($img->getRealPath());
					$request->file('img')->move($imagePath, $name);
					$response = [
						"status" => 'success',
						"url"    => asset($imagePath . $name),
						"width"  => $width,
						"height" => $height
					];
				}
			}
			else
			{
				$response = [
					"status"  => 'error',
					"message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
				];
			}

			return new JsonResponse($response);
		}
	}

	/**
	 * @param Request $request
	 *
	 * @return JsonResponse
	 * @throws \PHPImageWorkshop\Core\Exception\ImageWorkshopLayerException
	 * @throws \PHPImageWorkshop\Exception\ImageWorkshopException
	 */
	public function cropImage(Request $request)
	{
		if ($request->ajax())
		{
			$producto_id = $request->get('producto_id');
			$cliente_id = $request->get('cliente_id');
			$imgUrl = $request->get('imgUrl');
			// original sizes
			$imgInitW = $request->get('imgInitW');
			$imgInitH = $request->get('imgInitH');
			// resized sizes
			$imgW = $request->get('imgW');
			$imgH = $request->get('imgH');
			// offsets
			$imgX1 = $request->get('imgX1');
			$imgY1 = $request->get('imgY1');
			// crop box
			$cropW = $request->get('cropW');
			$cropH = $request->get('cropH');
			// rotation angle
			$angle = $request->get('rotation');

			$layer = ImageWorkshop::initFromPath($imgUrl);

			$layer->resizeInPixel($imgW, $imgH, true, 0, 0, 'LT');
			$layer->cropInPixel(500, 500, $imgX1, $imgY1, 'LT');

			unlink("cliente/" . $cliente_id . "/productos/" . $producto_id . "/" . pathinfo($imgUrl, PATHINFO_BASENAME));

			$dirPath = 'cliente/' . $cliente_id . "/productos/" . $producto_id . '/';
			$filename = str_random() . '.' . pathinfo($imgUrl, PATHINFO_EXTENSION);
			$createFolders = true;
			$backgroundColor = null; // transparent, only for PNG (otherwise it will be white if set null)
			$imageQuality = 100; // useless for GIF, usefull for PNG and JPEG (0 to 100%)

			$layer->save($dirPath, $filename, $createFolders, $backgroundColor, $imageQuality);

			$name = $dirPath . $filename;
			// Google Cloud
			Storage::put($name, File::get($name));
			Storage::setVisibility($name, AdapterInterface::VISIBILITY_PUBLIC);

			unlink($name);

			$base_url = Config::get('filesystems.disks.gcs.base_url');

			$response = [
				"status" => 'success',
				"url"    => $base_url . $name
			];

			return new JsonResponse($response);
		}
	}

	/**
	 * @param $id
	 *
	 * @return JsonResponse
	 */
	public function getProductosJson($id)
	{
		$categoria = new Categorias;
		$categorias = $categoria->where('cliente_id', $id)->get();

		$final = [];
		foreach ($categorias as $categoria)
		{
			$productos = $categoria->productos->toArray();

			$arrayProductos = [];
			foreach ($productos as $key => $producto)
			{
				array_push($arrayProductos, $producto);
			}

			$allCategorias = [];
			$allCategorias['categoria'] = $categoria['categoria'];
			$allCategorias['productos'] = $arrayProductos;
			array_push($final, $allCategorias);
		}

		return new JsonResponse($final);
	}

	/**
	 * Uso de datable en la sección de
	 * nueva categoría
	 *
	 * @param Request $request
	 * @param         $categoria_id
	 *
	 * @return \Symfony\Component\HttpFoundation\JsonResponse
	 */
	public function datatable(Request $request, $categoria_id = null)
	{
		$draw = $request->get('draw');
		$start = $request->get('start');
		$length = $request->get('length');
		$order = $request->get('order');
		$columns = $request->get('columns');
		$search = $request->get('search');

		$byCategoria = is_null($categoria_id);

		$total = ($byCategoria) ? Producto::count() : Producto::where('categoria_id', $categoria_id)->count();

		if ($length == -1)
		{
			$length = null;
			$start = null;
		}

		$tProducto = Producto::getTableName();

		$campos = [
			$tProducto . '.id',
			$tProducto . '.nombre'
		];

		$pos_col = $order[0]['column'];
		$order = $order[0]['dir'];
		$campo = $columns[$pos_col]['data'];

		$id_cliente = $request->get('id_cliente');

		$productos = ($byCategoria) ?
			DB::table($tProducto)
			  ->select($campos)
			  ->where($tProducto . '.cliente_id', $id_cliente)
			  ->where($tProducto . '.nombre', 'LIKE', '%' . $search['value'] . '%')
			  ->take($length)
			  ->skip($start)
			  ->orderBy($campo, $order)->get() :
			DB::table($tProducto)
			  ->select($campos)
			  ->where($tProducto . '.categoria_id', $categoria_id)
			  ->where($tProducto . '.nombre', 'LIKE', '%' . $search['value'] . '%')
			  ->take($length)
			  ->skip($start)
			  ->orderBy($campo, $order)->get();

		$proceso = [];
		foreach ($productos as $index => $producto)
		{
			array_push(
				$proceso,
				[
					'DT_RowId' => $producto->id,
					'nombre'   => $producto->nombre,
					'url'      => route('cliente.producto.show', [$producto->id])
				]
			);
		}
		$data = [
			'draw'            => $draw,
			'recordsTotal'    => count($productos),
			'recordsFiltered' => $total,
			'data'            => $proceso
		];

		return new JsonResponse($data, 200);
	}
}
