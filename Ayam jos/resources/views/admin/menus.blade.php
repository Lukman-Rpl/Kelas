<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Menu - Admin</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f3f8;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #2c3e50;
            padding: 15px 30px;
            color: white;
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
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h1, h3 {
            color: #2c3e50;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        form {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            margin-bottom: 40px;
        }

        input, textarea {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            padding: 10px 18px;
            background-color: #2980b9;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2471a3;
        }

        .btn-danger {
            background-color: #e74c3c;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        img {
            max-height: 60px;
            border-radius: 6px;
        }

        .action-links a {
            color: #2980b9;
            margin-right: 10px;
            text-decoration: none;
            font-weight: bold;
        }

        .action-links form {
            display: inline;
        }
    </style>
</head>
<body>

    <nav>
        <div class="logo">Admin - Ayam Goreng Jos</div>
        <div class="nav-links">
            <a href="{{ url('/admin/home') }}">Home</a>
            <a href="{{ url('/admin/messages') }}">Balas Pesan</a>
            <a href="{{ url('/admin/users') }}">Lihat Pengguna</a>
            <a href="{{ url('/admin/menus') }}">Lihat Menu</a>
            <a href="{{ url('/admin/cekorder') }}">Cek Pesanan</a>
        </div>
    </nav>

    <div class="container">
        <h1>Manajemen Menu</h1>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <h3>{{ isset($menu) ? 'Edit Menu' : 'Tambah Menu Baru' }}</h3>
        <form action="{{ isset($menu) ? url('/admin/menus/'.$menu->id.'/update') : url('/admin/menus') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Nama menu" value="{{ $menu->name ?? '' }}" required>
            <textarea name="description" placeholder="Deskripsi">{{ $menu->description ?? '' }}</textarea>
            <input type="number" name="price" step="100" placeholder="Harga" value="{{ $menu->price ?? '' }}" required>
            <input type="file" name="image_url">
            <button type="submit">{{ isset($menu) ? 'Update' : 'Tambah' }}</button>
        </form>

        <h3>Daftar Menu</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>
                        @if($item->image_url)
                            <img src="{{ asset($item->image_url) }}" alt="gambar menu">
                        @else
                            Tidak ada
                        @endif
                    </td>
                    <td class="action-links">
                        <a href="{{ url('/admin/menus/'.$item->id.'/edit') }}">Edit</a>
                        <form action="{{ url('/admin/menus/'.$item->id.'/delete') }}" method="POST" onsubmit="return confirm('Yakin ingin hapus menu ini?')">
                            @csrf
                            <button class="btn-danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
