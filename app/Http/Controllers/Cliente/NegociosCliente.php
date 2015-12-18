<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Models\Admin\Categorias;
use App\Http\Models\Admin\Ciudades;
use App\Http\Models\Cliente\Cliente;
use App\Http\Models\Cliente\ClienteDetalles;
use App\Http\Models\Cliente\ClienteHorarios;
use App\Http\Models\Cliente\ClienteRedesSociales;
use App\Http\Requests;
use App\Http\Requests\Cliente\CreateCliente;
use App\Http\Requests\Cliente\EditCliente;
use App\Library\UploadHanlder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\AdapterInterface;
use Parse\ParseException;
use Parse\ParseInstallation;
use Parse\ParsePush;
use PHPImageWorkshop\ImageWorkshop;

class NegociosCliente extends BaseCliente
{

	public function __construct()
	{
		parent::__construct();
		$this->data['activo_negocio'] = true;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->data['activo_negocio_index'] = true;

		return $this->view('cliente.negocios.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->data['param'] = [
			'route'        => 'cliente.negocio.store',
			'class'        => 'form-horizontal form-nuevo-cliente',
			'role'         => 'form',
			'autocomplete' => 'off'
		];

		$ciudades = Ciudades::get()->ToArray();
		$options = [];
		foreach ($ciudades as $index => $ciudad)
		{
			$options[$ciudad['id']] = $ciudad['ciudad'] . ', ' . $ciudad['estado'];
		}

		$categorias = Categorias::all(['id', 'categoria'])->ToArray();
		$options_categorias = ['' => ''];
		foreach ($categorias as $categoria)
		{
			$options_categorias[$categoria['id']] = $categoria['categoria'];
		}

		$this->data['options_categorias'] = $options_categorias;

		$this->data['options_ciudades'] = $options;
		$this->data['activo_negocio_nuevo'] = true;

		return $this->view('cliente.negocios.form-nuevo');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CreateCliente $request
	 *
	 * @return Response
	 */
	public function store(CreateCliente $request)
	{
		if ($request->ajax() && $request->wantsJson())
		{
			$cliente = new Cliente;
			$cliente->preparaDatos($request);


			if ($cliente->save())
			{
				$subIDs = [];
				for ($i = 0; $i < 3; $i++)
				{
					$var = $request->get("subcategoria" . ($i + 1));
					if (isset($var) && !empty($var))
					{
						array_push($subIDs, [
							'cliente_id'      => $cliente->id,
							'subcategoria_id' => $var
						]);
					}
				}

				$cliente->subcategorias()->sync($subIDs);

				$detalles = new ClienteDetalles();
				$detalles->id = $cliente->id;
				$cliente->detalles()->save($detalles);

				$redes_sociales = new ClienteRedesSociales();
				$redes_sociales->id = $cliente->id;
				$cliente->redesSociales()->save($redes_sociales);


				$response = [
					'exito'  => true,
					'titulo' => 'Cliente registrado',
					'texto'  => '¡Felicidades! <b>' . $cliente->nombre . '</b> se ha registrado.',
					'url'    => route('negocios-cliente')
				];

				try
				{
					$query = ParseInstallation::query();
					$query->equalTo("deviceType", "android");
					// Push to Channels
					ParsePush::send([
						"where" => $query,
						"data"  => [
							"data"          => [
								"message" => $cliente->nombre . " ahora esta en la app!",
								"title"   => "AndroidApp"
							],
							"is_background" => false
						]
					]);
				}
				catch (ParseException $e)
				{
					$response = [
						'exito'  => false,
						'titulo' => 'Cliente registrado',
						'texto'  => '¡Felicidades! <b>' . $cliente->nombre . '</b> se ha registrado, pero no se ha enviado la notificación: ' . $e->getMessage(),
						'url'    => route('negocios-cliente')
					];
				}
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
	 * @param \Illuminate\Http\Request $request
	 * @param  int                     $id
	 * @param                          $accion
	 *
	 * @return \App\Http\Controllers\Cliente\Response
	 */
	public function show(Request $request, $id, $accion = null)
	{
		if (!is_null($cliente = Cliente::find($id)))
		{

			if ($this->infoPropietario->id == $cliente->propietario->id)
			{

				$this->data['categoria'] = $cliente->subcategorias->first()->subcategoria;
				$this->data['cliente'] = $cliente;
				$this->data['current_cliente_id'] = $id;

				switch ($accion)
				{
					case null:
						return $this->view('cliente.negocios.perfil.index');
						break;
					case 'settings':

						$this->data['formprincipal'] = [
							'route'        => ['cliente.negocio.update', 'principal'],
							'class'        => 'form-horizontal form-edita-cliente',
							'role'         => 'form',
							'autocomplete' => 'off'
						];

						$this->data['formadicional'] = [
							'route'        => ['cliente.negocio.update', 'adicional'],
							'class'        => 'form-horizontal form-edita-cliente-detalles',
							'role'         => 'form',
							'autocomplete' => 'off'
						];

						$this->data['formredessociales'] = [
							'route'        => ['cliente.negocio.update', 'redessociales'],
							'class'        => 'form-horizontal form-edita-cliente-redes-sociales',
							'role'         => 'form',
							'autocomplete' => 'off'
						];

						$this->data['formhorarios'] = [
							'route'        => ['cliente.negocio.update', 'horarios'],
							'class'        => 'form-horizontal form-edita-cliente-horarios',
							'role'         => 'form',
							'autocomplete' => 'off'
						];

						$this->data['formgaleria'] = [
							'route' => ['cliente.negocio.upload-galeria', $id],
							'id'    => 'fileupload',
							'files' => true
						];

						$ciudades = Ciudades::get()->ToArray();
						$options = [];
						foreach ($ciudades as $index => $ciudad)
						{
							$options[$ciudad['id']] = $ciudad['ciudad'] . ', ' . $ciudad['estado'];
						}

						$categorias = Categorias::all(['id', 'categoria'])->ToArray();
						$options_categorias = ['' => ''];
						foreach ($categorias as $categoria)
						{
							$options_categorias[$categoria['id']] = $categoria['categoria'];
						}

						// Me aseguro que solo sean 3 categorias
						for ($i = 0; $i < 3; $i++)
						{
							/*
							 *  Extraigo las subcategorias del negocio en forma de arreglo,
							 * despues verifico si el indice existe dentro del array, con esto
							 * aseguro de seperar el array segun su cantidad de subcategorias
							*/
							if (array_key_exists($i, $cliente->subcategorias->toArray()))
							{
								$cl_categorias[$i]['categoria'] = $cliente->subcategorias[$i]->categoria->id;
								$cl_categorias[$i]['subcategoria'] = $cliente->subcategorias[$i]->id;
							}
							else
							{
								$cl_categorias[$i]['categoria'] = null;
								$cl_categorias[$i]['subcategoria'] = null;
							}
						}

						$grupos = ClienteHorarios::grupoId()
						                         ->where('cliente_id', $id)
						                         ->orderBy('id')
						                         ->get();
						$horarios = [];
						if (count($grupos) > 0)
						{
							foreach ($grupos as $grupo)
							{
								$dias = ClienteHorarios::where('grupo_id', $grupo->grupo_id)->get();

								$str_dias = '';
								foreach ($dias as $dia)
								{
									$str_dias .= mb_substr($dia->dia_semana, 0, 3) . ', ';
								}
								$str_dias = trim($str_dias, ", ");

								array_push($horarios, [
									'grupo_id' => $grupo->grupo_id,
									'dias'     => $str_dias,
									'horario'  => date('h:i a', strtotime($dias[0]->hora_abre)) . ' a ' . date('h:i a', strtotime($dias[0]->hora_cierra))
								]);
							}
						}


						$this->data['options_categorias'] = $options_categorias;
						$this->data['options_ciudades'] = $options;
						$this->data['cl_categorias'] = $cl_categorias;
						$this->data['horarios'] = $horarios;

						return $this->view('cliente.negocios.perfil.settings');
						break;
				}

			}
			else
			{
				return response('No autorizado', 401);
			}
		}
		else
		{
			return response('Este negocio no existe', 412);
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
	 * @param \App\Http\Requests\Cliente\EditCliente $request
	 *
	 * @param                                        $accion
	 *
	 * @return \App\Http\Controllers\Cliente\Response
	 */
	public function update(EditCliente $request, $accion)
	{
		if ($request->ajax() && $request->wantsJson())
		{
			if (!is_null($cliente = Cliente::find($request->get('id'))))
			{
				if ($this->infoPropietario->id == $cliente->propietario->id)
				{
					$save = false;
					switch ($accion)
					{
						case 'principal':
							$cliente->preparaDatos($request);
							$save = $cliente->save();

							$subIDs = [];
							for ($i = 1; $i <= 3; $i++)
							{
								$var = $request->get("subcategoria" . ($i));
								if (isset($var) && !empty($var))
								{
									array_push($subIDs, [
										'cliente_id'      => $cliente->id,
										'subcategoria_id' => $var
									]);
								}
							}

							$cliente->subcategorias()->detach();
							$cliente->subcategorias()->sync($subIDs);

							$data = [
								"data"          => [
									"message" => "Hello! Negocio editado",
									"title"   => "AndroidTest"
								],
								"is_background" => false
							];

							$response = [
								'exito'  => true,
								'titulo' => 'Cliente actualizado',
								'texto'  => '<b>' . $cliente->nombre . '</b> se ha actualizado.',
								'url'    => route('negocios-cliente')
							];
							break;
						case 'adicional':
							$cliente->detalles->preparaDatos($request);
							$save = $cliente->detalles->save();

							$response = [
								'exito'  => true,
								'titulo' => 'Información adicional actualizada',
								'texto'  => 'Se ha actualizado la información adicional del negocio',
								'url'    => route('negocios-cliente')
							];
							break;
						case 'redessociales':
							$cliente->redesSociales->preparaDatos($request);
							$save = $cliente->redesSociales->save();

							$response = [
								'exito'  => true,
								'titulo' => 'Redes Sociales actualizadas',
								'texto'  => 'Se ha actualizado las redes sociales del negocio',
								'url'    => route('negocios-cliente')
							];
							break;
						case 'horarios':
							$horarios = new ClienteHorarios();
							$data = $horarios->preparaDatos($request);
							$save = $horarios->insert($data);

							if ($save)
							{
								$dias = $data;
								$str_dias = '';
								foreach ($dias as $dia)
								{
									$str_dias .= mb_substr($dia['dia_semana'], 0, 3) . ', ';
								}
								$str_dias = trim($str_dias, ", ");
								$horas = date('h:i a', strtotime($dias[0]['hora_abre'])) . ' a ' . date('h:i a', strtotime($dias[0]['hora_cierra']));
							}

							$response = [
								'exito'  => $save,
								'titulo' => 'Nuevo horario añadido',
								'texto'  => 'Se añadio nuevo grupo de horario al negocio',
								'url'    => route('negocios-cliente'),
								'extras' => [
									'cliente_id' => $cliente->id,
									'grupo_id'   => $dias[0]['grupo_id'],
									'dias'       => $str_dias,
									'horas'      => $horas,
									'delete_url' => route('cliente.negocio.destroy.horario')
								]
							];
							break;
					}

					if (!$save)
					{
						$response = [
							'exito'  => false,
							'titulo' => 'No se actualizó',
							'texto'  => 'Parece que no hubo cambios en la BD',
							'url'    => null
						];
					}

					$query = ParseInstallation::query();
					$query->equalTo("deviceType", "android");
					// Push to Channels
					ParsePush::send([
						"where" => $query,
						"data"  => [
							"data"          => [
								"message" => $cliente->nombre . " ha cambiado sus datos.",
								"title"   => "AndroidApp"
							],
							"is_background" => false
						]
					]);

					return $this->responseJSON($response);
				}
				else
				{
					return response('No autorizado', 401);
				}
			}
			else
			{
				return response('Este negocio no existe', 412);
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

	public function destroyGrupoHorario(Request $request)
	{
		$id = $request->get('id');
		$grupoid = $request->get('grupoid');
		if (!is_null($horarios = ClienteHorarios::where('grupo_id', $grupoid)
		                                        ->where('cliente_id', $id)
		                                        ->get(['id'])
		                                        ->toArray())
		)
		{
			$ids = [];
			foreach ($horarios as $horario)
			{
				array_push($ids, $horario['id']);
			}
			$exito = ClienteHorarios::destroy($ids);
		}

		return $this->responseJSON([
			'exito'  => ($exito) ? true : false,
			'titulo' => 'Horario eliminado',
			'texto'  => 'Grupo de horario eliminado',
			'url'    => null
		]);
	}

	public function cropImage(Request $request)
	{
		if ($request->ajax())
		{
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

			$dirPath = 'cliente/' . $cliente_id . '/logo/';
			$localPath = 'local/' . $dirPath;
			$filename = str_random() . '.' . pathinfo($imgUrl, PATHINFO_EXTENSION);

			unlink($localPath . pathinfo($imgUrl, PATHINFO_BASENAME));

			$createFolders = true;
			$backgroundColor = null; // transparent, only for PNG (otherwise it will be white if set null)
			$imageQuality = 100; // useless for GIF, usefull for PNG and JPEG (0 to 100%)

			$layer->save($localPath, $filename, $createFolders, $backgroundColor, $imageQuality);

			$cliente = Cliente::find($cliente_id);
			$cliente->logo = $filename;
			$cliente->save();

			$localFile = $localPath . $filename;
			$toGCS = $dirPath . $filename;

			// Google Cloud
			$files = Storage::files($dirPath);
			Storage::delete($files);
			Storage::put($toGCS, File::get($localFile));
			Storage::setVisibility($toGCS, AdapterInterface::VISIBILITY_PUBLIC);

			unlink($localFile);
			rmdir($localPath);

			$base_url = env('URI_STORAGE');

			$response = [
				"status" => 'success',
				"url"    => $base_url . $toGCS
			];

			return new JsonResponse($response);
		}
	}

	public function uploadImage(Request $request)
	{
		if ($request->ajax() && $request->file('img'))
		{
			$cliente_id = $request->get('cliente_id');
			$img = $request->file('img');

			$imagePath = "cliente/" . $cliente_id . "/logo/";
			$localPath = 'local/' . $imagePath;
			$allowedExts = ["gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG"];


			if (!File::isDirectory($localPath))
			{
				File::makeDirectory($localPath, 0777, true);
			}
			else
			{
				File::cleanDirectory($localPath);
			}

			if (!File::isWritable($localPath))
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
					$request->file('img')->move($localPath, $name);
					$response = [
						"status" => 'success',
						"url"    => asset($localPath . $name),
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

	public function uploadGaleria(Request $request, $id_cliente)
	{
		$options = [
			'id_cliente' => $id_cliente,
			'script_url'          => route('cliente.negocio.upload-galeria', $id_cliente),
			'upload_dir'          => dirname($_SERVER['SCRIPT_FILENAME']) . '/cliente/' . $id_cliente . '/galeria/',
			'upload_url'          => url('cliente') . '/' . $id_cliente . '/galeria/',
			// The php.ini settings upload_max_filesize and post_max_size
			// take precedence over the following max_file_size setting:
			'max_file_size'       => null,
			'min_file_size'       => 1,
			// The maximum number of files for the upload directory:
			'max_number_of_files' => null,
			// Defines which files are handled as image files:
			'image_file_types'    => '/\.(gif|jpe?g|png)$/i',
			// Image resolution restrictions:
			'max_width'           => null,
			'max_height'          => null,
			'min_width'           => 800,
			'min_height'          => 600,
			'image_versions'      => [
				// The empty image version key defines options for the original image:
				''          => [
					// Automatically rotate images based on EXIF meta data:
					'auto_orient' => true,
					'max_width'   => 800,
					'max_height'  => 600,
					'crop'        => true,
				],
				// Uncomment the following to create medium sized images:
				/*
				'medium' => array(
				    'max_width' => 800,
				    'max_height' => 600
				),
				*/
				'thumbnail' => [
					// Uncomment the following to use a defined directory for the thumbnails
					// instead of a subdirectory based on the version identifier.
					// Make sure that this directory doesn't allow execution of files if you
					// don't pose any restrictions on the type of uploaded files, e.g. by
					// copying the .htaccess file from the files directory for Apache:
					//'upload_dir' => dirname($this->get_server_var('SCRIPT_FILENAME')).'/thumb/',
					//'upload_url' => $this->get_full_url().'/thumb/',
					// Uncomment the following to force the max
					// dimensions and e.g. create square thumbnails:
					'crop'       => true,
					'max_width'  => 80,
					'max_height' => 80
				]
			]
		];
		new UploadHanlder($options);
	}
}
