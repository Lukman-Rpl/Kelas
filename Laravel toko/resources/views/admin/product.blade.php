<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ isset($product) ? 'Edit Produk' : 'Tambah Produk' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        .header {
            background: linear-gradient(135deg, var(--primary-color), #303f9f);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }

        .header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .header p {
            text-align: center;
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .form-container {
            background-color: var(--card-bg);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .form-container label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        .form-container input,
        .form-container textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-container button {
            background-color: var(--secondary-color);
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
            box-shadow: 3px 3px 0px #000;
            width: 100%;
        }

        .form-container button:hover {
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
        }

        .back-btn:hover {
            background: #ff5252;
            transform: translateY(2px);
            box-shadow: 1px 1px 0px #000;
        }

        .custom-secondary {
            margin-top: 10px;
    background-color: #007bff; /* biru Bootstrap */
    color: #fff;
    border: none;
    text-decoration: none;
    padding: 8px 16px;
    border-radius: 4px;
    display: inline-block;
    text-align: center;
    transition: background-color 0.3s ease;
    width: 100%
}

.custom-secondary:hover {
    background-color: #0056b3;
    color: #fff;
    text-decoration: none;
}

img{
    width: 100px;
    height: 100px;
}

    </style>
</head>
<body>

<div class="main-wrapper">
    <div class="form-container">
        <h2>{{ isset($product) ? 'Edit Produk' : 'Tambah Produk' }}</h2>

        <form 
            action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}" 
            method="POST" 
            enctype="multipart/form-data"
        >
            @csrf
            @if(isset($product))
                @method('PUT')
            @endif

            <label for="title" class="form-label">Judul Produk</label>
            <input type="text" class="form-control" name="title" value="{{ old('title', $product->title ?? '') }}" required>

            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description', $product->description ?? '') }}</textarea>

            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control" name="price" value="{{ old('price', $product->price ?? '') }}" required>

            <label for="image_url" class="form-label">Gambar Produk</label>
            <input type="file" class="form-control" name="image_url">
            @if(isset($product) && $product->image_url)
                <p class="mt-2">Gambar saat ini:</p>
                <img src="{{ asset('storage/' . $product->image_url) }}" width="150">
            @endif

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update' : 'Tambah' }}</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary custom-secondary">Kembali</a>
            </div>            
        </form>
        @if(isset($products) && $products->count())
    <hr style="margin: 40px 0;">
    <h3 style="margin-bottom: 20px;">Daftar Produk yang Sudah Ada</h3>
    <table style="width: 100%; border-collapse: collapse;">
        <thead style="background-color: #f0f0f0;">
            <tr>
                <th style="padding: 10px; border: 1px solid #ccc;">Nama Produk</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Stok</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Gambar</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Deskripsi</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $prod)
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;">{{ $prod->title }}</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">{{ $prod->stock ?? 'N/A' }}</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">
                    <img src="{{ asset('gambar/' . $prod->image_url) }}" alt="{{ $prod->title }}" class="product-image-horizontal"></td>
                    <td style="padding: 10px; border: 1px solid #ccc;">{{ $prod->description }}</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">Rp {{ number_format($prod->price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

    </div>
</div>

</body>
</html>
