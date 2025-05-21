<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Permission\Exceptions\UnauthorizedException;

// esta clase se encarga de verificar si el usuario tiene el permiso de acceder al sistema
// si no lo tiene, se cierra la sesión y se lanza una excepción de autorización
// el evento se dispara después de que el usuario inicia sesión
// el evento Login se dispara después de que el usuario inicia sesión

class CheckUserPermissionAfterLogin
{
    public function handle(Login $event)
    {
        $user = $event->user;

        if (! $user->can('acceder al sistema')) {
            Auth::logout();

            throw UnauthorizedException::forPermissions(['acceder al sistema']);
        }
    }
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */

}
