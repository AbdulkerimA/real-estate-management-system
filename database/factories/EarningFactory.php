<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Earning>
 */
class EarningFactory extends Factory
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
            'property_id' => Property::factory(),
            'total_earnings' => $this->faker->randomFloat(2, 0, 100000),
            'commission' => $this->faker->randomFloat(2, 0, 10000),
        ];
    }
}
