<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'client_id' => Client::factory(),
            'description' => $this->faker->text(150),
            'comment' => $this->faker->text(50),
            'status' => $this->faker->randomElement(['new', 'in_progess', 'cancel', 'done']),
            'priority' => $this->faker->randomElement(['low', 'mid', 'high']),
            'deadline_at' => $this->faker->dateTime,
            'tech_comment' => '',
            'client_comment' => '',
            'executor_time' => $this->faker->numberBetween(15, 200),
            'finished_at' => $this->faker->dateTime,
        ];
    }
}
