<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'address',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parking_places()
    {
        return $this->hasMany(Parking_place::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function owners()
    {
        return $this->hasMany(Owner::class);
    }
}
