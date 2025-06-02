<?php

namespace App\Models\Outlet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $primarykey = 'outlet_id';

    protected $fillable = [
        'outlet_name',
        'address',
        'phone_number',
        'latitude',
        'longitude',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $table= 'outlets';
}
