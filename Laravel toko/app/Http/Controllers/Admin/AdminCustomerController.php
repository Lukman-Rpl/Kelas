<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    // Menampilkan semua pengguna
    public function index()
    {
        // Mengambil semua pengguna
        $users = User::all();
        return view('admin.customers', compact('users')); // Mengirim data pengguna ke view
    }

    // Menghapus pengguna berdasarkan ID
    public function destroy($id)
    {
        // Mencari pengguna berdasarkan ID
        $user = User::findOrFail($id);
        // Menghapus pengguna
        $user->delete();
        // Redirect ke halaman daftar pengguna
        return redirect()->route('admin.customers')->with('success', 'Pengguna berhasil dihapus.');
    }
}
