<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Admin;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }
    
    public function login(Request $request)
    {
        $admin = Admin::where('username', $request->username)->first();
    
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'Login gagal. Username atau password salah.');
        }
    
        // Simpan ke session
        session(['admin_id' => $admin->id]);
    
        // Redirect ke dashboard admin
        return redirect()->route('admin.home');
    }
    
    public function home()
    {
        if (!session()->has('admin_id')) {
            return redirect('/admin/login')->with('error', 'Silakan login terlebih dahulu.');
        }
    
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalMenus = Menu::count();
    
        return view('admin.home', compact('totalUsers', 'totalOrders', 'totalMenus'));
    }

    public function listUsers()
{
    $users = User::all();
    return view('admin.users', compact('users'));
}

public function listMenus()
{
    $menus = Menu::all();
    return view('admin.menus', compact('menus'));
}

    
}
