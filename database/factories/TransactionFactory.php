<?php

namespace Database\Factories;

use App\Models\properties;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\transaction>
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
            'buyer_id' => User::inRandomOrder()->first()->id,
            'property_id' => properties::inRandomOrder()->first()->property_id,
            'offer_amount' => $this->faker->randomFloat(2, 20000, 1000000),
            'status' => $this->faker->randomElement(['pending','confirmed','failed','refunded'])
        ];
    }
}
