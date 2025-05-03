<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classic Cinema Collection</title>
    <style>
        :root {
            --primary-color: #1a237e;
            --secondary-color: #c62828;
            --text-color: #333;
            --bg-color: #fafafa;
            --card-bg: #ffffff;
            --accent-color: #gold;
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

        .navbar {
            background: white;
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .navbar a {
            color: var(--text-color);
            text-decoration: none;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
            font-weight: 600;
        }

        .navbar a:hover {
            color: var(--secondary-color);
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            padding: 2rem 0;
        }

        .product-card {
    background: var(--card-bg);
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    transition: transform 0.3s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.product-card:hover {
    transform: translateY(-5px);
}

.product-image {
    width: 100%;
    height: auto;
    aspect-ratio: 4 / 3; /* menjaga rasio agar seimbang */
    object-fit: contain; 
    background-color: #f0f0f0; /* fallback background jika gambar transparan */
    padding: 0.5rem;
    display: block;
    margin: 0 auto;
}

.product-info {
    padding: 1rem 1.2rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.product-info h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
    color: var(--primary-color);
    line-height: 1.3;
}

.product-info p {
    font-size: 0.95rem;
    margin-bottom: 0.5rem;
    color: #444;
}

.price {
    font-size: 1.1rem;
    color: var(--secondary-color);
    font-weight: 600;
    margin: 0.5rem 0;
}

.btn {
    background: var(--secondary-color);
    color: white;
    padding: 0.6rem 1rem;
    font-size: 0.9rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.3s ease;
    width: 100%;
    margin-top: auto;
}

.btn:hover {
    background: #b71c1c;
}

        .reviews-section {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            margin-top: 3rem;
        }

        .reviews-section h2 {
            font-family: 'Playfair Display', serif;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .featured-section {
            padding: 3rem 0;
            background: linear-gradient(135deg, #f5f5f5, #eeeeee);
            margin: 2rem 0;
        }

        .featured-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .featured-header h2 {
            font-family: 'Playfair Display', serif;
            color: var(--primary-color);
            font-size: 2rem;
        }

        .cart-badge {
            background: var(--secondary-color);
            color: white;
            padding: 0.2rem 0.5rem;
            border-radius: 50%;
            font-size: 0.8rem;
            margin-left: 0.5rem;
        }

        footer {
            background: var(--primary-color);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
            text-align: center;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }

            .nav-container {
                flex-direction: column;
                text-align: center;
            }

            .navbar a {
                display: block;
                padding: 0.5rem;
                margin: 0.5rem 0;
            }

            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            }
        }
        .banner-section {
    width: 100%;
    height: 300px; /* Tentukan tinggi banner */
    overflow: hidden; /* Sembunyikan bagian gambar yang keluar */
    position: relative;
    border: 2px solid #000;
    box-shadow: 5px 5px 0px #000;
    margin-bottom:50px ;
}

.banner-image-full {
    width: 100%;
    height: 100%;
    object-fit: cover; 
}


        .product-scroll-wrapper {
    display: flex;
    overflow-x: auto;
    gap: 1.5rem;
    padding-bottom: 1rem;
    scroll-snap-type: x mandatory;
    -webkit-overflow-scrolling: touch;
}

.product-card-horizontal {
    background: var(--card-bg);
    border-radius: 10px;
    min-width: 300px;
    max-width: 320px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    flex-shrink: 0;
    scroll-snap-align: start;
    display: flex;
    flex-direction: column;
}

.product-image-horizontal {
    width: 100%;
    aspect-ratio: 4 / 3;
    object-fit: contain;
    background-color: #f0f0f0;
    padding: 0.5rem;
}

.product-info-horizontal {
    padding: 1rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    flex-grow: 1;
}

.product-info-horizontal h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem;
    color: var(--primary-color);
    margin-bottom: 0.3rem;
}

.price {
    font-size: 1.1rem;
    color: var(--secondary-color);
    font-weight: 600;
    margin: 0.5rem 0;
}

.btn {
    margin-top: auto;
}

    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <h1>Classic Cinema Collection</h1>
            <p>Where Timeless Films Find Their Home</p>
        </div>
    </header>

    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('ulasan.index') }}">Reviews</a>
            @if(session('user'))
                <a href="#">Welcome, {{ session('user') }}</a>
                <a href="{{ route('user.logout') }}">Logout</a>
                @if(session('role') == 'admin')
                    <a href="/produk">Manage Products</a>
                @endif
            @else
                <a href="{{ route('user.login') }}">Login/Register</a>
            @endif
            <a href="{{ route('cart.index') }}">Cart <span class="cart-badge">{{ $totalItems }}</span></a>
        </div>
    </nav>

    <div class="container">
        <div class="featured-section">
            <div class="featured-header">
                <h2>Featured Collections</h2>
                <p>Discover our carefully curated selection of classic films</p>
            </div>
        </div>

{{-- Banner Section --}}
<div class="banner-section">
    <img src="{{ asset('gambar/banner.jpeg') }}" alt="Promo Banner" class="banner-image-full">
</div>

        <div class="product-scroll-wrapper">
            @foreach($products as $product)
                <div class="product-card-horizontal">
                    <img src="{{ asset('gambar/' . $product->image_url) }}" alt="{{ $product->title }}" class="product-image-horizontal">
                    <div class="product-info-horizontal">
                        <h3>{{ $product->title }}</h3>
                        <p>{{ $product->description }}</p>
                        <p><strong>Kategori:</strong> {{ strtoupper($product->category) }}</p>
                        <p><strong>Stok:</strong> {{ $product->stock }}</p>
                        <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        
                        @if($product->stock > 0)
                            <form method="POST" action="{{ route('add.to.cart') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn">Add to Cart</button>
                            </form>
                        @else
                            <button class="btn" disabled style="background-color: gray;">Out of Stock</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="reviews-section">
            <h2>📢 Ulasan Pengguna Sebelumnya</h2>
            @if ($ulasan->count())
            @foreach ($ulasan as $u)
                <div class="form-container" style="margin-bottom: 20px;">
                    <p><strong>👤 {{ $u->name }}</strong></p>
                    <p>📧 {{ $u->email }}</p>
                    <p>⭐ {!! str_repeat('★', $u->rating) . str_repeat('☆', 5 - $u->rating) !!}</p>
                    <p>💬 {{ $u->message }}</p>
                    <p><em>🕒 {{ $u->created_at->format('d M Y H:i') }}</em></p>
                </div>
            @endforeach
        
            {{-- Tambahkan pagination link --}}
            <div style="text-align: center; margin-top: 20px;">
                {{ $ulasan->links() }}
            </div>
        @else
            <p>Belum ada ulasan dari pelanggan.</p>
        @endif
                    
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2025 Classic Cinema Collection. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>