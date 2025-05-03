<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login_admin');
    }

    public function login(Request $request)
    {
        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session([
                'admin' => $admin->username,
                'admin_logged_in' => true,
            ]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('loginError', 'Username atau password salah!');
    }

    public function logout()
    {
        session()->forget(['admin', 'admin_logged_in']);
        return redirect()->route('admin.login');
    }
}
