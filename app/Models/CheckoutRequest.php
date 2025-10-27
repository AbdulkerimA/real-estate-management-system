<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutRequest extends Model
{
     use HasFactory;

    protected $fillable = [
        'agent_id','requested_amount','request_status',
    ];

    public function agent() {
        return $this->BelongsTo(Agent::class);
    }
}
