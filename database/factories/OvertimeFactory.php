<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Overtime>
 */
class OvertimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hrs = $this->faker->randomFloat(2, 1, 4);
        $rate = $this->faker->randomFloat(2, 100, 300);
        return [
            'employee_id' => Employee::factory(),
            'payroll_id' => null, // Usually null until a payroll run is generated
            'overtime_hrs' => $hrs,
            'rate_per_hour' => $rate,
            'total_ot_pay' => $hrs * $rate,
            'date_rendered' => $this->faker->date(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'paid']),
        ];
    }
}
