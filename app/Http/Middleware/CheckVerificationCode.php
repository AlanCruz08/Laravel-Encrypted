<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckVerificationCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Si el usuario está autenticado y no está verificado
        if (auth()->check() && auth()->user()->is_verified == 0) {
            return $next($request);
        }

        // Si el usuario está verificado o no está autenticado, redirige a la página principal
        return redirect()->route('home');
    }
}
