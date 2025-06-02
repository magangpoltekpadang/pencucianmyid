<?php

namespace App\Models\VehicleTyp;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    protected $primaryKey = 'vehicle_type_id';

    protected $fillable = [
        'type_name',
        'code',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $table= 'vehicle_types';

    public function scopeSearch(Builder $query, $value)
{
    $query->where('type_name', 'like', "%$value%");
}
    
}
