<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        $this->call(UsersSeeder::class);
        $this->call(ParkingsSeeder::class);
        $this->call(Parking_placesSeeder::class);
        $this->call(OwnersSeeder::class);
        $this->call(TypesSeeder::class);
        $this->call(VehiclesSeeder::class);
        $this->call(TicketsSeeder::class);
    }
}
