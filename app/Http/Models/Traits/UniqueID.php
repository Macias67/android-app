<?php
/**
 * Created by PhpStorm.
 * User: Luis Macias
 * Date: 10/09/2015
 * Time: 03:43 PM
 */

namespace App\Http\Models\Traits;


trait UniqueID
{
    public function getUniqueID($length = 16)
    {
        $hashid = new Hashids(md5('android.app'), $length);
        return $hashid->encode(time());
    }
}