<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyDetail>
 */
class PropertyDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed> 
     */
    public function definition(): array
    {
        return [
            'property_id' => \App\Models\Property::factory(),
            'area_size' => $this->faker->randomFloat(2, 50, 500),
            'bed_rooms' => $this->faker->numberBetween(1, 10),
            'bath_rooms' => $this->faker->numberBetween(1, 10),
            'balcony' => $this->faker->boolean(),
            'swimming_pool' => $this->faker->boolean(),
            'garden' => $this->faker->boolean(),
            'gym' => $this->faker->boolean(),
            'security' => $this->faker->boolean(),
            'parking' => $this->faker->boolean(),
            'year_built' => $this->faker->year(),
        ];
    }
}
