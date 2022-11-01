<?php

namespace Database\Seeders;

use App\Models\Owner;
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
        DB::table('owners')->delete();

        Owner::create(
            [
                'name' => 'Santiago',
                'birthday' => '2002-08-21', 
                'parking_id' => 1, 
            ],
        );

        Owner::create(
            [
                'name' => 'Luis',
                'birthday' => '2002-08-21',  
                'parking_id' => 2,
            ],
        );

    }
}
