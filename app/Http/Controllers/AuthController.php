<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    function index()
    {
        return view('pages.auth.login');
    }

    function register()
    {
        return view('pages.auth.register');
    }

    function authorizeUser(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->route('homepage')->with('success', 'Login successful');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
