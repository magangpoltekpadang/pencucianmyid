<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'transaction_code',
        'customer_id',
        'outlet_id',
        'transaction_date',
        'subtotal',
        'discount',
        'tax',
        'payment_status_id',
        'gate_opened',
        'staff_id',
        'receipt_printed',
        'whatsapp_sent',
        'notes'
        
    ];

    protected $casts = [
        'gate_opened' => 'boolean',
        'receipt_printed' => 'boolean',
        'whatsapp_sent' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $table= 'transactions';
}
