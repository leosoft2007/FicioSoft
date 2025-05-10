<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Permission\Exceptions\UnauthorizedException;

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
