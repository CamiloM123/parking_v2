<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Owner;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_1 = Type :: first()->id;
        $type_2 = $type_1 + 1;
        $owner_1 = Owner :: first()->id;
        $owner_2 = $owner_1 + 1;
        $owner_3 = $owner_2 + 1;
        $owner_4 = $owner_3 + 1;

        DB::table('vehicles')->delete();

        Vehicle::create([
            'license_plate' => "ABC123", 
            'color' => "Red",
            'type_id' => $type_1,
            'owner_id' => $owner_1,
        ]);
        
        Vehicle::create([
            'license_plate' => "DEF123", 
            'color' => "Blue",
            'type_id' => $type_2,
            'owner_id' => $owner_2,
        ]);

        Vehicle::create([
            'license_plate' => "GHI123", 
            'color' => "Blue",
            'type_id' => $type_2,
            'owner_id' => $owner_3,
        ]);

        Vehicle::create([
            'license_plate' => "JKL123", 
            'color' => "Red",
            'type_id' => $type_1,
            'owner_id' => $owner_4,
        ]);
    }
}
