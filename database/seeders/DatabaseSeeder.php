<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\Branch;
use App\Models\Salary;
use App\Models\Employee;
use App\Models\Shift;
use App\Models\Loan;
use App\Models\Schedule;
use App\Models\TimekeepLog;
use App\Models\Payroll;
use App\Models\LeaveType;
use App\Models\Leave;
use App\Models\TaxCategory;
use App\Models\OtherIncome;
use App\Models\Overtime;
use App\Models\Deduction;
use App\Models\LoanLog;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Independent Lookup Tables
        Role::create(['name' => 'HR Manager', 'role_type' => 'hr']);
        Role::create(['name' => 'Staff', 'role_type' => 'employee']);

        $leaveTypes = [
            ['name' => 'Sick Leave', 'code' => 'SL'],
            ['name' => 'Vacation Leave', 'code' => 'VL'],
            ['name' => 'Emergency Leave', 'code' => 'EL'],
        ];

        foreach ($leaveTypes as $type) {
            LeaveType::firstOrCreate(['code' => $type['code']], $type);
        }

        $taxCats = [
            ['name' => 'Taxable Income', 'is_taxable' => true],
            ['name' => 'Non-Taxable Allowance', 'is_taxable' => false],
        ];
        foreach ($taxCats as $cat) TaxCategory::create($cat);

        // 2. Foundation Tables (Using Factories)
        Department::factory(5)->create();
        Branch::factory(3)->create();
        Shift::factory(3)->create(); // e.g., Day, Night, Mid
        Salary::factory(10)->create();

        // 3. The Core: Employees
        // We create users first, then link them to employees
        Employee::factory(20)->create()->each(function ($employee) {

            // 4. Employee-Dependent Data
            Schedule::factory()->create(['employee_id' => $employee->id]);
            Loan::factory(rand(0, 2))->create(['employee_id' => $employee->id]);
            OtherIncome::factory(rand(1, 3))->create(['employee_id' => $employee->id]);

            // 5. Activity Records
            Leave::factory(2)->create(['employee_id' => $employee->id]);
        });

        // 6. Payroll Cycles
        Payroll::factory(3)->create()->each(function ($payroll) {
            $employees = Employee::all();

            foreach ($employees as $employee) {
                // Timekeeping for this payroll period
                TimekeepLog::factory(10)->create([
                    'employee_id' => $employee->id,
                    'schedule_id' => Schedule::where('employee_id', $employee->id)->first()->id
                ]);

                // Overtime records linked to payroll
                Overtime::factory(rand(0, 3))->create([
                    'employee_id' => $employee->id,
                    'payroll_id' => $payroll->id
                ]);

                // Deductions for this specific pay run
                Deduction::factory()->create([
                    'employee_id' => $employee->id,
                    'payroll_id' => $payroll->id
                ]);

                // If employee has a loan, create a log for this payroll
                $loan = Loan::where('employee_id', $employee->id)->first();
                if ($loan) {
                    LoanLog::factory()->create([
                        'employee_id' => $employee->id,
                        'loan_id' => $loan->id,
                        'payroll_id' => $payroll->id
                    ]);
                }
            }
        });
    }
}
