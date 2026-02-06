<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PayrollRun>
 */
class PayrollRunFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gross = fake()->randomFloat(2, 3000, 9000);
        $deductions = fake()->randomFloat(2, 100, 1000);

        return [
            'employee_id' => \App\Models\Employee::factory(),
            'period_start' => now()->startOfMonth()->toDateString(),
            'period_end' => now()->endOfMonth()->toDateString(),
            'gross_amount' => $gross,
            'total_deductions' => $deductions,
            'net_amount' => $gross - $deductions,
            'status' => 'paid',
            'paid_at' => now(),
        ];
    }
}
