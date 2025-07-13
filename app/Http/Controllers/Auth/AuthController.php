<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:users,username',
            'email'     => 'required|email|unique:users,email',
            'hp'        => 'required|string|max:20',
            'password'  => 'required|string|min:6|confirmed',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required'         => 'Nama wajib diisi.',
            'name.max'              => 'Nama maksimal :max karakter.',
            'username.required'     => 'Username wajib diisi.',
            'username.unique'       => 'Username sudah digunakan.',
            'username.max'          => 'Username maksimal :max karakter.',
            'email.required'        => 'Email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'email.unique'          => 'Email sudah terdaftar.',
            'hp.required'           => 'Nomor HP wajib diisi.',
            'hp.max'                => 'Nomor HP maksimal :max karakter.',
            'password.required'     => 'Kata sandi wajib diisi.',
            'password.min'          => 'Kata sandi minimal :min karakter.',
            'password.confirmed'    => 'Konfirmasi kata sandi tidak cocok.',
            'photo.image'           => 'Foto harus berupa gambar.',
            'photo.mimes'           => 'Format foto harus jpg, jpeg, png, atau webp.',
            'photo.max'             => 'Ukuran foto maksimal 2MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors'  => $validator->errors(),
            ], 422);
        }

        try {
            $validated = $validator->validated();
            $photoPath = null;

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos', 'public');
            }

            User::create([
                'name' => $validated['name'],
                'username' => $validated['username'],
                'email' => $validated['email'],
                'hp' => $validated['hp'],
                'password' => Hash::make($validated['password']),
                'photo' => $photoPath,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil!',
                'redirect' => route('login'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data.',
            ], 500);
        }
    }

    public function authorizeUser(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $user = User::where('username', $credentials['username'])->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Username tidak ditemukan']);
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return response()->json(['success' => false, 'message' => 'Password salah']);
        }

        auth()->login($user);

        return response()->json([
            'success' => true,
            'redirect' => route('homepage')
        ]);
    }

    function profile()
    {
        $active = 'profile';
        return view('pages.client.profile.profile', [
            'active' => $active
        ]);
    }

    function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
