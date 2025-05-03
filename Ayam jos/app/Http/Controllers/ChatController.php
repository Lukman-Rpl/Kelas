<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
{
    $messages = Message::with('user')->get();
    return view('admin.messages', compact('messages'));
}
    public function show()
{
    return view('chat');
}

public function send(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'message' => 'required|string',
    ]);

    $msg = new Message();
    $msg->name = $request->name;
    $msg->email = Auth::check() ? Auth::user()->email : null;
    $msg->user_id = Auth::id();
    $msg->message = $request->message;
    $msg->save();

    return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
}

public function reply(Request $request, $id)
{
    $message = \App\Models\Message::findOrFail($id);
    $message->reply = $request->reply;
    $message->replied_at = now();
    $message->save();

    return redirect('/admin/messages')->with('success', 'Pesan berhasil dibalas');
}
}
