<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    /** @use HasFactory<\Database\Factories\AgentFactory> */
    use HasFactory;

     protected $fillable = [
        'user_id','media_id','document_id','bio','about_me',
        'address','speciality','years_of_experience'
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

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function earnings()
    {
        return $this->hasMany(Earning::class);
    }

    public function balance(){
        return $this->hasOne(Balance::class);
    }

    public function checkoutRequest(){
        return $this->hasMany(CheckoutRequest::class);
    }

    // a relationship helper function 
    public function lastApprovedCheckout(){
        return $this->hasMany(CheckoutRequest::class)
                    ->where('request_status', 'approved')
                    ->latest('created_at');
    } 

    // helper functions
    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
    public function totalRating()
    {
        return $this->reviews()->get('id')->count();
    }
}
