<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Retro DVD & VCD Store</title>

    <style>
        :root {
            --primary-color: #1a237e;
            --secondary-color: #c62828;
            --text-color: #333;
            --bg-color: #fafafa;
            --card-bg: #ffffff;
            --accent-color: gold;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, var(--primary-color), #303f9f);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
            text-align: center;
        }

        .header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border: 2px solid #000;
            box-shadow: 4px 4px 0px #000;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background: var(--secondary-color);
            color: white;
            border: none;
            font-weight: bold;
            box-shadow: 3px 3px 0px #000;
            cursor: pointer;
        }

        .form-container button:hover {
            background: #b71c1c;
            transform: translateY(2px);
            box-shadow: 1px 1px 0px #000;
        }

        .back-home {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background: var(--primary-color);
            color: white;
            text-align: center;
            font-weight: bold;
            box-shadow: 3px 3px 0px #000;
            text-decoration: none;
        }

        .toggle-register {
            display: inline-block;
            margin-top: 10px;
            cursor: pointer;
            color: #007bff;
            text-decoration: underline;
            text-align: center;
        }
    </style>

    <script>
        function toggleForm() {
            let loginForm = document.getElementById('login-form');
            let registerForm = document.getElementById('register-form');
            loginForm.style.display = loginForm.style.display === 'none' ? 'block' : 'none';
            registerForm.style.display = registerForm.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>🎬 RETRO DVD & VCD STORE 📀</h1>
            <p>Koleksi Film Klasik Terlengkap!</p>
        </header>

        <div class="form-container">
            {{-- Login Form --}}
            <div id="login-form" style="display: {{ session('registerSuccess') ? 'none' : 'block' }}">
                <h2>Login</h2>
                <form method="POST" action="{{ route('user.login') }}">
                    @csrf
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" name="login">Login</button>
                </form>
                @if(session('loginError'))
                    <p>{{ session('loginError') }}</p>
                @endif
                <p class="toggle-register" onclick="toggleForm()">Belum punya akun? Daftar di sini</p>
            </div>

            {{-- Register Form --}}
            <div id="register-form" style="display: {{ session('registerSuccess') ? 'block' : 'none' }}">
                <h2>Register</h2>
                <form method="POST" action="{{ route('user.register') }}">
                    @csrf
                    <input type="text" name="reg_username" placeholder="Username" required>
                    <input type="email" name="reg_email" placeholder="Email" required>
                    <input type="password" name="reg_password" placeholder="Password" required>
                    <input type="password" name="reg_confirm_password" placeholder="Konfirmasi Password" required>
                    <button type="submit" name="register">Register</button>
                </form>
                @error('reg_username') <p>{{ $message }}</p> @enderror
                @error('reg_email') <p>{{ $message }}</p> @enderror
                @error('reg_password') <p>{{ $message }}</p> @enderror
                @if(session('registerError')) <p>{{ session('registerError') }}</p> @endif
                @if(session('registerSuccess')) <p>{{ session('registerSuccess') }}</p> @endif
                <p class="toggle-register" onclick="toggleForm()">Sudah punya akun? Login di sini</p>
            </div>
        </div>

        <a href="{{ route('home') }}" class="back-home">Kembali ke Beranda</a>
    </div>
</body>
</html>
