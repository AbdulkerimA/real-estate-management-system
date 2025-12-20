<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;

    protected $fillable = [
        'agent_id','media_id','type',
        'title','description','price','location',
        'latitude','longitude'
    ];
    
    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class,'agent_id','id');
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function details()
    {
        return $this->hasOne(PropertyDetail::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function bookMarks(){
        return $this->hasMany(BookMark::class);
    }

    // helper functions
    public function getFirstImage(){
        // dd($this);
        $images = json_decode($this->media->file_path, true);
        return $images[0];
    }
}
