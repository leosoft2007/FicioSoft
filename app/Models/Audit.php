<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Audit extends Model
{
    
    protected $fillable = [
        'event',
        'auditable_type',
        'auditable_id',
        'user_type',
        'user_id',
        'url',
        'ip_address',
        'old',
        
    ];
    /** @use HasFactory<\Database\Factories\AuditFactory> */
    use HasFactory;
    public function auditable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->morphTo();
    }
    
}
