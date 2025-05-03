<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ulasan - Retro DVD & VCD Store</title>
    <style>
        :root {
            --primary-color: #1a237e;
            --secondary-color: #c62828;
            --text-color: #333;
            --bg-color: #fafafa;
            --card-bg: #ffffff;
            --accent-color: #ffeb3b;
        }

        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
            border: 2px solid #000;
            box-shadow: 5px 5px 0px #000;
            margin-bottom: 30px;
        }

        .form-container {
            background-color: var(--card-bg);
            padding: 20px;
            border: 2px solid #000;
            box-shadow: 4px 4px 0px #000;
        }

        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        button {
            background-color: var(--secondary-color);
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 3px 3px 0px #000;
        }

        button:hover {
            background-color: #b71c1c;
            transform: translateY(2px);
            box-shadow: 1px 1px 0px #000;
        }

        .back-btn {
            background-color: #ff6b6b;
            color: white;
            padding: 10px 20px;
            border: 2px solid #000;
            cursor: pointer;
            font-family: "Courier New", Courier, monospace;
            font-weight: bold;
            box-shadow: 3px 3px 0px #000;
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
        }

        .back-btn:hover {
            background: #ff5252;
            transform: translateY(2px);
            box-shadow: 1px 1px 0px #000;
        }

        .success-message,
        .error-message {
            padding: 1rem;
            margin-bottom: 1rem;
            border: 2px solid #000;
            box-shadow: 3px 3px 0px #000;
        }

        .rating {
    direction: rtl;
    unicode-bidi: bidi-override;
    display: flex;
    justify-content: start;
    gap: 5px;
    margin: 10px 0;
}

.rating input {
    display: none;
}

.rating label {
    font-size: 2rem;
    color: #ccc;
    cursor: pointer;
    transition: color 0.2s;
}

.rating input:checked ~ label,
.rating label:hover,
.rating label:hover ~ label {
    color: var(--secondary-color);
}


        .success-message {
            background-color: #90EE90;
        }

        .error-message {
            background-color: #FFB6C1;
        }

        footer {
            background: var(--primary-color);
            color: white;
            text-align: center;
            padding: 1rem;
            margin-top: 3rem;
            border-top: 2px solid #000;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="header">
            <h1>📝 ULASAN PELANGGAN 📝</h1>
            <p>Bagikan pengalaman Anda bersama kami!</p>
        </div>

        <div class="form-container">
            @if(session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('ulasan.store') }}">
                @csrf
                <div>
                    <label for="name">📋 Nama:</label>
                    <input type="text" name="name" id="name" value="{{ session('user') }}" readonly>
                </div>
                <div>
                    <label for="email">📧 Email:</label>
                    <input type="email" name="email" id="email" value="{{ session('email') }}" required>
                </div>
                <div>
                    <label for="rating">⭐ Rating:</label>
                    <div class="rating">
                        <input type="radio" name="rating" id="star5" value="5"><label for="star5" title="5 stars">★</label>
                        <input type="radio" name="rating" id="star4" value="4"><label for="star4" title="4 stars">★</label>
                        <input type="radio" name="rating" id="star3" value="3"><label for="star3" title="3 stars">★</label>
                        <input type="radio" name="rating" id="star2" value="2"><label for="star2" title="2 stars">★</label>
                        <input type="radio" name="rating" id="star1" value="1"><label for="star1" title="1 star">★</label>
                    </div>
                </div>
                
                <div>
                    <label for="message">💭 Pesan Ulasan:</label>
                    <textarea name="message" id="message" required></textarea>
                </div>
                <button type="submit">📤 Kirim Ulasan</button>
            </form>
        </div>

        <a href="{{ route('home') }}" class="back-btn">🏠 Kembali ke Beranda</a>

        <footer>
            <p>&copy; 2025 Retro DVD & VCD Store. Semua hak dilindungi.</p>
        </footer>
    </div>
</body>
</html>
