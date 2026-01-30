<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserManage;

class StaffLoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.staff_login'); // create this blade file
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        // Use the 'web' guard (or create a 'staff' guard if you want separation)
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->intended('/staff/dashboard'); // your staff dashboard route
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    // Optional: logout
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/staff/login');
    }
}
