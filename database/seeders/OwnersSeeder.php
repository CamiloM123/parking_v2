<?php

namespace Database\Seeders;

use App\Models\Owner;
use App\Models\Parking;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OwnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parking_id = Parking::first()->id;
        $parking_id_2 = $parking_id + 1;

        DB::table('owners')->delete();

        Owner::create(
            [
                'name' => 'Santiago',
                'birthday' => '2001-08-21', 
                'parking_id' => $parking_id, 
            ],
        );

        Owner::create(
            [
                'name' => 'Sebastian',
                'birthday' => '2001-08-21', 
                'parking_id' => $parking_id, 
            ],
        );

        Owner::create(
            [
                'name' => 'Luis',
                'birthday' => '2002-08-21',  
                'parking_id' => $parking_id,
            ],
        );

        Owner::create(
            [
                'name' => 'Camilo',
                'birthday' => '1999-08-21',  
                'parking_id' => $parking_id_2,
            ],
        );

    }
}
