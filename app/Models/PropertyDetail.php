<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyDetail extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyDetailFactory> */
    use HasFactory;

    protected $fillable = [
        'property_id','area_size','bed_rooms','bath_rooms',
        'balcony','swimming_pool','garden','gym','security',
        'parking','year_built'
    ];
    
    // Relationships
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
