<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserAuthController extends Controller
{
    public function showLogin()
    {
        return view('login_user');
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'user' => $user->username,
                'email' => $user->email,
                'user_logged_in' => true,
            ]);
            return redirect()->route('home');
        }

        return back()->with('loginError', 'Username atau password salah!');
    }

    public function register(Request $request)
    {
        $request->validate([
            'reg_username' => 'required|unique:users,username',
            'reg_email' => 'required|email|unique:users,email',
            'reg_password' => 'required|min:3',
            'reg_confirm_password' => 'required|same:reg_password',
        ]);

        User::create([
            'username' => $request->reg_username,
            'email' => $request->reg_email,
            'password' => Hash::make($request->reg_password),
        ]);

        return back()->with('registerSuccess', 'Pendaftaran berhasil! Silakan login.');
    }

    public function logout()
    {
        session()->forget(['user', 'email', 'user_logged_in']);
        return redirect()->route('user.login');
    }
}
