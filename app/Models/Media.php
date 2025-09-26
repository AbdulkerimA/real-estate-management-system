<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /** @use HasFactory<\Database\Factories\MediaFactory> */
    use HasFactory;

    protected $fillable = ['owner_id','file_path','file_type'];
    
    // Relationships
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }
}
