<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
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
            'scheduled_date' => $this->faker->date(),
            'scheduled_time' => $this->faker->time(),
            'contact_method' => $this->faker->randomElement(['phone call','email','sms']),
            'additional_note' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement(['requested','confirmed','completed','cancelled']),
        ];
    }
}
