<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Traits\GetImagesCliente;
use App\Http\Models\Cliente\Categorias;
use App\Http\Models\Cliente\Cliente;
use App\Http\Models\Cliente\Promociones;
use App\Http\Models\Cliente\Propietario;
use App\Http\Requests;
use App\Http\Requests\Promociones\CreatePromociones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Jenssegers\Date\Date;
use PHPImageWorkshop\ImageWorkshop;
use Symfony\Component\HttpFoundation\JsonResponse;

class PromocionesCliente extends BaseCliente
{
    use GetImagesCliente;

    public function __construct()
    {
        parent::__construct();
        $this->data['activo_promociones'] = TRUE;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $cl_promociones = Promociones::getTableName();
        $cl_clientes = Cliente::getTableName();
        $cl_propietario = Propietario::getTableName();
        $clientes = Cliente::where('propietario_id', $this->infoPropietario->id)->get(['id', 'nombre']);
        $ultimosRegistrados = Promociones::byIdPropietario($this->infoPropietario->id);

        $promocionesMasGustadas = DB::table($cl_promociones)
                         ->select(
                             $cl_promociones . '.id',
                             $cl_clientes . '.id as cliente_id',
                             $cl_clientes . '.nombre as nombre_cliente',
                             $cl_promociones . '.nombre as nombre_promocion',
                             DB::raw('COUNT(usr_usuario_gusta_promocion.promocion_id) AS totalLikes')
                         )
                         ->join($cl_clientes, $cl_promociones . '.cliente_id', '=', $cl_clientes . '.id')
                         ->join($cl_propietario, $cl_clientes . '.propietario_id', '=', $cl_propietario . '.id')
                         ->join('usr_usuario_gusta_promocion', $cl_promociones . '.id', '=', 'usr_usuario_gusta_promocion.promocion_id')
                         ->where($cl_propietario . '.id', '=', $this->infoPropietario->id)
                         ->groupBy($cl_promociones . '.nombre')
                         ->orderBy('totalLikes', 'DESC')
                         ->take(10)
                         ->get();


        foreach ($promocionesMasGustadas as $promocion) {
            $promocion->imagen = $this->_getImage($promocion->cliente_id, 'promociones', $promocion->id);
        }

        $ultimosRegistrados = Promociones::byIdPropietario($this->infoPropietario->id);
        foreach ($ultimosRegistrados as $promocion) {
            $promocion->imagen = $this->_getImage($promocion->cliente_id, 'promociones', $promocion->id);
            $promocion->fecha =  Date::createFromFormat('Y-m-d H:i:s', $promocion->created_at)->format('d \\d\\e F \\d\\e\\l Y');
            $promocion->fecha =  Date::createFromFormat('Y-m-d H:i:s', $promocion->created_at)->format('d \\d\\e F \\d\\e\\l Y');
        }

        $this->data['promocionesMasGustadas'] = $promocionesMasGustadas;
        $this->data['negocios'] = $clientes;
        $this->data['ultimosRegistrados'] = $ultimosRegistrados;


        return $this->view('cliente.promociones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->data['param'] = [
            'route' => 'cliente.promociones.store',
            'class' => 'form-horizontal form-nuevo-promociones',
            'role' => 'form',
            'autocomplete' => 'off'
        ];

        $clientes = Cliente::where('propietario_id', $this->infoPropietario->id)->get(['id', 'nombre'])->ToArray();
        $options = [];
        foreach ($clientes as $index => $cliente) {
            $options[$cliente['id']] = $cliente['nombre'];
        }
        $this->data['negocios'] = $options;

        return $this->view('cliente.promociones.form-nuevo');
    }

