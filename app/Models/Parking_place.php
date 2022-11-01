<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking_place extends Model
{
    use HasFactory;

    protected $fillable = [
        'row',
        'column',
    ];

    function parking()
    {
        return $this->belongsTo(Parking::class);
    }

    function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
