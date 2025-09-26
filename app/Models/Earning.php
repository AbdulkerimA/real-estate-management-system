<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    /** @use HasFactory<\Database\Factories\EarningFactory> */
    use HasFactory;

    protected $fillable = ['agent_id','total_earnings','total_check_out','requested_check_out'];
    
    // Relationships
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
