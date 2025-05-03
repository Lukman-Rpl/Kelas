<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;

class AdminhomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.dashboard' , compact('products'));
    }
}
