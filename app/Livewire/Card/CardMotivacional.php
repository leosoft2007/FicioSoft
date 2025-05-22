<?php

namespace App\Livewire\Card;

use Livewire\Component;

class CardMotivacional extends Component
{
    public $frase;


    public function mount()
    {
        $frases = [
            '¡Hoy es un gran día para lograr tus metas!',
            'Cree en ti y todo será posible.',
            'Cada pequeño paso cuenta.',
            '¡Sigue adelante, lo estás haciendo genial!',
            'La actitud positiva es el primer paso al éxito.',
        ];

        try {
            $response = \Illuminate\Support\Facades\Http::get('https://frasedeldia.azurewebsites.net/api/phrase');
            $data = $response->json();
            // La API devuelve: { "phrase": "..." }
            $fraseEs = $data['phrase'] ?? null;

            if ($fraseEs && strlen($fraseEs) > 5) {
                $this->frase = $fraseEs;
            } else {
                $this->frase = $frases[array_rand($frases)];
            }
        } catch (\Exception $e) {
            $this->frase = $frases[array_rand($frases)];
        }
    }
    public function render()
    {
        return view('livewire.card.card-motivacional');
    }
}
