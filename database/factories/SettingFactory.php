<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
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
            'language' => $this->faker->randomElement(['en','fr','es']),
            'time_zone' => $this->faker->timezone(),
            'email_notification' => $this->faker->boolean(80),
            'sms_notification' => $this->faker->boolean(50),
            'appointment_reminder' => $this->faker->boolean(70),
            'two_factor_authentication' => $this->faker->boolean(70),
            'allow_direct_message' => $this->faker->boolean(40),
            'deactivated' => $this->faker->boolean(10),
        ];
    }
}
