<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Parking_placesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'row' => $this->faker->unique()->numberBetween(1, 5),
            'column' => $this->faker->unique()->numberBetween(1, 3),
            'parking_id' => 1,
        ];
    }
}
