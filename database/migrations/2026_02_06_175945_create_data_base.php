<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('role_type', ['hr', 'employee']);
            $table->timestamps();
        });

        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // Monthly, Daily
            $table->decimal('rate', 15, 2);
            $table->decimal('allowance', 15, 2)->default(0);
            $table->decimal('housing_allowance', 15, 2)->default(0);
            $table->boolean('is_minimum_wager')->default(false);
            $table->integer('divisor')->default(22); // Days per month
            $table->timestamps();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('ext_name')->nullable();
            $table->string('position');
            $table->string('sss_no')->nullable();
            $table->string('hdmf_no')->nullable(); // Pag-ibig is HDMF
            $table->string('bank_account_number')->nullable();
            $table->enum('employment_type', ['regular', 'probationary']);
            $table->decimal('leave_credit', 8, 2)->default(0);
            $table->foreignId('department_id')->constrained();
            $table->foreignId('branch_id')->constrained();
            $table->foreignId('salary_id')->constrained();
            $table->timestamps();
        });

        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->foreignId('shift_id')->constrained();
            $table->string('work_days'); // Store as JSON or comma-separated
            $table->timestamps();
        });

        Schema::create('timekeep_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->foreignId('schedule_id')->constrained();
            $table->dateTime('time_in');
            $table->dateTime('time_out')->nullable();
            $table->timestamps();
        });

        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('month');
            $table->date('date_start');
            $table->date('date_end');
            $table->string('status'); // Draft, Processed, Released
            $table->timestamps();
        });

        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->string('loan_name');
            $table->decimal('total_amount', 15, 2);
            $table->decimal('monthly_deduction', 15, 2);
            $table->decimal('balance', 15, 2);
            $table->timestamps();
        });

        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->foreignId('leave_type_id')->constrained();
            $table->date('start_date');
            $table->date('end_date');
            $table->date('return_date')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });

        Schema::create('tax_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., De Minimis, Taxable Bonus, Non-Taxable
            $table->boolean('is_taxable')->default(true);
            $table->timestamps();
        });

        Schema::create('other_incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->foreignId('tax_category_id')->constrained();
            $table->string('code'); // e.g., MEAL_ALW, PERA
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('amount', 15, 2);
            $table->boolean('is_recurring')->default(false); // Useful for monthly vs one-time
            $table->timestamps();
        });

        Schema::create('overtimes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->foreignId('payroll_id')->nullable()->constrained(); // Links to a specific pay run
            $table->decimal('overtime_hrs', 8, 2);
            $table->decimal('rate_per_hour', 15, 2); // Captured at time of OT
            $table->decimal('total_ot_pay', 15, 2);
            $table->date('date_rendered');
            $table->string('status')->default('pending'); // pending, approved, paid
            $table->timestamps();
        });

        Schema::create('deductions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->foreignId('payroll_id')->constrained();
            $table->decimal('absent_deduction', 15, 2)->default(0);
            $table->decimal('late_deduction', 15, 2)->default(0);
            $table->decimal('loan_deduction', 15, 2)->default(0); // Sum of loans for this period
            $table->decimal('statutory_sss', 15, 2)->default(0);
            $table->decimal('statutory_philhealth', 15, 2)->default(0);
            $table->decimal('statutory_hdmf', 15, 2)->default(0);
            $table->decimal('total_deductions', 15, 2);
            $table->timestamps();
        });

        Schema::create('loan_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->foreignId('loan_id')->constrained();
            $table->foreignId('payroll_id')->constrained();
            $table->decimal('amount_deducted', 15, 2);
            $table->decimal('remaining_balance', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('branches');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('payrolls');
        Schema::dropIfExists('loans');
        Schema::dropIfExists('leaves');
        Schema::dropIfExists('tax_categories');
        Schema::dropIfExists('other_incomes');
        Schema::dropIfExists('overtimes');
        Schema::dropIfExists('deductions');
        Schema::dropIfExists('loan_logs');
    }
};
