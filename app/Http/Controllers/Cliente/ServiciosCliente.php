<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Traits\GetImagesCliente;
use App\Http\Models\Cliente\Categorias;
use App\Http\Models\Cliente\Cliente;
use App\Http\Models\Cliente\Propietario;
use App\Http\Models\Cliente\Servicios;
use App\Http\Requests;
use App\Http\Requests\Servicios\CreateServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Jenssegers\Date\Date;
use PHPImageWorkshop\ImageWorkshop;
use Symfony\Component\HttpFoundation\JsonResponse;

class ServiciosCliente extends BaseCliente
{
	use GetImagesCliente;

	public function __construct()
	{
		parent::__construct();
		$this->data['activo_servicios'] = true;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$cl_servicios = Servicios::getTableName();
		$cl_clientes = Cliente::getTableName();
		$cl_propietario = Propietario::getTableName();

		$servicios = DB::table($cl_servicios)
		               ->select(
			               $cl_servicios . '.id',
			               $cl_clientes . '.id as cliente_id',
			               $cl_clientes . '.nombre as nombre_cliente',
			               $cl_servicios . '.nombre as nombre_servicio',
			               $cl_servicios . '.descripcion_corta',
			               DB::raw('COUNT(usr_usuario_gusta_servicio.servicio_id) AS totalLikes')
		               )
		               ->join($cl_clientes, $cl_servicios . '.cliente_id', '=', $cl_clientes . '.id')
		               ->join($cl_propietario, $cl_clientes . '.propietario_id', '=', $cl_propietario . '.id')
		               ->join('usr_usuario_gusta_servicio', $cl_servicios . '.id', '=', 'usr_usuario_gusta_servicio.servicio_id')
		               ->where($cl_propietario . '.id', '=', $this->infoPropietario->id)
		               ->groupBy($cl_servicios . '.nombre')
		               ->orderBy('totalLikes', 'DESC')
		               ->take(10)
		               ->get();

		$clientes = Cliente::where('propietario_id', $this->infoPropietario->id)->get(['id', 'nombre', 'logo']);

		$ultimosRegistrados = Servicios::byIdPropietario($this->infoPropietario->id);
		foreach ($ultimosRegistrados as $servicio)
		{
			$servicio->imagen = $this->_getImage($servicio->cliente_id, 'servicios', $servicio->id);
			$servicio->fecha = Date::createFromFormat('Y-m-d H:i:s', $servicio->created_at)->format('d \\d\\e F \\d\\e\\l Y');
		}

		foreach ($servicios as $servicio)
		{
			$servicio->imagen = $this->_getImage($servicio->cliente_id, 'servicios', $servicio->id);
		}

		$this->data['negocios'] = $clientes;
		$this->data['serviciosMasGustados'] = $servicios;
		$this->data['ultimosServicios'] = $ultimosRegistrados;

		return $this->view('cliente.servicios.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->data['param'] = [
			'route'        => 'cliente.servicios.store',
			'class'        => 'form-horizontal form-nuevo-servicio',
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

		return $this->view('cliente.servicios.form-nuevo');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \App\Http\Requests\Servicios\CreateServicio $request
	 *
	 * @return \App\Http\Controllers\Cliente\Response
	 */
	public function store(CreateServicio $request)
	{
		if ($request->ajax() && $request->wantsJson())
		{
			$servicio = new Servicios;;
			$servicio->preparaDatos($request);

			if ($servicio->save())
			{
				$response = [
					'exito'  => true,
					'titulo' => 'Servicio registrado',
					'texto'  => '¡Felicidades! <b>' . $servicio->nombre . '</b> se ha registrado.',
					'url'    => route('servicios-cliente')
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
		if (!is_null($servicio = Servicios::find($id)))
		{

			$idPropietario = $servicio->idPropietario($this->infoPropietario->id, $id);

			if ($this->infoPropietario->id == $idPropietario[0]['id'])
			{

				$this->data['param'] = [
					'route'        => 'cliente.servicios.update',
					'class'        => 'form-horizontal form-edita-servicios',
					'role'         => 'form',
					'autocomplete' => 'off'
				];

				$categorias = Categorias::where('cliente_id', $servicio->cliente_id)
				                        ->get(['id', 'categoria'])
				                        ->ToArray();
				$options = [];
				foreach ($categorias as $index => $categoria)
				{
					$options[$categoria['id']] = $categoria['categoria'];
				}


				$this->data['servicio'] = $servicio;
				$this->data['categorias'] = $options;
				$this->data['img_servicio'] = $this->_getImage($servicio->cliente_id, 'servicios', $id);
				$this->data['current_servicio_id'] = $id;

				return $this->view('cliente.servicios.perfil.settings');
			}
			else
			{
				return response('No es tu servicio.', 412);
			}
		}
		else
		{
			return response('No existe servicio.', 412);
		}
	}

	public function showServiciosCliente($id)
	{
		if (!is_null($cliente = Cliente::find($id)))
		{
			if ($cliente->propietario->id == $this->infoPropietario->id)
			{
				$this->data['cliente'] = $cliente;

				return /*$this->view('cliente.servicios.servicios-cliente')*/
					'En proceso';
			}
		}
		else
		{
			return response('No existe evento.', 412);
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
	 * @param CreateServicio $request
	 *
	 * @return Response
	 */
	public function update(CreateServicio $request)
	{
		if ($request->ajax() && $request->wantsJson())
		{

			if (!is_null($servicio = Servicios::find($request->get('id'))))
			{
				$servicio->preparaDatos($request);

				if ($servicio->save())
				{
					$response = [
						'exito'  => true,
						'titulo' => 'servicio actualizado',
						'texto'  => '<b>' . $servicio->nombre . '</b> se ha actualizado.',
						'url'    => route('servicios-cliente')
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

	public function uploadImage(Request $request)
	{
		if ($request->ajax() && $request->file('img'))
		{
			$servicio_id = $request->get('servicio_id');
			$cliente_id = $request->get('cliente_id');
			$imagePath = "img/cliente/" . $cliente_id . "/servicios/" . $servicio_id . '/';
			$allowedExts = ["gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG"];
			$temp = explode(".", $_FILES["img"]["name"]);
			$extension = end($temp);

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

			if (in_array($extension, $allowedExts))
			{
				if ($_FILES["img"]["error"] > 0)
				{
					$response = [
						"status"  => 'error',
						"message" => 'ERROR Return Code: ' . $_FILES["img"]["error"],
					];
				}
				else
				{
					$filename = $_FILES["img"]["tmp_name"];
					list($width, $height) = getimagesize($filename);
					$request->file('img')->move($imagePath, $_FILES["img"]["name"]);
					$response = [
						"status" => 'success',
						"url"    => asset($imagePath . $_FILES["img"]["name"]),
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

	public function cropImage(Request $request)
	{
		if ($request->ajax())
		{
			$servicio_id = $request->get('servicio_id');
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

			unlink("img/cliente/" . $cliente_id . "/servicios/" . $servicio_id . "/" . pathinfo($imgUrl, PATHINFO_BASENAME));

			$dirPath = "img/cliente/" . $cliente_id . "/servicios/" . $servicio_id . '/';
			$filename = strtolower(str_random(15)) . '-' . $servicio_id . '.' . pathinfo($imgUrl, PATHINFO_EXTENSION);
			$createFolders = true;
			$backgroundColor = null; // transparent, only for PNG (otherwise it will be white if set null)
			$imageQuality = 100; // useless for GIF, usefull for PNG and JPEG (0 to 100%)

			$layer->save($dirPath, $filename, $createFolders, $backgroundColor, $imageQuality);

			$response = [
				"status" => 'success',
				"url"    => asset($dirPath . $filename)
			];

			return new JsonResponse($response);
		}
	}

	public function getServiciosJson($id)
	{
		$categoria = new Categorias;
		$categorias = $categoria->where('cliente_id', $id)->get();

		$final = [];
		foreach ($categorias as $categoria)
		{
			$servicios = $categoria->servicios->toArray();

			$arrayservicios = [];
			foreach ($servicios as $key => $servicio)
			{
				array_push($arrayservicios, $servicio);
			}

			$allCategorias = [];
			$allCategorias['categoria'] = $categoria['categoria'];
			$allCategorias['servicios'] = $arrayservicios;
			array_push($final, $allCategorias);
		}

		return new JsonResponse($final);
	}

}
