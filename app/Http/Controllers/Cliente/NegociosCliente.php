<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Models\Admin\Categorias;
use App\Http\Models\Admin\Ciudades;
use App\Http\Models\Cliente\Cliente;
use App\Http\Models\Cliente\Propietario;
use App\Http\Requests;
use App\Http\Requests\CreateCliente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PHPImageWorkshop\ImageWorkshop;

class NegociosCliente extends BaseCliente
{

    var $logoDefault = 'assets/admin/pages/media/profile/profile_user.jpg';

    public function __construct()
    {
        parent::__construct();
        $this->data['activo_negocio'] = TRUE;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->data['activo_negocio_index'] = TRUE;
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
            'route' => 'cliente.negocio.store',
            'class' => 'form-horizontal form-nuevo-cliente',
            'role' => 'form',
            'autocomplete' => 'off'
        ];

        $ciudades = Ciudades::get()->ToArray();
        $options = [];
        foreach ($ciudades as $index => $ciudad) {
            $options[$ciudad['id']] = $ciudad['ciudad'] . ', ' . $ciudad['estado'];
        }

        $categorias = Categorias::all(['id', 'categoria'])->ToArray();
        $options_categorias = ['' => ''];
        foreach($categorias as $categoria){
            $options_categorias[$categoria['id']] = $categoria['categoria'];
        }

        $this->data['options_categorias'] = $options_categorias;

        $this->data['options_ciudades'] = $options;
        $this->data['activo_negocio_nuevo'] = TRUE;

