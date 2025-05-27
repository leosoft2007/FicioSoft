<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;



class ClinicaScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (auth()->check()) {
            $table = $model->getTable();
            $builder->where("$table.clinica_id", auth()->user()->clinica_id);
        } else {
            // Seguridad: si no hay usuario, que no retorne nada
            $builder->whereRaw('0 = 1');
        }
    }
}
