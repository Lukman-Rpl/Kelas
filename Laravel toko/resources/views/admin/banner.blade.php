<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ isset($banner) ? 'Edit Banner' : 'Tambah Banner' }}</title>
    <style>
        :root {
            --primary-color: #1a237e;
            --secondary-color: #c62828;
            --text-color: #333;
            --bg-color: #fafafa;
            --card-bg: #ffffff;
            --accent-color: #ffeb3b;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

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

        .form-container {
            background-color: var(--card-bg);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 0.5rem;
        }

        input[type="file"] {
            padding: 0.5rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            width: 100%;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            color: white;
            box-shadow: 3px 3px 0px #000;
        }

        .btn-primary:hover {
            background-color: #b71c1c;
            transform: translateY(2px);
            box-shadow: 1px 1px 0px #000;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            margin-left: 10px;
        }

        .btn-secondary:hover {
            background-color: #495057;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #000;
            margin-top: 10px;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        table {
            width: 100%;
            margin-top: 2rem;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background-color: var(--primary-color);
            color: #fff;
        }

        img {
            width: 100px;
            height: auto;
        }

        h2 {
            margin-top: 2rem;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">{{ isset($banner) ? 'Edit Banner' : 'Tambah Banner' }}</h2>

    <form action="{{ isset($banner) ? route('admin.banners.update', $banner->id) : route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($banner))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="image">Gambar Banner</label>
            <input type="file" name="image" {{ isset($banner) ? '' : 'required' }}>
            @if(isset($banner) && $banner->image)
                <p class="mt-2">Gambar saat ini:</p>
                <img src="{{ asset('storage/' . $banner->image) }}">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($banner) ? 'Update' : 'Tambah' }}</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
    </form>

    <h2>Gambar yang sedang dipakai di banner</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Preview</th>
                <th>Nama File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $ban)
                <tr>
                    <td>{{ $ban->id }}</td>
                    <td><img src="{{ asset('gambar/' . $ban->image) }}"></td>
                    <td>{{ $ban->image }}</td>
                    <td>
                        <form action="{{ route('admin.banners.setActive', $ban->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-warning">Ganti Banner</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
