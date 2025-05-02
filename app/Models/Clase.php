<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Clase extends Model
{
    /** @use HasFactory<\Database\Factories\ClaseFactory> */
    use HasFactory;
    use Auditable;
    use HasRoles;
    protected $perPage = 20;
    protected $fillable = [
        'paciente_id',
        'cita_id',
    ];
    
}
