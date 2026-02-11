<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'middle_name' => $this->faker->lastName(),
            'ext_name' => $this->faker->randomElement([null, 'Jr.', 'III']),
            'birth_date' => $this->faker->date('Y-m-d', '-20 years'),
            'contact_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'position' => $this->faker->jobTitle(),
            'employment_type' => $this->faker->randomElement(['regular', 'probationary']),
            'start_date' => $this->faker->date(),
            'leave_credit' => $this->faker->randomFloat(2, 0, 15),
            'sss_no' => $this->faker->numerify('##-#######-#'),
            'hdmf_no' => $this->faker->numerify('####-####-####'),
            'philhealth_no' => $this->faker->numerify('############'),
            'bank_account_number' => $this->faker->bankAccountNumber(),
            'department_id' => Department::factory(),
            'branch_id' => Branch::factory(),
            'salary_id' => Salary::factory(),
        ];
    }
}
