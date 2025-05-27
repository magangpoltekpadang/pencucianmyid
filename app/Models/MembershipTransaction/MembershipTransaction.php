<?php

namespace App\Models\MembershipTransaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'package_id',
        'outlet_id',
        'transaction_date',
        'price',
        'payment_method_id',
        'staff_id',
        'receipt_number'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $table= 'membership_transactions';
}
