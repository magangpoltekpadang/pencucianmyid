<?php

namespace App\Models\Shift;

use App\Models\Outlet\Outlet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shift extends Model
{

    protected $primaryKey = 'shift_id';

    protected $fillable = [
        'outlet_id',
        'shift_name',
        'start_name',
        'end_time',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

   public function outlet(): BelongsTo 
   {
    return $this->belongsTo(Outlet::class, 'outlet_id', 'id_outlet');
   }

   public function scopeActive($query)
   {
    return $query->where('is_active', true);
   }

protected static function booted()
   {
    static::saving(function ($shift){
        if ($shift->start_time >= $shift->end_time) {
            throw new \Exception('Waktu mulai harus sebelum waktu selesai');
        }
    });
   }
}
