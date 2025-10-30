<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Agent;
use App\Models\Property;
use App\Models\PropertyDetail;
use App\Models\Media;
use App\Models\Document;
use App\Models\Appointment;
use App\Models\Transaction;
use App\Models\Review;
use App\Models\Earning;
use App\Models\Setting;
use App\Models\CheckoutRequest;
use App\Models\Balance;

/** @extends Factory<User> */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role' => $this->faker->randomElement(['customer','agent','admin']),
            'status' => $this->faker->randomElement(['pending','Verified','Suspended']),
            'remember_token' => Str::random(10),
        ];
    }
}

class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition()
    {
        return [
            'file_path' => 'media/default.jpg',
            'file_type' => 'image/jpeg',
        ];
    }

    public function agentProfile()
    {
        return $this->state([
            'file_path' => 'profiles/vRPRYviV8yLO6e7jwWmifE0HaNLSWWDJOoWGIr7F.jpg',
            'file_type' => 'image/jpeg',
        ]);
    }

    public function propertyImage()
    {
        $paths = [
            "properties/F3r3Tv0tqZzzaCK2fLg8FjUklilkUIlip6p2MJzc.jpg",
            "properties/tRIgCtcUI3hHKaeg0joZjdrpgM32rPquQDgozR8q.jpg",
            "properties/xuzF3tL3ISLh8vBPGiaWmw6z8IoOoweFugAIMBgJ.jpg",
            "properties/hYr6qhkwtexjh8xG5zyvxcSEtlBymRaWZoDUS9uA.jpg",
            "properties/CZ4zJdpRKjMdFZSLUBMRoUrBd3dvDT8U2u7Z2FSH.jpg",
            "properties/FAEdpIzpNhwWxoy12sy7FJdMNa4oDp4U71zwJuJw.jpg",
            "properties/XGflrraW6nzZWJLYooV6OGTfVFR4iGpJ6iuQZdII.jpg"
        ];
        return $this->state([
            'file_path' => $this->faker->randomElement($paths),
            'file_type' => 'image/jpeg',
        ]);
    }
}

class DocumentFactory extends Factory
{
    protected $model = Document::class;

    public function definition()
    {
        return [
            'doc_type' => $this->faker->randomElement(['license','id_card','passport']),
            'file_path' => 'documents/'.$this->faker->uuid().'.jpg',
            'status' => $this->faker->randomElement(['pending','verified','rejected']),
        ];
    }
}

class AgentFactory extends Factory
{
    protected $model = Agent::class;

    public function definition()
    {
        return [
            'user_id' => User::factory()->state(fn(array $attributes) => ['role'=>'agent']),
            'media_id' => Media::factory()->agentProfile(),
            'document_id' => Document::factory(),
            'bio' => $this->faker->sentence(),
            'about_me' => $this->faker->paragraph(),
            'address' => $this->faker->address(),
            'featured' => $this->faker->boolean(),
            'is_verified' => $this->faker->boolean(),
            'speciality' => $this->faker->randomElement(['apartments','houses','lands','commercial','luxury']),
            'years_of_experience' => $this->faker->numberBetween(1,20),
            'deals_closed' => $this->faker->numberBetween(0,100),
        ];
    }
}

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition()
    {
        return [
            'agent_id' => Agent::factory(),
            'media_id' => Media::factory()->propertyImage(),
            'title' => $this->faker->sentence(3),
            'type' => $this->faker->randomElement(['apartment','house','land','commercial']),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2,5000,1000000),
            'location' => $this->faker->city(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'status' => $this->faker->randomElement(['pending','approved','sold','rejected']),
            'is_hignlighted' => $this->faker->boolean(),
        ];
    }
}

class PropertyDetailFactory extends Factory
{
    protected $model = PropertyDetail::class;

    public function definition()
    {
        return [
            'property_id' => Property::factory(),
            'area_size' => $this->faker->randomFloat(2,50,1000),
            'bed_rooms' => $this->faker->numberBetween(1,10),
            'bath_rooms' => $this->faker->numberBetween(1,10),
            'balcony' => $this->faker->boolean(),
            'swimming_pool' => $this->faker->boolean(),
            'garden' => $this->faker->boolean(),
            'gym' => $this->faker->boolean(),
            'security' => $this->faker->boolean(),
            'parking' => $this->faker->boolean(),
            'year_built' => $this->faker->year(),
        ];
    }
}

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition()
    {
        return [
            'buyer_id' => User::factory()->state(fn(array $attr) => ['role'=>'customer']),
            'property_id' => Property::factory(),
            'scheduled_date' => $this->faker->date(),
            'scheduled_time' => $this->faker->time(),
            'contact_method' => $this->faker->randomElement(['call','email','sms']),
            'additional_note' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['pending','scheduled','completed','cancelled']),
        ];
    }
}

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'buyer_id' => User::factory()->state(fn(array $attr) => ['role'=>'customer']),
            'agent_id' => Agent::factory(),
            'property_id' => Property::factory(),
            'offer_amount' => $this->faker->randomFloat(2,5000,1000000),
            'status' => $this->faker->randomElement(['pending','confirmed','failed','refunded']),
        ];
    }
}

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'user_id' => User::factory()->state(fn(array $attr) => ['role'=>'customer']),
            'agent_id' => Agent::factory(),
            'rating' => $this->faker->numberBetween(1,5),
            'comment' => $this->faker->sentence(),
        ];
    }
}

class EarningFactory extends Factory
{
    protected $model = Earning::class;

    public function definition()
    {
        return [
            'agent_id' => Agent::factory(),
            'property_id' => Property::factory(),
            'total_earnings' => $this->faker->randomFloat(2,1000,100000),
            'commission' => $this->faker->randomFloat(2,100,10000),
        ];
    }
}

class SettingFactory extends Factory
{
    protected $model = Setting::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'language' => $this->faker->randomElement(['en','fr','es']),
            'time_zone' => $this->faker->timezone(),
            'email_notification' => $this->faker->boolean(),
            'sms_notification' => $this->faker->boolean(),
            'appointment_reminder' => $this->faker->boolean(),
            'two_factor_authentication' => $this->faker->boolean(),
            'allow_direct_message' => $this->faker->boolean(),
            'show_online_statatus' => $this->faker->boolean(),
            'deactivated' => $this->faker->boolean(),
        ];
    }
}

class CheckoutRequestFactory extends Factory
{
    protected $model = CheckoutRequest::class;

    public function definition()
    {
        return [
            'agent_id' => Agent::factory(),
            'requested_amount' => $this->faker->randomFloat(2,100,10000),
            'request_status' => $this->faker->randomElement(['pending','approved','rejected']),
        ];
    }
}

class BalanceFactory extends Factory
{
    protected $model = Balance::class;

    public function definition()
    {
        return [
            'agent_id' => Agent::factory(),
            'current_balance' => $this->faker->randomFloat(2,0,50000),
            'total_check_out' => $this->faker->randomFloat(2,0,50000),
        ];
    }
}
