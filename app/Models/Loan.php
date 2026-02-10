<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    /** @use HasFactory<\Database\Factories\LoanFactory> */
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'employee_id', 'loan_name', 'total_amount',
        'monthly_deduction', 'balance'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'monthly_deduction' => 'decimal:2',
        'balance' => 'decimal:2',
    ];
}
