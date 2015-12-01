<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class BaseAdmin extends Controller
{
	protected $infoAdmin;

	public function __construct()
	{
		$this->infoAdmin = Auth::admin()->user();
		$this->data['user'] = $this->infoAdmin;
	}
}
