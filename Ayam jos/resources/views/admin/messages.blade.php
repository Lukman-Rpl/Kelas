<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Balas Pesan - Admin</title>
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

        form {
            display: flex;
            flex-direction: column;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin: 10px 0;
            font-size: 14px;
        }

        button {
            background-color: #2980b9;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            align-self: flex-start;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2471a3;
        }

        .already-replied {
            color: #27ae60;
            font-weight: bold;
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
        <h1>Daftar Pesan Masuk</h1>

        <table>
            <thead>
                <tr>
                    <th>Nama User</th>
                    <th>Pesan</th>
                    <th>Balasan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $msg)
                <tr>
                    <td>{{ $msg->user->name }}</td>
                    <td>{{ $msg->message }}</td>
                    <td>{{ $msg->reply ?? '-' }}</td>
                    <td>
                        @if(!$msg->reply)
                            <form action="{{ url('/admin/messages/'.$msg->id.'/reply') }}" method="POST">
                                @csrf
                                <textarea name="reply" placeholder="Tulis balasan..." required></textarea>
                                <button type="submit">Balas</button>
                            </form>
                        @else
                            <span class="already-replied">Sudah dibalas</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
