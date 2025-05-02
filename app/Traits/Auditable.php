<?php

namespace App\Traits;
use App\Models\Audit;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Request;

trait Auditable
{

    public function audits(): MorphMany
        {
            return $this->morphMany(Audit::class, 'auditable');
        }
        
        protected static function booted()
    {
        static::created(function ($registro) {
            $registro->audits()->create([
                'event' => 'created',
                'user_id' => auth()->id(),
                'url' => Request::fullUrl(), // URL actual
                'ip_address' => Request::ip(),   // Dirección IP del cliente
                'user_type' => auth()->check() ? auth()->user()->getMorphClass() : null, // Nombre de la clase del usuario autenticado actualmente
                // otros campos de auditoría...
            ]);
        });
    
        static::updating(function ($registro) {
            foreach ($registro->getOriginal() as $key => $value) {
                if ($registro->hasCast($key)) {
                    $original[$key] = $registro->castAttribute($key, $value);
                } else {
                    $original[$key] = $value;
                }
            }
            $registro->audits()->create([
                'event' => 'updated',
                'user_id' => auth()->id(),
                'url' => Request::fullUrl(), // URL actual
                'ip_address' => Request::ip(),   // Dirección IP del cliente
                'user_type' => auth()->user()->getMorphClass(), // Nombre de la clase del usuario autenticado actualmente
                'old' => json_encode($original),  //  Estado original del paciente
                // otros campos de auditoría...
            ]);
        });
    
        static::deleted(function ($registro) {
            $registro->audits()->create([
                'event' => 'deleted',
                'user_id' => auth()->id(),
                'url' => Request::fullUrl(), // URL actual
                'ip_address' => Request::ip(),   // Dirección IP del cliente
                'user_type' => auth()->user()->getMorphClass(), // Nombre de la clase del usuario autenticado actualmente
                'old' => json_encode($registro->toArray()), // Registro eliminado
                // otros campos de auditoría...
            ]);
        });
    }
    }
