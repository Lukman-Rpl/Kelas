<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Ayam Goreng Jos</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background: #f1f3f8;
        }
    
        nav {
            background-color: #2c3e50;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    
        nav .logo {
            font-size: 1.6em;
            font-weight: bold;
        }
    
        nav .nav-links a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
    
        nav .nav-links a:hover {
            color: #f1c40f;
        }
    
        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }
    
        h1 {
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 28px;
        }
    
        .card {
            background: #ffffff;
            padding: 25px 30px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
    
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }
    
        .card h3 {
            margin-top: 0;
            color: #34495e;
            margin-bottom: 10px;
        }
    
        .card p {
            font-size: 16px;
            color: #555;
            margin: 0;
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

    <div class="container">
        <h1>Selamat Datang di Dashboard Admin</h1>

        <div class="card">
            <h3>Total Pengguna</h3>
            <p>{{ $totalUsers }} pengguna terdaftar</p>
        </div>

        <div class="card">
            <h3>Total Pesanan</h3>
            <p>{{ $totalOrders }} pesanan masuk</p>
        </div>

        <div class="card">
            <h3>Total Menu</h3>
            <p>{{ $totalMenus }} menu tersedia</p>
        </div>
    </div>

</body>
</html>
