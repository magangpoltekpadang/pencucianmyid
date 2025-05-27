<?php

namespace App\Models\TransactionService;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionService extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_service_id',
        'transaction_id',
        'service_id',
        'quantity',
        'unit_price',
        'discount',
        'total_discount',
        'worker_id',
        'start_time',
        'end_time',
        'status',
        'notes'
    ];

    protected $casts = [
        'created_at' => 'Datetime',
        'updated_at' => 'Datetime'
    ];

    protected $table = 'transaction_services';

    
}
