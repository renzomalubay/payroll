<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payroll>
 */
class PayrollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'PYRL-' . strtoupper($this->faker->bothify('??###')),
            'month' => now()->format('F'),
            'date_start' => now()->startOfMonth(),
            'date_end' => now()->endOfMonth(),
            'status' => 'Draft',
        ];
    }
}
