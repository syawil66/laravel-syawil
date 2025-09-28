<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showlogin()
    {
        return view("auth.login");
    }

    public function showregister()
    {
        return view("auth.register");
    }

    public function processLogin(Request $request)
    {
        // 1. Validasi input: email dan password wajib diisi.
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Mencoba untuk login.
        // Auth::attempt() akan otomatis mengecek email dan hash password.
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 3. Jika berhasil, redirect ke dashboard.
            return redirect()->intended('/dashboard');
        }

        // 4. Jika gagal, kembali ke halaman login dengan pesan error.
        return back()->withErrors([
            'email' => 'Email atau Password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }


     public function processRegister(Request $request)
    {
        // 1. Validasi input.
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);

        // 2. Membuat user baru di database.
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Langsung login-kan user yang baru mendaftar.
        Auth::login($user);

        // 4. Redirect ke dashboard.
        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
