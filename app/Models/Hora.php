<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Hora extends Model
{
    use Auditable;
    use HasFactory;
    protected $fillable = [
        'hora',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
    public function citas()
    {
        return $this->hasMany(Cita::class, 'hora_ini');
    }
    
    
    
}
