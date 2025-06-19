<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

    public function registerStore(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'hp'        => 'required|string|max:20',
            'password'  => 'required|string|min:6|confirmed',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        try {
            $photoPath = null;

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos', 'public');
            }

            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'hp' => $validated['hp'],
                'password' => Hash::make($validated['password']),
                'photo' => $photoPath,
            ]);

            Session::flash('success', 'Pendaftaran berhasil! Silakan login.');
            return redirect()->route('login');
        } catch (\Exception $e) {
            Session::flash('error', 'Pendaftaran gagal. Silakan coba lagi.');
            return back()->withInput();
        }
    }

    public function authorizeUser(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return response()->json([
                'success' => true,
                'redirect' => route('homepage')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah.'
        ], 401);
    }

    function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
