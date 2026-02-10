<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'middle_name', 'ext_name',
        'birth_date', 'contact_number', 'address', 'position',
        'employment_type', 'start_date', 'leave_credit', 'sss_no',
        'hdmf_no', 'philhealth_no', 'bank_account_number',
        'department_id', 'branch_id', 'salary_id'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'start_date' => 'date',
        'leave_credit' => 'decimal:2',
    ];

    public function department()
    {
        return $this->hasOne(Department::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function salaries()
    {
        return $this->hasOne(Salary::class);
    }

    public function branch()
    {
        return $this->hasOne(Branch::class);
    }

    public function otherIncomes()
    {
        return $this->hasMany(OtherIncome::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function schedules()
    {
        return $this->belongsTo(Schedule::class);
    }
}
