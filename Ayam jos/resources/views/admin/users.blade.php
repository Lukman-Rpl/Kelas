<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pengguna - Admin</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background: #f1f3f8;
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
        }

        .nav-links a:hover {
            color: #f1c40f;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            background: #fff;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        th, td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f0f0f0;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .action-buttons a {
            background-color: #2980b9;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .action-buttons a:hover {
            background-color: #2471a3;
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
        <h1>Daftar Pengguna</h1>

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td class="action-buttons">
                        <form action="{{ url('/admin/users/'.$user->id.'/delete') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" style="background-color: #e74c3c; color: white; border: none; padding: 8px 12px; cursor: pointer; border-radius: 5px;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
