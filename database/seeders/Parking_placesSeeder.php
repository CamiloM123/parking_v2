<?php

namespace Database\Seeders;

use App\Models\Parking_place;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Parking_placesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parking_places')->delete();

        Parking_place::create(
            [   
                'row' => 1,
                'column' => 1,
                'parking_id' => 1,
            ],
        );

        Parking_place::create(
            [
                'row' => 1,
                'column' => 2,
                'parking_id' => 1,
            ],
        );

        Parking_place::create(
            [
                'row' => 1,
                'column' => 3,
                'parking_id' => 1,
            ],
        );

        Parking_place::create(
            [   
                'row' => 1,
                'column' => 4,
                'parking_id' => 2,
            ],
        );

        Parking_place::create(
            [
                'row' => 1,
                'column' => 5,
                'parking_id' => 2,
            ],
        );

        Parking_place::create(
            [
                'row' => 2,
                'column' => 1,
                'parking_id' => 2,
            ],
        );
    }
}
