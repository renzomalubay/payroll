<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollRun extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'period_start',
        'period_end',
        'gross_amount',
        'total_deductions',
        'net_amount',
        'paid_at',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
