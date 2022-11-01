<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_type',
        'tariff'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
