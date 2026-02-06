<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deduction>
 */
class DeductionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => \App\Models\Employee::factory(),
            'name' => fake()->randomElement(['Tax', 'Health Insurance', 'Pension', 'Union Fees']),
            'amount' => fake()->randomFloat(2, 50, 500),
            'type' => 'fixed',
        ];
    }
}
