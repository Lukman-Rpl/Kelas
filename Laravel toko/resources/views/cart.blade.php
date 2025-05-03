<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Retro DVD & VCD Store</title>
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
        }

        .cart-items {
            margin-top: 20px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .cart-item img {
            width: 120px;
            height: 60px;
            object-fit: cover;
        }

        .total {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .back-btn, .checkout-btn {
            background-color: var(--secondary-color);
            color: white;
            padding: 10px 20px;
            border: 2px solid #000;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 3px 3px 0px #000;
            margin-top: 20px;
            text-align: center;
            display: inline-block;
        }

        .back-btn:hover, .checkout-btn:hover {
            background: #b71c1c;
            transform: translateY(2px);
            box-shadow: 1px 1px 0px #000;
        }

        .remove-btn {
            background-color: #ff4d4d;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 2px 2px 0px #000;
            height: 20px;
            width: 50px;
            text-decoration: none;
        }

        .remove-btn:hover {
            background-color: #ff3333;
        }

        .instruction {
            margin-top: 20px;
            font-size: 16px;
            font-weight: normal;
            color: #333;
            background-color: #fff3cd;
            border: 1px solid #ffecb5;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Keranjang Belanja</h1>
        </header>

        @if($cartEmpty)
            <div class="instruction">
                Keranjang Anda kosong.
            </div>
        @else
            <div class="cart-items">
                @foreach($cartItems as $item)
                    <div class="cart-item">
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}">
                        <div>
                            <h4>{{ $item->title }}</h4>
                            <p>Jumlah: {{ $item->quantity }}</p>
                            <p>Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ route('cart.remove', $item->id) }}" class="remove-btn">Hapus</a>
                    </div>
                @endforeach
            </div>

            <div class="total">
                Total: Rp {{
                    number_format(
                        collect($cartItems)->sum(function($item) {
                            return $item->price * $item->quantity;
                        }),
                    0, ',', '.')
                }}
            </div>

            <div class="instruction">
                Jika ingin ambil silakan datang ke toko Luki, jika ingin dihantar silakan tekan tombol checkout.
            </div>
        @endif

        <form action="{{ url('/') }}" method="get">
            <button type="submit" class="back-btn">Kembali ke Beranda</button>
        </form>

        <form action="{{ route('checkout.index') }}" method="get">
            <button type="submit" class="checkout-btn">Checkout</button>
        </form>
    </div>
</body>
</html>