        return $this->view('cliente.negocios.form-nuevo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCliente $request
     * @return Response
     */
    public function store(CreateCliente $request)
    {
        if ($request->ajax() && $request->wantsJson()) {
            $cliente = new Cliente;
            $cliente->preparaDatos($request);

            if ($cliente->save()) {

                $subIDs = [];
                for ($i = 0; $i < 3; $i++) {
                    $var = $request->get("subcategoria".($i+1));
                    if(isset($var) && !empty($var)) {
                        array_push($subIDs, $var);
                    }
                }

                $cliente->subcategorias()->sync($subIDs);

                $response = [
                    'exito'  => TRUE,
                    'titulo' => 'Cliente registrado',
                    'texto'  =>'¡Felicidades! <b>' . $cliente->nombre . '</b> se ha registrado.',
                    'url'    => route('negocios-cliente')
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
     * @param \Illuminate\Http\Request $request
     * @param  int                     $id
     * @param                          $accion
     *
     * @return \App\Http\Controllers\Cliente\Response
     */
    public function show(Request $request, $id, $accion = NULL)
    {
        $cliente = Cliente::find($id);
        $propietario = $cliente->propietario;
        if($this->infoPropietario->id == $propietario->id) {

            $this->data['logo'] = $this->_getLogo($id);
            $this->data['categoria'] = $cliente->subcategorias->first()->subcategoria;
            $this->data['cliente'] = $cliente;
            $this->data['current_cliente_id'] = $id;

            switch($accion) {
                case NULL:
                    return $this->view('cliente.negocios.perfil.index');
                    break;
                case 'settings':
                    return $this->view('cliente.negocios.perfil.settings');
                    break;
            }

        } else {
            return response('No autorizado', 401);
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
    public function update(Request $request, $id)
    {
        //
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

    public function uploadImage(Request $request)
    {
        if ($request->ajax() && $request->file('img')) {
            $cliente_id  = $request->get('cliente_id');
            $imagePath   = "img/cliente/" . $cliente_id . "/logo/";
            $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
            $temp        = explode(".", $_FILES["img"]["name"]);
            $extension   = end($temp);

            if (!File::isDirectory($imagePath)) {
                File::makeDirectory($imagePath, 0777, TRUE);
            } else {
                File::cleanDirectory($imagePath);
            }

            if(!File::isWritable($imagePath)){
                $response = Array(
                    "status" 	=> 'error',
                    "message"	=> 'Can`t upload File; no write Access'
                );
                return new JsonResponse($response);
            }

            if (in_array($extension, $allowedExts))
            {
                if ($_FILES["img"]["error"] > 0) {
                    $response = array(
                        "status" 	=> 'error',
                        "message" 	=> 'ERROR Return Code: '. $_FILES["img"]["error"],
                    );
                } else {
                    $filename 	= $_FILES["img"]["tmp_name"];
                    list($width, $height) 	= getimagesize($filename);
                    $request->file('img')->move($imagePath, $_FILES["img"]["name"]);
                    $response = array(
                        "status" 	=> 'success',
                        "url" 	=> asset($imagePath.$_FILES["img"]["name"]),
                        "width" 	=> $width,
                        "height" 	=> $height
                    );
                }
            } else {
                $response = array(
                    "status" 	=> 'error',
                    "message" 	=> 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
                );
            }
            return new JsonResponse($response);
        }
    }

    public function cropImage(Request $request)
    {
        if ($request->ajax()) {
            $cliente_id 	= $request->get('cliente_id');
            $imgUrl	= $request->get('imgUrl');
            // original sizes
            $imgInitW	= $request->get('imgInitW');
            $imgInitH	= $request->get('imgInitH');
            // resized sizes
            $imgW		=$request->get('imgW');
            $imgH		= $request->get('imgH');
            // offsets
            $imgX1		= $request->get('imgX1');
            $imgY1		= $request->get('imgY1');
            // crop box
            $cropW	= $request->get('cropW');
            $cropH		= $request->get('cropH');
            // rotation angle
            $angle		= $request->get('rotation');

            $quality = 100;

            $output_filename = "img/cliente/".$cliente_id."/logo/logo_".pathinfo($imgUrl, PATHINFO_FILENAME);

            $layer = ImageWorkshop::initFromPath($imgUrl);

            $positionX = 0; // px
            $positionY = 0; // px
            $position = 'LT';

            $layer->resizeInPixel($imgW, $imgH, TRUE, 0, 0, $position);

            $newWidth = 120; // px
            $newHeight = 100; // px
            $positionX = 30; // left translation of 30px
            $positionY = 20; // top translation of 20px
            $position = "LT";

            $layer->cropInPixel($cropW, $cropH, $imgX1, $imgY1, $position);


            unlink("img/cliente/".$cliente_id."/logo/".pathinfo($imgUrl, PATHINFO_BASENAME));

            $dirPath = "img/cliente/".$cliente_id."/logo/";
            $filename = strtolower(str_random(15)).'.'.pathinfo($imgUrl, PATHINFO_EXTENSION);
            $createFolders = TRUE;
            $backgroundColor = NULL; // transparent, only for PNG (otherwise it will be white if set null)
            $imageQuality = 100; // useless for GIF, usefull for PNG and JPEG (0 to 100%)

            $layer->save($dirPath, $filename, $createFolders, $backgroundColor, $imageQuality);

            $response = [
                "status" => 'success',
                "url" => asset($dirPath . $filename)
            ];


            // uncomment line below to save the cropped image in the same location as the original image.
            // $output_filename = dirname($imgUrl). "/thumb_".rand();

            //$what = getimagesize($imgUrl);

            //switch(strtolower($what['mime']))
            //{
            //    case 'image/png':
            //        $img_r = imagecreatefrompng($imgUrl);
            //        $source_image = imagecreatefrompng($imgUrl);
            //        $type = '.png';
            //        break;
            //    case 'image/jpeg':
            //        $img_r = imagecreatefromjpeg($imgUrl);
            //        $source_image = imagecreatefromjpeg($imgUrl);
            //        error_log("jpg");
            //        $type = '.jpeg';
            //        break;
            //    case 'image/gif':
            //        $img_r = imagecreatefromgif($imgUrl);
            //        $source_image = imagecreatefromgif($imgUrl);
            //        $type = '.gif';
            //        break;
            //    default: die('image type not supported');
            //}

            //Check write Access to Directory
            //if(!is_writable(dirname($output_filename))) {
            //    $response = Array(
            //        "status" 	=> 'error',
            //        "message" 	=> 'Can`t write cropped File'
            //    );
            //}
            //else{
            //    // resize the original image to size of editor
            //    $resizedImage = imagecreatetruecolor($imgW, $imgH);
            //    imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
            //    // rotate the rezized image
            //    $rotated_image = imagerotate($resizedImage, -$angle, 0);
            //    // find new width & height of rotated image
            //    $rotated_width 	= imagesx($rotated_image);
            //    $rotated_height 	= imagesy($rotated_image);
            //    // diff between rotated & original sizes
            //    $dx = $rotated_width - $imgW;
            //    $dy = $rotated_height - $imgH;
            //    // crop rotated image to fit into original rezized rectangle
            //    $cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
            //    imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
            //    imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
            //    // crop image into selected area
            //    $final_image = imagecreatetruecolor($cropW, $cropH);
            //    imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
            //    imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
            //    // finally output png image
            //    $mime = strtolower($what['mime']);
            //    if($mime == 'image/png') {
            //        imagepng($final_image, $output_filename.$type, 0);
            //    } else if($mime == 'image/jpeg'){
            //        imagejpeg($final_image, $output_filename.$type, $quality);
            //    }
            //    $response = Array(
            //        "status" 	=> 'success',
            //        "url" 	=> asset($output_filename.$type)
            //    );
            //}

            return new JsonResponse($response);
        }
    }

    private function  _getLogo($id)
    {
        $files = File::files('img/cliente/'.$id.'/logo');
        $count = count($files);
        if($count > 1 || $count == 0){
            if($count > 1) {
                foreach($files as $file){
                    unlink($file);
                }
            }
            return asset($this->logoDefault);
        }
        else if($count == 1){
            list($width, $height) = getimagesize($files[0]);
            if($width != 500 || $height != 500) {
                unlink($files[0]);
                return asset($this->logoDefault);
            }
            else if($width == 500 && $height == 500) {
                return asset($files[0]);
            }
        }
    }
}
