<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookMark extends Model
{
    /** @use HasFactory<\Database\Factories\BookMarkFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function customer(){
        return $this->belongsTo(User::class);
    }

    public function property(){
        return $this->belongsTo(Property::class);
    }
}
