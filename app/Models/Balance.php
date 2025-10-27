<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'agent_id','current_balance','total_check_out',
    ];

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}
