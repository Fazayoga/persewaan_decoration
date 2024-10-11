<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('admin.auth-login');
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
        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Login berhasil!');
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
        return view('admin.auth-register');
    }

    /**
     * Menangani proses register
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username',
            'email' => 'required|string|email|max:255|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Membuat user baru
        $admin = Admin::create([
            'name' => $request->name,
            'username' => $request->username, 
            'email' => $request->email,
            'password' => $request->password, 
            'user_type' => 'admin', 
        ]);

        // Login otomatis setelah register
        Auth::guard('admin')->login($admin);

        return redirect()->route('index')->with('success', 'Register berhasil dan login otomatis!');
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('index')->with('success', 'Logout berhasil!');
    }
}
