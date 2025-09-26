<?php

namespace Database\Factories;

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
            'agent_id' => \App\Models\Agent::factory(),
            'total_earnings' => $this->faker->randomFloat(2, 1000, 100000),
            'total_check_out' => $this->faker->randomFloat(2, 500, 50000),
            'requested_check_out' => $this->faker->randomFloat(2, 100, 10000),
        ];
    }
}