    /**
     * @param \App\Http\Requests\Promociones\CreatePromociones $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreatePromociones $request)
    {
        if ($request->ajax() && $request->wantsJson()) {
            $promociones = new Promociones;
            $promociones->preparaDatos($request);

            if ($promociones->save()) {
                $response = [
                    'exito' => TRUE,
                    'titulo' => 'Promocion registrada',
                    'texto' => '¡Felicidades! <b>' . $promociones->nombre . '</b> se ha registrado.',
                    'url' => route('promociones-cliente')
                ];
            }
            else {
                $response = [
                    'exito' => FALSE,
                    'titulo' => 'No se registró',
                    'texto' => 'Parece que no hubo registro en la BD',
                    'url' => NULL
                ];
            }
            return $this->responseJSON($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        if (!is_null($promocion = Promociones::find($id))) {

            $idPropietario = $promocion->idPropietario($this->infoPropietario->id, $id);
            if ($this->infoPropietario->id == $idPropietario[0]['id']) {

                $this->data['param'] = [
                    'route' => 'cliente.promociones.update',
                    'class' => 'form-horizontal form-edita-promocion',
                    'role' => 'form',
                    'autocomplete' => 'off'
                ];

                $categorias = Categorias::where('cliente_id', $promocion->cliente_id)
                    ->get(['id', 'categoria'])
                    ->ToArray();
                $options = [];
                foreach ($categorias as $index => $categoria) {
                    $options[$categoria['id']] = $categoria['categoria'];
                }

                $this->data['promocion'] = $promocion;
                $this->data['categorias'] = $options;
                $this->data['img_promocion'] = $this->_getImage($promocion->cliente_id, 'promociones', $id);
                $this->data['current_promocion_id'] = $id;

                return $this->view('cliente.promociones.perfil.settings');
            }
            else {
                return response('No es tu promocion.', 412);
            }
        }
        else {
            return response('No existe esta promocion.', 412);
        }
    }

    public function showPromocionesCliente($id)
    {
        if (!is_null($cliente = Cliente::find($id))) {
            if($cliente->propietario->id == $this->infoPropietario->id) {
                $categorias = Categorias::where('cliente_id', $cliente->id)->get(['id', 'categoria'])->ToArray();
                $optionsCategorias = [];
                foreach ($categorias as $index => $categoria) {
                    $optionsCategorias[$categoria['id']] = $categoria['categoria'];
                }
                $llaves = array_keys($optionsCategorias);
                $llaves = (empty($llaves)) ? NULL : $llaves;

                $this->data['array_form'] = [
                    'url' => '',
                    'role' => 'form',
                    'id' => 'categoria_id',
                    'autocomplete' => 'off'
                ];
                $this->data['cliente'] = $cliente;
                $this->data['categorias'] = $optionsCategorias;
                $this->data['llaves'] = $llaves;
                return $this->view('cliente.promociones.promociones-cliente');
            }
        }
        else {
            return response('No existe Negocio.', 412);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit()
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreatePromociones $request
     * @return Response
     */
    public function update(CreatePromociones $request)
    {
        if ($request->ajax() && $request->wantsJson()) {

            if (!is_null($promocion = Promociones::find($request->get('id')))) {
                $promocion->preparaDatos($request);

                if ($promocion->save()) {
                    $response = [
                        'exito' => TRUE,
                        'titulo' => 'Promocion actualizado',
                        'texto' => '<b>' . $promocion->nombre . '</b> se ha actualizado.',
                        'url' => route('promociones-cliente')
                    ];
                }
                else {
                    $response = [
                        'exito' => FALSE,
                        'titulo' => 'No se actualizó',
                        'texto' => 'Parece que no hubo cambios en la BD',
                        'url' => NULL
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
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadImage(Request $request)
    {
        if ($request->ajax() && $request->file('img')) {
            $promocion_id = $request->get('promocion_id');
            $cliente_id = $request->get('cliente_id');
            $imagePath = "img/cliente/" . $cliente_id . "/promociones/" . $promocion_id . '/';
            $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
            $temp = explode(".", $_FILES["img"]["name"]);
            $extension = end($temp);

            if (!File::isDirectory($imagePath)) {
                File::makeDirectory($imagePath, 0777, TRUE);
            }
            else {
                File::cleanDirectory($imagePath);
            }

            if (!File::isWritable($imagePath)) {
                $response = Array(
                    "status" => 'error',
                    "message" => 'Can`t upload File; no write Access'
                );

                return new JsonResponse($response);
            }

            if (in_array($extension, $allowedExts)) {
                if ($_FILES["img"]["error"] > 0) {
                    $response = array(
                        "status" => 'error',
                        "message" => 'ERROR Return Code: ' . $_FILES["img"]["error"],
                    );
                }
                else {
                    $filename = $_FILES["img"]["tmp_name"];
                    list($width, $height) = getimagesize($filename);
                    $request->file('img')->move($imagePath, $_FILES["img"]["name"]);
                    $response = array(
                        "status" => 'success',
                        "url" => asset($imagePath . $_FILES["img"]["name"]),
                        "width" => $width,
                        "height" => $height
                    );
                }
            }
            else {
                $response = array(
                    "status" => 'error',
                    "message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
                );
            }

            return new JsonResponse($response);
        }
    }

    public function cropImage(Request $request)
    {
        if ($request->ajax()) {
            $promocion_id = $request->get('promocion_id');
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

            $layer->resizeInPixel($imgW, $imgH, TRUE, 0, 0, 'LT');
            $layer->cropInPixel(500, 500, $imgX1, $imgY1, 'LT');

            unlink("img/cliente/" . $cliente_id . "/promociones/" . $promocion_id . "/" . pathinfo($imgUrl, PATHINFO_BASENAME));

            $dirPath = "img/cliente/" . $cliente_id . "/promociones/" . $promocion_id . '/';
            $filename = strtolower(str_random(15)) . '-' . $promocion_id . '.' . pathinfo($imgUrl, PATHINFO_EXTENSION);
            $createFolders = TRUE;
            $backgroundColor = NULL; // transparent, only for PNG (otherwise it will be white if set null)
            $imageQuality = 100; // useless for GIF, usefull for PNG and JPEG (0 to 100%)

            $layer->save($dirPath, $filename, $createFolders, $backgroundColor, $imageQuality);

            $response = [
                "status" => 'success',
                "url" => asset($dirPath . $filename)
            ];

            return new JsonResponse($response);
        }
    }

    public function datatable(Request $request, $categoria_id = NULL)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $order = $request->get('order');
        $columns = $request->get('columns');
        $search = $request->get('search');

        $byCategoria = is_null($categoria_id);

        $total = ($byCategoria) ? Promociones::count() : Promociones::where('categoria_id', $categoria_id)->count();

        if ($length == -1) {
            $length = NULL;
            $start = NULL;
        }

        $tPromociones = Promociones::getTableName();

        $campos = [
            $tPromociones . '.id',
            $tPromociones . '.nombre',
            $tPromociones . '.siempre',
            $tPromociones . '.disp_inicio',
            $tPromociones . '.disp_fin'
        ];

        $pos_col = $order[0]['column'];
        $order = $order[0]['dir'];
        $campo = $columns[$pos_col]['data'];

        $id_cliente = $request->get('id_cliente');

        $promociones = DB::table($tPromociones)
                ->select($campos)
                ->take($length)
                ->skip($start)
                ->orderBy($campo, $order)->get();
        dd($promociones);

        $proceso = array();
        foreach ($promociones as $index => $promocion) {
            array_push(
                $proceso,
                [
                    'DT_RowId' => $promocion->id,
                    'nombre' => $promocion->nombre,
                    'url' => route('cliente.promociones.show', [$promocion->id])
                ]
            );
        }
        $data = [
            'draw' => $draw,
            'recordsTotal' => count($promociones),
            'recordsFiltered' => $total,
            'data' => $proceso
        ];

        return new JsonResponse($data, 200);
    }

}
