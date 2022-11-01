<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'parking_place_id',
    ];

    public function parking()
    {
        return $this->belongsTo(Parking::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function parking_place()
    {
        return $this->belongsTo(Parking_place::class);
    }
}
