<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
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
            'buyer_id' => User::factory(),
            'property_id' => Property::factory(),
            'scheduled_date' => $this->faker->date(),
            'scheduled_time' => $this->faker->time(),
            'contact_method' => $this->faker->randomElement(['call','email','sms']),
            'additional_note' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['pending','scheduled','completed','cancelled']),
        ];
    }
}
