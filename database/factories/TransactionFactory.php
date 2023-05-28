<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 50),
            'date' => fake()->date(),
            'type' => rand(0, 10),
            'summ' => rand(0, 10000000),
            'operation_date' => fake()->date(),
            'ppm' => rand(0, 10)
        ];
    }
}
