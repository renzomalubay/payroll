<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $totalAmount = $this->faker->randomFloat(2, 5000, 50000);
        $monthlyDeduction = $totalAmount / 12;

        return [
            'employee_id' => Employee::factory(),
            'loan_name' => $this->faker->randomElement(['SSS Salary Loan', 'Pag-IBIG Multi-Purpose', 'Emergency Loan']),
            'total_amount' => $totalAmount,
            'monthly_deduction' => $monthlyDeduction,
            'balance' => $this->faker->randomFloat(2, 1000, $totalAmount), // Current remaining balance
        ];
    }
}
