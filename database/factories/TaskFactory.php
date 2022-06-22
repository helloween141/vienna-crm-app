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
            'executor_id' => User::factory(),
            'client_id' => Client::factory(),
            'short_description' => $this->faker->text(50),
            'full_description' => $this->faker->text(150),
            'type' => $this->faker->randomElement([
                'consultation', 'content', 'code', 'design',
                'configure', 'warranty', 'other'
            ]),
            'status' => $this->faker->randomElement([
                'new', 'progess', 'complete', 'waiting_answer', 'waiting_payment',
                'additional', 'cancel'
            ]),
            'priority' => $this->faker->randomElement(['low', 'middle', 'high']),
            'deadline_at' => $this->faker->dateTime,
            'finished_at' => $this->faker->dateTime,
            'executor_time' => $this->faker->numberBetween(15, 200),
        ];
    }
}
