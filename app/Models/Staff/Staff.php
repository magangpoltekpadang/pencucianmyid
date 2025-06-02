<?php

namespace App\Models\Staff;

use App\Models\Outlet\Outlet;
use App\Models\Role\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Staff extends Model
{
    protected $primaryKey = 'staff_id';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password_hash',
        'outlet_id',
        'role_id',
        'is_active'
        
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $table= 'staff';

    public function outlet(): BelongsTo 
   {
    return $this->belongsTo(Outlet::class, 'outlet_id', 'id_outlet');
   }

   public function role(): BelongsTo 
   {
    return $this->belongsTo(Role::class, 'role_id', 'role_id');
   }

   public function scopeActive($query)
   {
    return $query->where('is_active', true);
   }
}
