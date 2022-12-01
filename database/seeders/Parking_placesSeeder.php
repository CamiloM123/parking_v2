<?php

namespace Database\Seeders;

use App\Models\Parking;
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
        $parking_1 = Parking :: first()->id;
        $parking_2 = $parking_1 + 1;
        DB::table('parking_places')->delete();

        Parking_place::create(
            [   
                'row' => 1,
                'column' => 1,
                'parking_id' => $parking_1 ,
            ],
        );

        Parking_place::create(
            [
                'row' => 1,
                'column' => 2,
                'parking_id' => $parking_1,
            ],
        );

        Parking_place::create(
            [
                'row' => 1,
                'column' => 3,
                'parking_id' => $parking_1,
            ],
        );

        Parking_place::create(
            [   
                'row' => 1,
                'column' => 4,
                'parking_id' => $parking_1,
            ],
        );

        Parking_place::create(
            [
                'row' => 1,
                'column' => 5,
                'parking_id' => $parking_1,
            ],
        );

        Parking_place::create(
            [   
                'row' => 2,
                'column' => 1,
                'parking_id' => $parking_1,
            ],
        );

        Parking_place::create(
            [
                'row' => 2,
                'column' => 2,
                'parking_id' => $parking_1,
            ],
        );

        Parking_place::create(
            [
                'row' => 2,
                'column' => 3,
                'parking_id' => $parking_1,
            ],
        );

        Parking_place::create(
            [   
                'row' => 2,
                'column' => 4,
                'parking_id' => $parking_1,
            ],
        );

        Parking_place::create(
            [
                'row' => 2,
                'column' => 5,
                'parking_id' => $parking_1,
            ],
        );

        Parking_place::create(
            [   
                'row' => 3,
                'column' => 1,
                'parking_id' => $parking_1,
            ],
        );

        Parking_place::create(
            [
                'row' => 3,
                'column' => 2,
                'parking_id' => $parking_1,
            ],
        );

        Parking_place::create(
            [
                'row' => 3,
                'column' => 3,
                'parking_id' => $parking_1,
            ],
        );

        Parking_place::create(
            [   
                'row' => 3,
                'column' => 4,
                'parking_id' => $parking_1,
            ],
        );

        Parking_place::create(
            [
                'row' => 3,
                'column' => 5,
                'parking_id' => $parking_1,
            ],
        );

        Parking_place::create(
            [   
                'row' => 1,
                'column' => 1,
                'parking_id' => $parking_2,
            ],
        );

        Parking_place::create(
            [
                'row' => 1,
                'column' => 2,
                'parking_id' => $parking_2,
            ],
        );

        Parking_place::create(
            [
                'row' => 1,
                'column' => 3,
                'parking_id' => $parking_2,
            ],
        );

        Parking_place::create(
            [   
                'row' => 1,
                'column' => 4,
                'parking_id' => $parking_2
            ],
        );

        Parking_place::create(
            [
                'row' => 1,
                'column' => 5,
                'parking_id' => $parking_2,
            ],
        );

        Parking_place::create(
            [   
                'row' => 2,
                'column' => 1,
                'parking_id' => $parking_2,
            ],
        );

        Parking_place::create(
            [
                'row' => 2,
                'column' => 2,
                'parking_id' => $parking_2,
            ],
        );

        Parking_place::create(
            [
                'row' => 2,
                'column' => 3,
                'parking_id' => $parking_2,
            ],
        );

        Parking_place::create(
            [   
                'row' => 2,
                'column' => 4,
                'parking_id' => $parking_2,
            ],
        );

        Parking_place::create(
            [
                'row' => 2,
                'column' => 5,
                'parking_id' => $parking_2,
            ],
        );

        Parking_place::create(
            [   
                'row' => 3,
                'column' => 1,
                'parking_id' => $parking_2,
            ],
        );

        Parking_place::create(
            [
                'row' => 3,
                'column' => 2,
                'parking_id' => $parking_2,
            ],
        );

        Parking_place::create(
            [
                'row' => 3,
                'column' => 3,
                'parking_id' => $parking_2,
            ],
        );

        Parking_place::create(
            [   
                'row' => 3,
                'column' => 4,
                'parking_id' => $parking_2,
            ],
        );

        Parking_place::create(
            [
                'row' => 3,
                'column' => 5,
                'parking_id' => $parking_2,
            ],
        );
        
    }
}
