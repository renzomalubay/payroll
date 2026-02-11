<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Payroll;
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
            'employee_id' => Employee::factory(),
            'payroll_id' => Payroll::factory(),
            'absent_deduction' => $this->faker->randomFloat(2, 0, 500),
            'late_deduction' => $this->faker->randomFloat(2, 0, 200),
            'loan_deduction' => $this->faker->randomFloat(2, 0, 1000),
            'statutory_sss' => $this->faker->randomFloat(2, 500, 1200),
            'statutory_philhealth' => $this->faker->randomFloat(2, 300, 800),
            'statutory_hdmf' => 100.00,
            'total_deductions' => function (array $attributes) {
                return $attributes['absent_deduction'] +
                    $attributes['late_deduction'] +
                    $attributes['loan_deduction'] +
                    $attributes['statutory_sss'] +
                    $attributes['statutory_philhealth'] +
                    $attributes['statutory_hdmf'];
            },
        ];
    }
}
