<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_employee = Employee::count();
        $is_active_employee = Employee::where('is_active', true)->count();
        return view('pages.dashboard', compact('total_employee', 'is_active_employee'));
    }
}
