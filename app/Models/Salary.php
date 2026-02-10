<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salary extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'type', 'rate', 'allowance', 'housing_allowance',
        'is_minimum_wager', 'divisor'
    ];

    protected $casts = [
        'is_minimum_wager' => 'boolean',
        'rate' => 'decimal:2',
        'allowance' => 'decimal:2',
        'housing_allowance' => 'decimal:2',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
