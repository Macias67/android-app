<?php
/**
 * Created by PhpStorm.
 * User: Julio
 * Date: 29/08/2015
 * Time: 13:19
 */

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\File;


trait GetImagesCliente
{
    private function  _getImageProducto ($cliente_id, $funcion, $id)
    {
        $files = File::files('img/cliente/' . $cliente_id . '/'. $funcion .'/'.$id);
        $logoDefault = asset('assets/admin/pages/media/productos/'.$funcion.'.jpg');
        $count = count($files);
        if ($count > 1 || $count == 0) {
            if ($count > 1) {
                foreach ($files as $file) {
                    unlink($file);
                }
            }

            return asset($logoDefault);
        }
        else if ($count == 1) {
            list($width, $height) = getimagesize($files[0]);
            if ($width != 500 || $height != 500) {
                unlink($files[0]);

                return asset($logoDefault);
            }
            else if ($width == 500 && $height == 500) {
                return asset($files[0]);
            }
        }
    }

    private function  _getImagePromociones ($cliente_id, $funcion, $id)
    {
        $files = File::files('img/cliente/' . $cliente_id . '/'. $funcion .'/'.$id);
        $logoDefault = asset('assets/admin/pages/media/promociones/'.$funcion.'.jpg');
        $count = count($files);
        if ($count > 1 || $count == 0) {
            if ($count > 1) {
                foreach ($files as $file) {
                    unlink($file);
                }
            }

            return asset($logoDefault);
        }
        else if ($count == 1) {
            list($width, $height) = getimagesize($files[0]);
            if ($width != 500 || $height != 500) {
                unlink($files[0]);

                return asset($logoDefault);
            }
            else if ($width == 500 && $height == 500) {
                return asset($files[0]);
            }
        }
    }

}