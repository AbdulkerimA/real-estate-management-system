<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agent>
 */
class AgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'media_id' => \App\Models\Media::factory(),
            'document_id' => \App\Models\Document::factory(),
            'bio' => $this->faker->paragraph(),
            'about_me' => $this->faker->paragraph(),
            'address' => $this->faker->address(),
            'featured' => $this->faker->boolean(),
            'is_verified' => $this->faker->boolean(),
            'speciality' => $this->faker->randomElement(['apartments','houses','lands','commercial','luxury']),
            'years_of_experience' => $this->faker->numberBetween(0, 40),
            'deals_closed' => $this->faker->numberBetween(0, 100),
        ];
    }
}
