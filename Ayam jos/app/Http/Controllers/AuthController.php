<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login'); // Tanpa folder 'auth'
    }

    // Menangani proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    // Menampilkan form register
    public function showRegisterForm()
    {
        return view('register'); // Tanpa folder 'auth'
    }

    // Menangani proses register
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'address'  => 'required|string|max:255'
        ]);

        // Simpan user baru
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'address'  => $request->address,
        ]);

        Auth::login($user);

        return redirect('login')->with('success', 'Registrasi berhasil!');
    }

    // Logout user
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Berhasil logout!');
    }
}
