<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat ke Admin</title>
    <style>
        body {
            font-family: Arial;
            background: #f8f8f8;
            padding: 40px;
        }
        .container {
            max-width: 500px;
            background: white;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        input, textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
        }
        button {
            background: #ff9f00;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            font-size: 16px;
        }
        .success {
            color: green;
        }

        .btn-secondary{
            background: greenyellow;
            font-style:none;
        }


    </style>
</head>
<body>
<div class="container">
    <h2>Kirim Pesan ke Admin</h2>

    @if(session('success'))
        <p class="success">{{ session('success') b}}</p>
    @endif

    <form action="{{ route('chat.send') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nama Anda" value="{{ old('name', Auth::user()->name ?? '') }}" required>
        <textarea name="message" rows="5" placeholder="Tulis pesan Anda di sini..." required></textarea>
        <button type="submit">Kirim Pesan</button>
        <button type="submit" class="btn-secondary">  <a href="{{ url('/') }}">Home</a></button>
    </form>

</div>
</body>
</html>
