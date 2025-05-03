<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Ayam Goreng Jos</title>
</head>
<body>
    <h1>Menu Ayam Goreng Jos</h1>
    <a href="{{ route('menus.create') }}">Tambah Menu</a>
    <ul>
        @foreach($menus as $menu)
            <li>
                <h2>{{ $menu->name }}</h2>
                <p>{{ $menu->description }}</p>
                <p>Harga: Rp. {{ number_format($menu->price, 2) }}</p>
                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" width="200">
            </li>
        @endforeach
    </ul>
</body>
</html>
