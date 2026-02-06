<?php

namespace Database\Seeders;

use App\Models\Deduction;
use App\Models\Department;
use App\Models\Employee;
use App\Models\PayrollRun;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 1. Create 5 Departments
        $departments = Department::factory(5)->create();

        foreach ($departments as $dept) {
            // 2. Create 10 Employees for each department
            Employee::factory(10)
                ->create(['department_id' => $dept->id])
                ->each(function ($employee) {

                    // 3. Give each employee a Salary record
                    Salary::factory()->create(['employee_id' => $employee->id]);

                    // 4. Give each employee 3 dummy Deductions
                    Deduction::factory(3)->create([
                        'employee_id' => $employee->id,
                        'type' => 'fixed'
                    ]);

                    // 5. Create some dummy Payroll Runs for the past 2 months
                    PayrollRun::factory()->create([
                        'employee_id' => $employee->id,
                        'status' => 'paid',
                        'period_start' => now()->subMonth()->startOfMonth(),
                        'period_end' => now()->subMonth()->endOfMonth(),
                    ]);
                });
        }
    }
}
