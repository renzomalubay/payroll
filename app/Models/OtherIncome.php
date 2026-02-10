<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherIncome extends Model
{
    /** @use HasFactory<\Database\Factories\OtherIncomeFactory> */
    use HasFactory;

    protected $fillable = [
        'employee_id', 'tax_category_id', 'code', 'name',
        'description', 'amount', 'is_recurring'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'is_recurring' => 'boolean'
    ];
}
