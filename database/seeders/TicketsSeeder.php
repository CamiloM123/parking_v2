<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\Parking;
use App\Models\Vehicle;
use App\Models\Parking_place;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $parking_id = Parking::first()->id;
        $vehicle_id = Vehicle::first()->id;
        $parking_place_id = Parking_place::first()->id;
        DB::table('tickets')->delete();
        Ticket::create([
            'parking_id' => $parking_id,
            'vehicle_id' => $vehicle_id,
            'parking_place_id' => $parking_place_id,
        ]);
    }
}
