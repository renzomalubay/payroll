<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Guest routes (User shouldn't be logged in to see these)
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/', [AuthController::class, 'login']);
});

// Protected routes (User must be logged in)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function () {
        return view('pages.dashboard'); // This points to your Tailwind HTML file
    })->name('dashboard');
});
