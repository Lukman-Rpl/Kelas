<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu</title>
</head>
<body>
    <h1>Tambah Menu</h1>

    <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Nama Menu:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="price">Harga:</label>
        <input type="number" id="price" name="price" step="0.01" required><br><br>

        <label for="description">Deskripsi:</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="image">Gambar:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
