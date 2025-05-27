<?php

namespace App\Models\Customer;

use App\Models\ServiceType\ServiceType;
use App\Models\VehicleTyp\VehicleType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'plat_number',
        'name',
        'phone_number',
        'vehicle_type_id',
        'vehicle_color',
        'member_numberjoin_date',
        'member_expiry_date',
        'is_member'
        
    ];

    protected $casts = [
        'is_member' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    
    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id', 'vehicle_type_id');
    }

     public function scopeActive($query)
   {
    return $query->where('is_member', true);
   }
}
