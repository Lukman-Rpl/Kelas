<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        $cartItems = [];

        if (empty($cart)) {
            return view('cart', ['cartItems' => [], 'cartEmpty' => true]);
        }

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $product->quantity = $quantity;
                $cartItems[] = $product;
            }
        }

        return view('cart', ['cartItems' => $cartItems, 'cartEmpty' => false]);
    }

    public function addToCart(Request $request)
{
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity', 1);

    $product = Product::findOrFail($productId);

    // Simpan ke session
    $cart = session()->get('cart', []);
    $cart[$productId] = ($cart[$productId] ?? 0) + $quantity;
    session()->put('cart', $cart);

    // Simpan ke tabel `cart`
    $userId = Auth::id();
    $existing = Cart::where('user_id', $userId)
        ->where('product_id', $productId)
        ->first();

    if ($existing) {
        $existing->quantity += $quantity;
        $existing->save();
    } else {
        Cart::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);
    }

    return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
}

public function checkout()
{
    $userId = Auth::id();

    $cartItems = Cart::where('user_id', $userId)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
    }

    foreach ($cartItems as $item) {
        Order::create([
            'user_id' => $userId,
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'status' => 'pending', // atau sesuai sistemmu
        ]);
    }

    // Hapus cart di DB & session
    Cart::where('user_id', $userId)->delete();
    session()->forget('cart');

    return redirect()->route('home')->with('success', 'Checkout berhasil!');
}



    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }
}
