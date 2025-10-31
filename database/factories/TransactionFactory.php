<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\Property;
use App\Models\User;
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
            'buyer_id' => User::factory(),
            'agent_id' => Agent::factory(),
            'property_id' => Property::factory(),
            'offer_amount' => $this->faker->randomFloat(2, 10000, 1000000),
            'status' => $this->faker->randomElement(['pending','confirmed','failed','refunded']),
        ];
    }
}
