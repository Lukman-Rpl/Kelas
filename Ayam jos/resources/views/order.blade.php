<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>
    <style>
        /* Styling untuk halaman */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        
        .container {
            margin: 20px auto;
            width: 80%;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .checkout-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
        }

        .checkout-btn:hover {
            background-color: #45a049;
        }

        /* Styling navbar */
        nav {
            background-color: #ff9f00; /* Ayam Goreng Jos primary color */
            padding: 10px 0;
        }

        nav .container-nav {
            width: 80%;
            margin: 0 auto;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            margin-right: 20px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        nav span {
            color: white;
            font-size: 18px;
            margin-right: 20px;
        }

    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="container-nav">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/chat') }}">Chat</a>
            <a href="{{ url('/order') }}">Order</a>
            @guest
                <a href="{{ url('/login') }}">Login</a>
                <a href="{{ url('/register') }}">Register</a>
            @endguest
            @auth
                <span>Hello, {{ Auth::user()->name }}</span>
                <a href="{{ route('logout') }}">Logout</a>
            @endauth
        </div>
    </nav>

    <!-- Konten Halaman -->
    <div class="container">
        <h2>Daftar Pesanan</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order['name'] }}</td>
                    <td>Rp {{ number_format($order['price'], 0, ',', '.') }}</td>
                    <td>{{ $order['description'] }}</td>
                </tr>
            @endforeach            
            </tbody>
        </table>

        <!-- Tombol Checkout -->
        <a href="{{ route('order.checkout') }}" class="checkout-btn">Checkout</a>
    </div>
</body>
</html>
