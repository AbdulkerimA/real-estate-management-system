<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'agent_id' => Agent::factory(),
            'media_id' => Media::factory(),
            'title' => $this->faker->sentence(3),
            'type' => $this->faker->randomElement(['apartment','house','land','commercial','luxury']),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 10000, 1000000),
            'location' => $this->faker->city(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'status' => $this->faker->randomElement(['pending','approved','sold','rejected']),
            'is_hignlighted' => $this->faker->boolean(),
        ];
    }
}
