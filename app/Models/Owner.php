<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'birthday',
        'parking_id',
    ];

    public function parking()
    {
        return $this->belongsTo(Parking::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
