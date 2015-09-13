<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Traits\GetImagesCliente;
use App\Http\Models\Cliente\Cliente;
use App\Http\Models\Cliente\Evento;
use App\Http\Models\Cliente\Propietario;
use App\Http\Requests;
use App\Http\Requests\Eventos\CreateEvento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PHPImageWorkshop\ImageWorkshop;
use Symfony\Component\HttpFoundation\JsonResponse;

class EventosCliente extends BaseCliente
{
    use GetImagesCliente;

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $cl_eventos = Evento::getTableName();
        $cl_clientes = Cliente::getTableName();
        $cl_propietario = Propietario::getTableName();

        $eventos = DB::table($cl_eventos)
                     ->select(
                         $cl_eventos . '.id',
                         $cl_clientes . '.id as cliente_id',
                         $cl_clientes . '.nombre as nombre_cliente',
                         $cl_eventos . '.nombre as nombre_evento',
                         $cl_eventos . '.descripcion'
                     )
                     ->join($cl_clientes, $cl_eventos . '.cliente_id', '=', $cl_clientes . '.id')
                     ->join($cl_propietario, $cl_clientes . '.propietario_id', '=', $cl_propietario . '.id')
                     ->where($cl_propietario . '.id', '=', $this->infoPropietario->id)
                     ->groupBy($cl_eventos . '.nombre')
                     ->take(10)
                     ->get();

        foreach ($eventos as $evento) {
            $evento->imagen = $this->_getImage($evento->cliente_id, 'eventos', $evento->id);
        }
        $this->data['eventosMasGustados'] = $eventos;

        return $this->view('cliente.eventos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $this->data['param'] = [
            'route' => 'cliente.evento.store',
            'class' => 'form-horizontal form-nuevo-evento',
            'role' => 'form',
            'autocomplete' => 'off'
        ];
        $clientes = Cliente::where('propietario_id', $this->infoPropietario->id)->get(['id', 'nombre'])->ToArray();
        $options = [];
        foreach ($clientes as $index => $cliente) {
            $options[$cliente['id']] = $cliente['nombre'];
        }
        $this->data['negocios'] = $options;
        return $this->view('cliente.eventos.form-nuevo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Eventos\CreateEvento $request
     * @return \App\Http\Controllers\Cliente\Response $response
     */
    public function store(CreateEvento $request)
    {
        if ($request->ajax() && $request->wantsJson()) {
            $evento = new Evento;
            $evento->preparaDatos($request);

            if ($evento->save()) {
                $response = [
                    'exito' => TRUE,
                    'titulo' => 'Evento registrado',
                    'texto' => '¡Felicidades! <b>' . $evento->nombre . '</b> se ha registrado.',
                    'url' => route('eventos-cliente')
                ];
            }
            else {
                $response = [
                    'exito' => FALSE,
                    'titulo' => 'No se registró el evento',
                    'texto' => 'Parece que no hubo registro en la base de datos.',
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
        if (!is_null($evento = Evento::find($id))) {
            $idPropietario = $evento->idPropietario($this->infoPropietario->id, $id);

            if ($this->infoPropietario->id == $idPropietario[0]['id']) {
                $fechaInicio = $evento->fecha_inicio . ' ' . $evento->hora_inicio;
                $fechaFin = $evento->fecha_termina . ' ' . $evento->hora_termina;

                $this->data['param'] = [
                    'route' => 'cliente.evento.update',
                    'class' => 'form-horizontal form-edita-evento',
                    'role' => 'form',
                    'autocomplete' => 'off'
                ];

                $this->data['evento'] = $evento;
                $this->data['disp_fin'] = $fechaFin;
                $this->data['disp_inicio'] = $fechaInicio;
                $this->data['current_evento_id'] = $id;
                $this->data['img_evento'] = $this->_getImage($evento->cliente_id, 'eventos', $id);

                return $this->view('cliente.eventos.perfil.settings');
            }
            else {
                return response('No es tu evento.', 412);
            }
        }
        else {
            return response('No existe evento.', 412);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateEvento $request
     * @return Response
     */
    public function update(CreateEvento $request)
    {
        if ($request->ajax() && $request->wantsJson()) {
            if (!is_null($evento = Evento::find($request->get('id')))) {
                $evento->preparaDatos($request);

                if ($evento->save()) {
                    $response = [
                        'exito' => TRUE,
                        'titulo' => 'Evento actualizado',
                        'texto' => '<b>' . $evento->nombre . '</b> se ha actualizado.',
                        'url' => route('eventos-cliente')
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
            $evento_id = $request->get('evento_id');
            $cliente_id = $request->get('cliente_id');
            $imagePath = "img/cliente/" . $cliente_id . "/eventos/" . $evento_id . '/';
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
            $evento_id = $request->get('evento_id');
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

            unlink("img/cliente/" . $cliente_id . "/eventos/" . $evento_id . "/" . pathinfo($imgUrl, PATHINFO_BASENAME));

            $dirPath = "img/cliente/" . $cliente_id . "/eventos/" . $evento_id . '/';
            $filename = strtolower(str_random(15)) . '-' . $evento_id . '.' . pathinfo($imgUrl, PATHINFO_EXTENSION);
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
}
