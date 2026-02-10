<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    /** @use HasFactory<\Database\Factories\PayrollFactory> */
    use HasFactory;
    protected $fillable = ['code', 'month', 'date_start', 'date_end', 'status'];

    protected $casts = [
        'date_start' => 'date',
        'date_end' => 'date',
    ];
}
