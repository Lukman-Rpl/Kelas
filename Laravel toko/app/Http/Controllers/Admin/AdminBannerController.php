<?php
namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminBannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $data['image'] = $request->file('image')->store('banners', 'public');
        Banner::create($data);

        return redirect()->route('admin.banner')->with('success', 'Banner berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        $banner->update($data);
        return redirect()->route('admin.banner')->with('success', 'Banner berhasil diperbarui.');
    }

    public function setActive($id)
{
    // Set semua banner menjadi tidak aktif
    DB::table('banners')->update(['is_active' => false]);

    // Set banner terpilih menjadi aktif
    $banner = Banner::findOrFail($id);
    $banner->is_active = true;
    $banner->save();

    return redirect()->back()->with('success', 'Banner berhasil diubah.');
}


    public function destroy($id)
    {
        Banner::destroy($id);
        return redirect()->route('admin.banner')->with('success', 'Banner berhasil dihapus.');
    }
}
