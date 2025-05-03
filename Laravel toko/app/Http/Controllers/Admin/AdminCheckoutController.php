<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCheckoutController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'product'])->orderBy('created_at', 'desc')->get();
        return view('admin.checkoutlist', compact('orders'));
    }
}
