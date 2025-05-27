<?php

namespace App\Models\Notification;

use App\Models\Customer\Customer;
use App\Models\NotificationStatus\NotificationStatus;
use App\Models\NotificationType\NotificationType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\NotificationSender;

class Notification extends Model
{
   protected $primaryKey = 'notification_id';

    protected $fillable = [
        'customer_id',
        'notification_type_id',
        'message',
        'sent_at',
        'status_id',
        'rentry_count'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function notificationType()
    {
        return $this->belongsTo(NotificationType::class, 'notification_type_id', 'notification_type_id');
    }
    public function noticationStatus()
    {
        return $this->belongsTo(NotificationStatus::class, 'status_id', 'status_id');
    }

   
}
