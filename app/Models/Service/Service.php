<?php

namespace App\Models\Service;

use App\Models\Outlet\Outlet;
use App\Models\ServiceType\ServiceType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $primaryKey = 'service_id';
    protected $fillable = [
        'service_name',
        'service_type_id',
        'price',
        'estimated_duration',
        'description',
        'is_active',
        'outle_id'
        
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function serviceType(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id', 'service_type_id');
    }

    public function outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class, 'outlet_id', 'id_outlet');
    }

    public function scopeActive($query)
   {
    return $query->where('is_active', true);
   }
}
