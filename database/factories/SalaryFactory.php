<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SalaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['Monthly', 'Semi-Monthly']),
            'rate' => $this->faker->randomFloat(2, 15000, 100000),
            'allowance' => $this->faker->randomFloat(2, 500, 5000),
            'housing_allowance' => $this->faker->randomFloat(2, 0, 3000),
            'is_minimum_wager' => false,
            'divisor' => 22,
        ];
    }
}
