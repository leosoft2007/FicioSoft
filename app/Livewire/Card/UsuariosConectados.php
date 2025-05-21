<?php

namespace App\Livewire\Card;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Carbon;


class UsuariosConectados extends Component
{


    public int $pollingInterval = 5000; // 5 segundos

    public function render()
    {
        // Usuarios activos en los últimos 2 minutos
        $usuarios = User::whereDate('last_seen', Carbon::today())->orderByDesc('last_seen')->get();
        $usuariosConectados = User::where('last_seen', '>=', now()->subMinute())->count();

        return view('livewire.card.usuarios-conectados', [
            'usuarios' => $usuarios,
            'usuariosConectados' => $usuariosConectados,
        ]);
    }
    public function getUsuariosProperty()
    {

        return $this->usuarios->filter(function ($user) {
            return $user->last_seen && Carbon::parse($user->last_seen)->gt(now()->subMinutes(1));
        });
    }
}
