<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Models\Cliente\Cliente;
use App\Http\Models\Cliente\Servicios;
use App\Http\Requests\CreateServicios;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreateServicio;
use App\Http\Controllers\Traits\GetImagesCliente;
use App\Http\Models\Cliente\Categorias;
use App\Http\Models\Cliente\Producto;
use App\Http\Models\Cliente\Propietario;
use App\Http\Requests\CreateProducto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PHPImageWorkshop\ImageWorkshop;
use Symfony\Component\HttpFoundation\JsonResponse;

class ServiciosCliente extends BaseCliente
{
    use GetImagesCliente;

    public function __construct()
    {
        parent::__construct();
        $this->data['activo_servicios'] = TRUE;
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
                $cl_servicios.'.id',
                $cl_clientes.'.id as cliente_id',
                $cl_clientes.'.nombre as nombre_cliente',
                $cl_servicios.'.nombre as nombre_servicio',
                $cl_servicios.'.descripcion_corta',
                DB::raw('COUNT(usr_usuario_gusta_servicio.servicio_id) AS totalLikes')
            )
            ->join($cl_clientes, $cl_servicios.'.cliente_id', '=', $cl_clientes.'.id')
            ->join($cl_propietario, $cl_clientes.'.propietario_id', '=', $cl_propietario.'.id')
            ->join('usr_usuario_gusta_servicio', $cl_servicios.'.id', '=', 'usr_usuario_gusta_servicio.servicio_id')
            ->where($cl_propietario.'.id', '=', $this->infoPropietario->id)
            ->groupBy($cl_servicios.'.nombre')
            ->orderBy('totalLikes', 'DESC')
            ->take(10)
            ->get();

        foreach($servicios as $servicio) {
            $servicio->imagen = $this->_getImage($servicio->cliente_id, 'servicios', $servicio->id);
        }
        $this->data['serviciosMasGustados'] = $servicios;

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
        $clientes = Cliente::where('propietario_id', $this->infoPropietario->id)->get(['id',  'nombre'])->ToArray();
        $options = [];
        foreach ($clientes as $index => $cliente) {
            $options[$cliente['id']] = $cliente['nombre'];
        }
        $this->data['negocios'] = $options;

