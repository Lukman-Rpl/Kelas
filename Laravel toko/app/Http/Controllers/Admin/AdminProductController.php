<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product', compact('products'));
    }

    public function create()
{
    $products = Product::latest()->get(); // atau tambahkan where jika hanya sebagian
    return view('admin.products.create', compact('products'));
}

public function edit($id)
{
    $product = Product::findOrFail($id);
    $products = Product::latest()->get(); // untuk ditampilkan juga
    return view('admin.products.edit', compact('product', 'products'));
}

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image_url')) {
            $data['image_url'] = $request->file('image_url')->store('uploads', 'public');
        }

        Product::create($data);
        return redirect()->route('admin.product')->with('success', 'Produk berhasil ditambahkan.');
    }

   
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image_url')) {
            $data['image_url'] = $request->file('image_url')->store('uploads', 'public');
        }

        $product->update($data);
        return redirect()->route('admin.product')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('admin.product')->with('success', 'Produk berhasil dihapus.');
    }
}
