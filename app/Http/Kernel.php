<?php

namespace App\Http;

use App\Http\Middleware\Auth\AuthAdmin;
use App\Http\Middleware\Auth\AuthCliente;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class Kernel extends HttpKernel
{
	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware
		= [
			CheckForMaintenanceMode::class,
			EncryptCookies::class,
			AddQueuedCookiesToResponse::class,
			StartSession::class,
			ShareErrorsFromSession::class,
			VerifyCsrfToken::class,
		];
	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware
		= [
			'auth.admin'   => AuthAdmin::class,
			'auth.cliente' => AuthCliente::class,
			'guest'        => Middleware\RedirectIfAuthenticated::class,
		];
}
