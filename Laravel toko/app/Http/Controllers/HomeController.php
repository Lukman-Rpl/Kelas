<?php
namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request)
{
    $products = Product::all();
    $totalItems = collect(Session::get('cart', []))->sum();
    $ulasan = Ulasan::latest()->paginate(5); // Ganti 5 dengan jumlah yang mau ditampilkan per halaman
    
    return view('home', compact('products', 'totalItems', 'ulasan'));
}


public function addToCart(Request $request)
{
    if (!Session::has('user')) {
        return redirect('/login');
    }

    $productId = $request->input('product_id');
    $product = Product::find($productId);

    if (!$product || $product->stock <= 0) {
        return redirect()->back()->with('error', 'Product is out of stock!');
    }

    $cart = Session::get('cart', []);
    $cart[$productId] = isset($cart[$productId]) ? $cart[$productId] + 1 : 1;

    // Optional: Batasi jumlah di cart tidak melebihi stock
    if ($cart[$productId] > $product->stock) {
        $cart[$productId] = $product->stock;
    }

    Session::put('cart', $cart);

    return redirect()->back()->with('success', 'Product added to cart!');
}
}
