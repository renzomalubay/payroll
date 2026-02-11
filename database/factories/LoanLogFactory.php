<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Loan;
use App\Models\Payroll;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoanLog>
 */
class LoanLogFactory extends Factory
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
            'loan_id' => Loan::factory(),
            'payroll_id' => Payroll::factory(),
            'amount_deducted' => $this->faker->randomFloat(2, 500, 2000),
            'remaining_balance' => $this->faker->randomFloat(2, 5000, 20000),
        ];
    }
}
