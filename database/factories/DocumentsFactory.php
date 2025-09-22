<?php

namespace Database\Factories;

use App\Models\properties;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\documents>
 */
class DocumentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => properties::factory(),
            'doc_type' => $this->faker->randomElement(['license','ownership','tax']),
            'file_path' => $this->faker->filePath(),
            'status' => $this->faker->randomElement(['pending','verified','rejected']),
        ];
    }
}
