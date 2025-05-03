<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan | Admin</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f3f8;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #2c3e50;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #f1c40f;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #f0f0f0;
            color: #333;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- ✅ Navbar -->
    <nav>
        <div class="logo">Admin - Ayam Goreng Jos</div>
        <div class="nav-links">
            <a href="{{ url('/admin/messages') }}">Balas Pesan</a>
            <a href="{{ url('/admin/users') }}">Lihat Pengguna</a>
            <a href="{{ url('/admin/menus') }}">Lihat Menu</a>
            <a href="{{ url('/admin/cekorder') }}">Cek Pesanan</a>
        </div>
    </nav>

    <!-- ✅ Container Pesanan -->
    <div class="container">
        <h2>Daftar Pesanan</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Customer</th>
                    <th>Alamat</th>
                    <th>Detail Pesanan</th>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    @php
                        // Ekstrak jumlah dari order_details, default ke 1
                        preg_match('/x\s?(\d+)/', $order->order_details, $matches);
                        $quantity = isset($matches[1]) ? (int) $matches[1] : 1;
                        $price = $order->menu->price ?? 0;
                        $total = $quantity * $price;
                    @endphp
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->customer_address }}</td>
                        <td>{{ $order->order_details }}</td>
                        <td>{{ $order->menu->name ?? '-' }}</td>
                        <td>Rp {{ number_format($price, 0, ',', '.') }}</td>
                        <td>{{ $quantity }}</td>
                        <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                        <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>
