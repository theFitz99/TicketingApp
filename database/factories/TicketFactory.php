<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\Ticket_type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type_id' => Ticket_type::all()->random(),
            'title' => $this->faker->text(20),
            'description' => $this->faker->text(250),
            'is_done' => $this->faker->boolean(50) ? NULL : 1,
        ];
    }
}
