<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
    public function index()
    {
        if (!Session::has('user')) {
            return redirect()->route('user.login')->with('error', 'Silakan login untuk menulis ulasan.');
        }
        $ulasan = Ulasan::latest()->paginate(5); // Ganti 5 dengan jumlah yang mau ditampilkan per halaman
        return view('home', compact('ulasan'));
    }

   public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'message' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    Ulasan::create([
        'name' => session('user'),
        'email' => $request->email,
        'message' => $request->message,
        'rating' => $request->rating,
    ]);

    
    $name = Session::get('user');
    $email = $request->email;
    $message = $request->message;

    $emailParts = explode('@', $email);
    $maskedEmail = substr($emailParts[0], 0, 3) . '***@' . $emailParts[1];

    $review = "Nama: $name\nEmail: $maskedEmail\nPesan: $message\nWaktu: " . now()->format('Y-m-d H:i:s') . "\n\n";

    File::append(storage_path('app/reviews.txt'), $review);


    return redirect()->back()->with('success', 'Ulasan berhasil dikirim!');
}

}
