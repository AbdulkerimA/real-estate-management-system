<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /** @use HasFactory<\Database\Factories\SettingFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id','language','time_zone',
        'email_notification','sms_notification','appointment_reminder',
        'two_factor_authentication','allow_direct_message','deactivated'
    ];
    
     // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
