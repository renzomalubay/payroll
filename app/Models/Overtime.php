<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    /** @use HasFactory<\Database\Factories\OvertimeFactory> */
    use HasFactory;

    protected $fillable = [
        'employee_id', 'payroll_id', 'overtime_hrs',
        'rate_per_hour', 'total_ot_pay', 'date_rendered', 'status'
    ];

    protected $casts = [
        'overtime_hrs' => 'decimal:2',
        'rate_per_hour' => 'decimal:2',
        'total_ot_pay' => 'decimal:2',
        'date_rendered' => 'date',
    ];
}
