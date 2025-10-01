<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentFactory> */
    use HasFactory;
    
    protected $fillable = ['doc_type','file_path'];

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
