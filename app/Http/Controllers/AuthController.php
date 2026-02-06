<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Display the login view.
     */
    public function showLogin()
    {
        
        return view('pages.login'); // This points to your Tailwind HTML file
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        // 1. Validate the input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Attempt to log the user in
        // The 'remember' field is optional, usually a checkbox in your UI
        if (Auth::attempt($credentials, $request->remember)) {

            // 3. Regenerate session to prevent fixation attacks
            $request->session()->regenerate();

            // 4. Redirect to intended page or dashboard
            return redirect()->intended('dashboard');
        }

        // 5. If login fails, throw a validation error
        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
