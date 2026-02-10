<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimekeepLog extends Model
{
    /** @use HasFactory<\Database\Factories\TimekeepLogFactory> */
    use HasFactory;
    protected $fillable = ['employee_id', 'schedule_id', 'time_in', 'time_out'];

    protected $casts = [
        'time_in' => 'datetime',
        'time_out' => 'datetime',
    ];
}