        return $this->view('cliente.servicios.form-nuevo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateServicio $request
     * @return \App\Http\Controllers\Cliente\Response
     */
    public function store(CreateServicio  $request)
    {
       if($request->ajax() && $request->wantsJson()){
            $servicio = new Servicios;;
            $servicio->preparaDatos($request);

            if ($servicio->save()) {
                $response = [
                    'exito'  => TRUE,
                    'titulo' => 'Servicio registrado',
                    'texto'  =>'¡Felicidades! <b>' . $servicio->nombre . '</b> se ha registrado.',
                    'url'    => route('servicios-cliente')
                ];
            }
            else {
                $response = [
                    'exito'  => FALSE,
                    'titulo' =>  'No se registró',
                    'texto'  =>'Parece que no hubo registro en la BD',
                    'url'    => NULL
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
        if(!is_null($servicio = Servicios::find($id))) {

            $idPropietario = $servicio->idPropietario($this->infoPropietario->id, $id);

            if($this->infoPropietario->id == $idPropietario[0]['id']) {

                $this->data['param'] = [
                    'route'        => 'cliente.servicios.update',
                    'class'        => 'form-horizontal form-edita-servicio',
                    'role'         => 'form',
                    'autocomplete' => 'off'
                ];

                $categorias = Categorias::where('cliente_id', $servicio->cliente_id)->get(['id', 'categoria'])->ToArray();
                $options  = [];
                foreach ($categorias as $index => $categoria) {
                    $options[$categoria['id']] = $categoria['categoria'];
                }


                $this->data['servicio'] = $servicio;
                $this->data['categorias'] = $options;
                $this->data['img_servicio'] = $this->_getImage($servicio->cliente_id, 'servicios',$id);
                $this->data['current_servicio_id'] = $id;

                return $this->view('cliente.servicios.perfil.settings');
            }
            else {
                return response('No es tu servicio.', 412);
            }
        }
        else {
            return response('No existe servicio.', 412);
        }
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
    public function update(CreateServicio $request)
    {
        dd($request);
        if($request->ajax() && $request->wantsJson()){

            if(!is_null($servicio = Servicios::find($request->get('id')))) {
                $servicio->preparaDatos($request);

                if ($servicio->save()) {
                    $response = [
                        'exito'  => TRUE,
                        'titulo' => 'servicio actualizado',
                        'texto'  =>'<b>' . $servicio->nombre . '</b> se ha actualizado.',
                        'url' => route('servicios-cliente')
                    ];
                }
                else {
                    $response = [
                        'exito'  => FALSE,
                        'titulo' =>  'No se actualizó',
                        'texto'  =>'Parece que no hubo cambios en la BD',
                        'url'    => NULL
                    ];
                }
                return $this->responseJSON($response);

            }
        }
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

    public function uploadImage (Request $request)
    {
        if ($request->ajax() && $request->file('img')) {
            $servicio_id  = $request->get('servicio_id');
            $cliente_id  = $request->get('cliente_id');
            $imagePath   = "img/cliente/" . $cliente_id . "/servicios/".$servicio_id.'/';
            $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
            $temp        = explode(".", $_FILES["img"]["name"]);
            $extension   = end($temp);

            if (!File::isDirectory($imagePath)) {
                File::makeDirectory($imagePath, 0777, TRUE);
            }
            else {
                File::cleanDirectory($imagePath);
            }

            if (!File::isWritable($imagePath)) {
                $response = Array(
                    "status"  => 'error',
                    "message" => 'Can`t upload File; no write Access'
                );

                return new JsonResponse($response);
            }

            if (in_array($extension, $allowedExts)) {
                if ($_FILES["img"]["error"] > 0) {
                    $response = array(
                        "status"  => 'error',
                        "message" => 'ERROR Return Code: ' . $_FILES["img"]["error"],
                    );
                }
                else {
                    $filename = $_FILES["img"]["tmp_name"];
                    list($width, $height) = getimagesize($filename);
                    $request->file('img')->move($imagePath, $_FILES["img"]["name"]);
                    $response = array(
                        "status" => 'success',
                        "url"    => asset($imagePath . $_FILES["img"]["name"]),
                        "width"  => $width,
                        "height" => $height
                    );
                }
            }
            else {
                $response = array(
                    "status"  => 'error',
                    "message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
                );
            }

            return new JsonResponse($response);
        }
    }

    public function cropImage (Request $request)
    {
        if ($request->ajax()) {
            $servicio_id = $request->get('servicio_id');
            $cliente_id = $request->get('cliente_id');
            $imgUrl     = $request->get('imgUrl');
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

            unlink("img/cliente/" . $cliente_id . "/servicios/".$servicio_id."/" . pathinfo($imgUrl, PATHINFO_BASENAME));

            $dirPath         = "img/cliente/" . $cliente_id . "/servicios/".$servicio_id.'/';
            $filename = strtolower(str_random(15)) . '-' . $servicio_id . '.' . pathinfo($imgUrl, PATHINFO_EXTENSION);
            $createFolders   = TRUE;
            $backgroundColor = NULL; // transparent, only for PNG (otherwise it will be white if set null)
            $imageQuality    = 100; // useless for GIF, usefull for PNG and JPEG (0 to 100%)

            $layer->save($dirPath, $filename, $createFolders, $backgroundColor, $imageQuality);

            $response = [
                "status" => 'success',
                "url"    => asset($dirPath . $filename)
            ];

            return new JsonResponse($response);
        }
    }

    public function getServiciosJson ($id)
    {
        $categoria = new Categorias;
        $categorias = $categoria->where('cliente_id', $id)->get();

        $final = [];
        foreach($categorias as $categoria) {
            $servicios = $categoria->servicios->toArray();

            $arrayservicios = [];
            foreach ($servicios as $key => $servicio) {
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
