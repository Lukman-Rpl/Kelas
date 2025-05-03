<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Checkout</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border-radius: 10px;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
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

        .alert {
            background-color: #e3f2fd;
            padding: 15px;
            border-left: 5px solid #2196f3;
            margin-bottom: 20px;
            color: #0d47a1;
        }

        .btn-secondary {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
            margin-top: 30px;
        }

        .btn-secondary:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Daftar Barang yang Sudah di Checkout</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">Belum ada pesanan yang di-checkout.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->user->name ?? 'Tidak diketahui' }}</td>
                        <td>{{ $order->product->name ?? 'Produk tidak ditemukan' }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Tombol Kembali -->
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
</div>
</body>
</html>
