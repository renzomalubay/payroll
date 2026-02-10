<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'payroll_id', 'absent_deduction', 'late_deduction',
        'loan_deduction', 'statutory_sss', 'statutory_philhealth',
        'statutory_hdmf', 'total_deductions'
    ];

    protected $casts = [
        'absent_deduction' => 'decimal:2',
        'late_deduction' => 'decimal:2',
        'loan_deduction' => 'decimal:2',
        'statutory_sss' => 'decimal:2',
        'statutory_philhealth' => 'decimal:2',
        'statutory_hdmf' => 'decimal:2',
        'total_deductions' => 'decimal:2'
        // You can add others here for consistent math
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
