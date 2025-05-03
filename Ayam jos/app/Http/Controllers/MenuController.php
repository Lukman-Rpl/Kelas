<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    // Menampilkan daftar menu di halaman utama
    public function index()
    {
        $menus = Menu::all();  // Mengambil semua data menu
        return view('home', compact('menus'));  // Mengirim data menu ke view home
    }

    public function create()
    {
        return view('menu.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Menyimpan file gambar ke folder public/images
        $imagePath = $request->file('image')->store('images', 'public');

        // Menyimpan data menu ke database
        Menu::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath, // Menyimpan path gambar
        ]);

        return redirect()->route('menus.index');
    }

    public function show($id)
    {
        $menu = Menu::find($id);
        return view('menu.show', compact('menu'));
    }
    // --- ADMIN AREA --- //

public function adminIndex()
{
    $menus = Menu::all();
    return view('admin.menus', compact('menus'));
}

public function adminEdit($id)
{
    $menu = Menu::findOrFail($id);
    $menus = Menu::all();
    return view('admin.menus', compact('menu', 'menus'));
}

public function adminUpdate(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'description' => 'required',
        'image_url' => 'nullable|string',
    ]);

    $menu = Menu::findOrFail($id);
    $menu->update([
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'image_url' => $request->image_url,
    ]);

    return redirect()->route('admin.menus')->with('success', 'Menu berhasil diperbarui!');
}

public function adminDestroy($id)
{
    Menu::destroy($id);
    return redirect()->route('admin.menus')->with('success', 'Menu berhasil dihapus!');
}

public function adminStore(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'description' => 'required',
        'image_url' => 'nullable|string',
    ]);

    Menu::create([
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'image_url' => $request->image_url,
    ]);

    return redirect()->route('admin.menus')->with('success', 'Menu berhasil ditambahkan!');
}

}
