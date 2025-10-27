<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    /** @use HasFactory<\Database\Factories\EarningFactory> */
    use HasFactory;

    protected $fillable = ['agent_id','property_id','total_earnings','commission'];
    
    // Relationships
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function peroperty(){
        return $this->belongsTo(Property::class);
    }

}

