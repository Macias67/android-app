<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Models\Admin\Categorias;
use App\Http\Models\Admin\Ciudades;
use App\Http\Models\Cliente\Cliente;
use App\Http\Requests;
use App\Http\Requests\Cliente\EditCliente;
use App\Http\Requests\CreateCliente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PHPImageWorkshop\ImageWorkshop;

class NegociosCliente extends BaseCliente
{
    var $logoDefault = 'assets/admin/pages/media/profile/profile_user.jpg';

    public function __construct ()
    {
        parent::__construct();
        $this->data['activo_negocio'] = TRUE;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index ()
    {
        $this->data['activo_negocio_index'] = TRUE;
        return $this->view('cliente.negocios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create ()
    {
        $this->data['param'] = [
            'route'        => 'cliente.negocio.store',
            'class'        => 'form-horizontal form-nuevo-cliente',
            'role'         => 'form',
            'autocomplete' => 'off'
        ];

        $ciudades = Ciudades::get()->ToArray();
        $options  = [];
        foreach ($ciudades as $index => $ciudad) {
            $options[$ciudad['id']] = $ciudad['ciudad'] . ', ' . $ciudad['estado'];
        }

        $categorias         = Categorias::all(['id', 'categoria'])->ToArray();
        $options_categorias = ['' => ''];
        foreach ($categorias as $categoria) {
            $options_categorias[$categoria['id']] = $categoria['categoria'];
        }

        $this->data['options_categorias'] = $options_categorias;

        $this->data['options_ciudades']     = $options;
        $this->data['activo_negocio_nuevo'] = TRUE;

        return $this->view('cliente.negocios.form-nuevo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCliente $request
     *
     * @return Response
     */
    public function store (CreateCliente $request)
    {
        if ($request->ajax() && $request->wantsJson()) {
            $cliente = new Cliente;
            $cliente->preparaDatos($request);

            if ($cliente->save()) {

                $subIDs = [];
                for ($i = 0; $i < 3; $i++) {
                    $var = $request->get("subcategoria" . ($i + 1));
                    if (isset($var) && !empty($var)) {
                        array_push($subIDs, $var);
                    }
                }

                $cliente->subcategorias()->sync($subIDs);

                $response = [
                    'exito'  => TRUE,
                    'titulo' => 'Cliente registrado',
                    'texto'  => '¡Felicidades! <b>' . $cliente->nombre . '</b> se ha registrado.',
                    'url'    => route('negocios-cliente')
                ];
            }
            else {
                $response = [
                    'exito'  => FALSE,
                    'titulo' => 'No se registró',
                    'texto'  => 'Parece que no hubo registro en la BD',
                    'url'    => NULL
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
    public function show (Request $request, $id, $accion = NULL)
    {
        if(!is_null($cliente     = Cliente::find($id))) {

            if ($this->infoPropietario->id == $cliente->propietario->id) {

                $this->data['param'] = [
                    'route'        => 'cliente.negocio.update',
                    'class'        => 'form-horizontal form-nuevo-cliente',
                    'role'         => 'form',
                    'autocomplete' => 'off'
                ];

                $ciudades = Ciudades::get()->ToArray();
                $options  = [];
                foreach ($ciudades as $index => $ciudad) {
                    $options[$ciudad['id']] = $ciudad['ciudad'] . ', ' . $ciudad['estado'];
                }

                $categorias         = Categorias::all(['id', 'categoria'])->ToArray();
                $options_categorias = ['' => ''];
                foreach ($categorias as $categoria) {
                    $options_categorias[$categoria['id']] = $categoria['categoria'];
                }

                for($i = 0; $i < 3; $i++) {
                    if(array_key_exists($i, $cliente->subcategorias->toArray())) {
                        $cl_categorias[$i]['categoria'] = $cliente->subcategorias[$i]->categoria->id;
                        $cl_categorias[$i]['subcategoria'] = $cliente->subcategorias[$i]->id;
                    } else {
                        $cl_categorias[$i]['categoria'] = NULL;
                        $cl_categorias[$i]['subcategoria'] = NULL;
                    }
                }

                $this->data['options_categorias'] = $options_categorias;

                $this->data['logo']               = $this->_getLogo($id);
                $this->data['options_ciudades']     = $options;
                $this->data['categoria']        = $cliente->subcategorias->first()->subcategoria;
                $this->data['cl_categorias'] = $cl_categorias;
                $this->data['cliente']            = $cliente;
                $this->data['current_cliente_id'] = $id;

                switch ($accion) {
                    case NULL:
                        return $this->view('cliente.negocios.perfil.index');
                        break;
                    case 'settings':
                        return $this->view('cliente.negocios.perfil.settings');
                        break;
                }

            }
            else {
                return response('No autorizado', 401);
            }
        } else {
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
    public function edit ($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Cliente\EditCliente $request
     *
     * @return \App\Http\Controllers\Cliente\Response
     */
    public function update (EditCliente $request)
    {
        if ($request->ajax() && $request->wantsJson()) {
            if(!is_null($cliente = Cliente::find($request->get('id')))) {
                if ($this->infoPropietario->id == $cliente->propietario->id) {
                    $cliente->preparaDatos($request);
                    if ($cliente->save()) {
                        $response = [
                            'exito'  => TRUE,
                            'titulo' => 'Cliente actualizado',
                            'texto'  =>'<b>' . $cliente->nombre . '</b> se ha actualizado.',
                            'url' => route('negocios-cliente')
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
                else {
                    return response('No autorizado', 401);
                }
            }
            else {
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
    public function destroy ($id)
    {
        //
    }

    public function uploadImage (Request $request)
    {
        if ($request->ajax() && $request->file('img')) {
            $cliente_id  = $request->get('cliente_id');
            $imagePath   = "img/cliente/" . $cliente_id . "/logo/";
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

            unlink("img/cliente/" . $cliente_id . "/logo/" . pathinfo($imgUrl, PATHINFO_BASENAME));

            $dirPath         = "img/cliente/" . $cliente_id . "/logo/";
            $filename        = strtolower(str_random(15)) . '.' . pathinfo($imgUrl, PATHINFO_EXTENSION);
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

    private function  _getLogo ($id)
    {
        $files = File::files('img/cliente/' . $id . '/logo');
        $count = count($files);
        if ($count > 1 || $count == 0) {
            if ($count > 1) {
                foreach ($files as $file) {
                    unlink($file);
                }
            }

            return asset($this->logoDefault);
        }
        else if ($count == 1) {
            list($width, $height) = getimagesize($files[0]);
            if ($width != 500 || $height != 500) {
                unlink($files[0]);

                return asset($this->logoDefault);
            }
            else if ($width == 500 && $height == 500) {
                return asset($files[0]);
            }
        }
    }
}
