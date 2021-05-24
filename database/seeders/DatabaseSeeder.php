<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(5)->create();
        \App\Models\Contacts::factory(100)->create();
        \App\Models\Ticket_type::factory(5)->create();
        for($i = 0; $i < 200; $i++)
        {
            $randomUser = User::all()->random();
            \App\Models\Ticket::factory()->create([
            'user_id' => $randomUser->id,
            'contact_id' => $randomUser->contacts()->inRandomOrder()->first(),
            ]);
        }
    }
}
