<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthCliente
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
        if (Auth::cliente()->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            }
            else {
                return redirect()->guest(route('login-cliente'));
            }
        }

        return $next($request);
    }
}
