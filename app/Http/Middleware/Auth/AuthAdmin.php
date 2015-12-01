<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Middleware para revisión de autentificación
 * de un administrador en la aplicación.
 *
 * @author  Luis Macias
 * @package App\Http\Middleware\Auth
 */
class AuthAdmin
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 *
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (Auth::admin()->guest())
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return redirect()->guest(route('login.admin'));
			}
		}

		return $next($request);
	}
}
