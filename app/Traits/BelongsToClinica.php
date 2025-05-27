<?php

namespace App\Traits;

use App\Models\Scopes\ClinicaScope;

trait BelongsToClinica
{
    protected static function bootBelongsToClinica()
    {
        if (property_exists(static::class, 'hasClinica') && static::$hasClinica) {
            static::addGlobalScope(new ClinicaScope);

            static::creating(function ($model) {
                if (auth()->check()) {
                    $model->clinica_id = auth()->user()->clinica_id;
                }
            });
        }
    }
}
