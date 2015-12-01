<?php
/**
 * Created by PhpStorm.
 * User: Luis Macias
 * Date: 10/09/2015
 * Time: 03:43 PM
 */

namespace App\Http\Models\Traits;

use Hashids\Hashids;

trait UniqueID
{
	public function getUniqueID($length = 16)
	{
		$hashid = new Hashids(time(), $length);

		return $hashid->encode(rand(0, 1000));
	}
}