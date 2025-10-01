<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    /** @use HasFactory<\Database\Factories\AgentFactory> */
    use HasFactory;

     protected $fillable = [
        'user_id','media_id','document_id','bio','address',
        'speciality','years_of_experience'
    ];
    
     // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function earnings()
    {
        return $this->hasOne(Earning::class);
    }
}
