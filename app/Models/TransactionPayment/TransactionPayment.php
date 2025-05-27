<?php

namespace App\Models\TransactionPayment;

use App\Models\PaymentMethod\PaymentMethod;
use App\Models\PaymentStatus\PaymentStatus;
use App\Models\Transaction\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionPayment extends Model
{
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'transaction_id',
        'payment_method_id',
        'amount',
        'payment_date',
        'reference_number',
        'status_id',
        'notes'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];


    public function Transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'transaction_id');
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'payment_method_id');
    }

    public function paymentStatus(): BelongsTo
    {
        return $this->belongsTo(PaymentStatus::class, 'status_id', 'status_id');
    }

}
