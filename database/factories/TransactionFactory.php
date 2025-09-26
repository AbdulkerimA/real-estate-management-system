<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'buyer_id' => \App\Models\User::factory(),
            'property_id' => \App\Models\Property::factory(),
            'offer_amount' => $this->faker->randomFloat(2, 1000, 1000000),
            'status' => $this->faker->randomElement(['pending','confirmed','failed','refunded']),
        ];
    }
}
