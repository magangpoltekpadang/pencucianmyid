<?php

namespace App\Models\Expense;

use App\Models\Outlet\Outlet;
use App\Models\Shift\Shift;
use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    protected $primaryKey = 'expense_id';
    
    protected $fillable = [
        'expense_code',
        'outlet_id',
        'expense_date',
        'amount',
        'category',
        'description',
        'staff_id',
        'shift_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function Outlet(): BelongsTo
    {
        return $this->belongsTo(Outlet::class, 'outet_id', 'id_outlet');
    }

    public function Shiff(): BelongsTo
    {
        return $this->belongsTo(Shift::class, 'shift_id', 'shift_id');
    }
    public function Staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
    }
}
