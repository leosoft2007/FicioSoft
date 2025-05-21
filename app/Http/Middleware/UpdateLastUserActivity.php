<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateLastUserActivity
{
    /**
     * estaa funcion se encarga de actualizar el campo last_seen
     * de la tabla users, cada vez que el usuario realiza una peticion
     * a la aplicacion, esto se utiliza para saber si el usuario
     * ha estado activo en la aplicacion en los ultimos 30 minutos
     * y mostrar su estado en la vista de usuarios
     *
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Verifica si el usuario está autenticado
        // y actualiza el campo last_seen
        // con la fecha y hora actual
        // si el usuario no esta autenticado

        if (Auth::check()) {
            $user = Auth::user();
            $user->last_seen = now();
            $user->save();

        }

        return $next($request);
    }
}
