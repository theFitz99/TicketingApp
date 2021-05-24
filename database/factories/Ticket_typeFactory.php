<?php

namespace Database\Factories;

use App\Models\Ticket_type;
use Illuminate\Database\Eloquent\Factories\Factory;

class Ticket_typeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket_type::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->text(15),
        ];
    }
}
