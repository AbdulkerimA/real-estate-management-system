<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class properties extends Model
{
    protected $table = 'properties';

    /** @use HasFactory<\Database\Factories\PropertiesFactory> */
    use HasFactory;

    //relationships
    public function user() {
        return $this->belongsTo(User::class);
    }
}
