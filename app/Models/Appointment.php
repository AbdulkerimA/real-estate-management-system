<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /** @use HasFactory<\Database\Factories\AppointmentFactory> */
    use HasFactory;

    protected $fillable = [
        'buyer_id','property_id','scheduled_date',
        'scheduled_time','contact_method','additional_note','status'
    ];
    
     // Relationships
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

}
