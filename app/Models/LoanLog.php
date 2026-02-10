<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanLog extends Model
{
    /** @use HasFactory<\Database\Factories\LoanLogFactory> */
    use HasFactory;
        protected $fillable = [
        'employee_id', 'loan_id', 'payroll_id',
        'amount_deducted', 'remaining_balance'
    ];

    protected $casts = [
        'amount_deducted' => 'decimal:2',
        'remaining_balance' => 'decimal:2',
    ];
}
