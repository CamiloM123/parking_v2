<?php

namespace Database\Seeders;

use App\Models\Parking;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ParkingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parkings')->delete();
        
        Parking::create([
            'name' => 'Parking 1',
            'address' => 'Cra 19 # 49-32',  
            'user_id' => 1,
        ]);

        Parking::create([
            'name' => 'Parking 2',
            'address' => 'Cra 43 # 65-10', 
            'user_id' => 2, 
        ]);
    }
}
