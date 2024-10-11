<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('user.auth-login');
    }

    /**
     * Menangani proses login
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Tentukan apakah 'login' adalah email atau username
        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Atur kredensial
        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];

        // Coba autentikasi
        if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('')->with('success', 'Login berhasil!');
        }

        // Jika autentikasi gagal
        return back()->withErrors([
            'login_error' => 'Email/Username atau password salah.',
        ])->onlyInput('login');
    }

    /**
     * Menampilkan halaman register
     */
    public function showRegisterForm()
    {
        return view('user.auth-register');
    }

    /**
     * Menangani proses register
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Membuat user baru
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username, 
            'email' => $request->email,
            'password' => $request->password, 
            'user_type' => 'user', 
        ]);

        // Login otomatis setelah register
        Auth::guard('web')->login($user);

        return redirect()->route('home')->with('success', 'Register berhasil dan login otomatis!');
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logout berhasil!');
    }
}
