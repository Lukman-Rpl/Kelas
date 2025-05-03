<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('menu')->get();
        return view('order', compact('orders'));
    }
    
    
    // Menghapus pesanan dari keranjang
    public function removeFromCart($id)
    {
        $orders = session()->get('cart', []);

        // Menghapus pesanan berdasarkan ID
        foreach ($orders as $key => $order) {
            if ($order['id'] == $id) {
                unset($orders[$key]);
            }
        }

        session()->put('cart', $orders);  // Menyimpan kembali keranjang ke session
        return redirect()->route('order.index');
    }

    public function addToCart(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $menuId = $request->input('menu_id');
    $menu = Menu::find($menuId);

    if (!$menu) {
        return redirect()->route('home')->with('error', 'Menu tidak ditemukan!');
    }

    $cart = session()->get('cart', []);

    foreach ($cart as &$item) {
        if ($item['id'] == $menu->id) {
            $item['quantity'] += 1;
            session()->put('cart', $cart);
            return redirect()->route('order.index')->with('success', 'Jumlah menu diperbarui!');
        }
    }

    // Tambah item baru
    $cart[] = [
        'id' => $menu->id,
        'name' => $menu->name,
        'price' => $menu->price,
        'description' => $menu->description,
        'quantity' => 1,
    ];

    session()->put('cart', $cart);

    return redirect()->route('order.index')->with('success', 'Menu berhasil ditambahkan ke keranjang!');
}
public function checkout()
{
    $cart = session()->get('cart', []);
    
    if (empty($cart)) {
        return redirect()->route('order.index')->with('error', 'Keranjang Anda kosong.');
    }

    $user = Auth::user();

    foreach ($cart as $item) {
        $order = new Order();
        $order->menu_id = $item['id'];
        $order->customer_name = $user->name;
        $order->customer_address = $user->address ?? 'Alamat tidak tersedia';
        $order->order_details = "Pesanan: {$item['name']} x {$item['quantity']}";
        $order->save();
    }

    // Kosongkan keranjang
    session()->forget('cart');

    return redirect()->route('home')->with('success', 'Pesanan Anda sedang diproses dan akan segera sampai.');
}

public function adminindex()
    {
        $orders = Order::with('menu')->latest()->get(); // ambil data order beserta menu
        return view('admin.Cekorder', compact('orders'));
    }
    
}

