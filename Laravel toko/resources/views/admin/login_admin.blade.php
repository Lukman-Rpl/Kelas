<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Retro DVD & VCD</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #fafafa;
        }

        .container {
            max-width: 400px;
            margin: 60px auto;
            background: white;
            border: 2px solid #000;
            padding: 20px;
            box-shadow: 5px 5px 0px #000;
        }

        h2 {
            text-align: center;
            color: #1a237e;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 12px 0;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            background: #c62828;
            color: white;
            padding: 10px;
            border: none;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 3px 3px 0px #000;
        }

        button:hover {
            background: #b71c1c;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        @if(session('loginError'))
            <p class="error">{{ session('loginError') }}</p>
        @endif
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a href="{{ route('home') }}" class="back-link">← Kembali ke Beranda</a>
    </div>
</body>
</html>
