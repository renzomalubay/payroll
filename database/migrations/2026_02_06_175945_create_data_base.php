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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique(); // e.g., 'ENG', 'HR'
            $table->timestamps();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->date('hire_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->decimal('base_salary', 12, 2); // Handles up to 999,999,999.99
            $table->enum('pay_cycle', ['weekly', 'bi-weekly', 'monthly'])->default('monthly');
            $table->timestamps();
        });

        Schema::create('deductions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('name'); // e.g., 'Health Insurance'
            $table->decimal('amount', 10, 2);
            $table->enum('type', ['fixed', 'percentage']);
            $table->timestamps();
        });

        Schema::create('payroll_runs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->date('period_start');
            $table->date('period_end');
            $table->decimal('gross_amount', 12, 2);
            $table->decimal('total_deductions', 12, 2);
            $table->decimal('net_amount', 12, 2);
            $table->timestamp('paid_at')->nullable();
            $table->string('status')->default('draft'); // draft, processed, paid
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('salaries');
        Schema::dropIfExists('deductions');
        Schema::dropIfExists('payroll_runs');
    }
};
