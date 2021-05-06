<?php

namespace Database\Factories;

use App\Models\Contacts;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contacts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'post_code' => $this->faker->postcode(),
            'email' => $this->faker->unique()->email(),
            'phone' => $this->faker->unique()->phoneNumber()
        ];
    }
}
