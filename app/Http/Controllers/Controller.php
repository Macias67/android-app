<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

/**
 * Controlador abstracto
 *
 * @author  Luis Macias
 * @package App\Http\Controllers
 */
abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;
    /**
     * Array para guardar toda la información
     * que se va a mostrar a las vistas.
     *
     * @var array
     */
    protected $data = [];

    /**
     * @param $vista
     *
     * @return \Illuminate\Http\Response
     */
    protected function view($vista)
    {
        $contents = View::make($vista, $this->data);
        $response = Response::make($contents, 200);
        $response->header('Expires', 'Tue, 1 Jan 1980 00:00:00 GMT');
        $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $response->header('Pragma', 'no-cache');

        return $response;
    }

    /**
     * @param $exito
     * @param $titulo
     * @param $texto
     * @param $url
     * @param null $errores
     * @param int $status
     * @return mixed
     * @internal param $mensaje
     */
    protected function responseJSON($exito, $titulo, $texto, $url, $errores = NULL, $status = 200)
    {
        $data =
            [
                'exito' => $exito,
                'titulo' => $titulo,
                'texto' => $texto,
                'url' => $url
            ];
        if (!is_null($errores)) {
            $data['errores'] = $errores;
        }

        return new JsonResponse($data, $status);
    }
}
