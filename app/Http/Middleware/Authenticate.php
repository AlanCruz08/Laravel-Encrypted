<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
        // Permitir acceso a las rutas de verificación de código sin autenticación
        if (! $request->expectsJson() && !in_array($request->route()->getName(), ['verify.code.form.login', 'verify.code.login'])) {
            return route('login');
        }
    }
}
