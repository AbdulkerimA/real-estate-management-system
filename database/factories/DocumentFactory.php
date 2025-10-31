<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'doc_type' => '["image\/jpeg"]',
            'file_path' => '["agentDocuments\/spKlfY2SGkzKilmc0LTHTnI0P9lCqpeIHEpQHSPF.jpg"]',
            'status' => $this->faker->randomElement(['pending','verified','rejected']),
        ];
    }
}
