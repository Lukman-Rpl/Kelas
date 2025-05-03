<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayam Goreng Jos</title>
    <!-- Link to Bootstrap CSS -->
    
    <style>
        /* Custom Styles */
        /* Container styling */
.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
}

/* Row styling */
.row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

/* Col styling (jika belum pakai Bootstrap) */
.col-md-4 {
    flex: 1 1 calc(33.333% - 20px);
    box-sizing: border-box;
}

/* Responsive layout */
@media (max-width: 768px) {
    .col-md-4 {
        flex: 1 1 calc(50% - 20px);
    }
}

@media (max-width: 480px) {
    .col-md-4 {
        flex: 1 1 100%;
    }

    header h1 {
        font-size: 2rem;
    }

    nav a {
        display: block;
        margin: 10px 0;
    }
}

/* Card hover effect */
.menu-item {
    transition: transform 0.2s ease-in-out;
}
.menu-item:hover {
    transform: translateY(-5px);
}

/* Navbar container alignment */
nav .container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    padding: 0 20px;
}

/* User greeting style */
nav span {
    color: white;
    margin-right: 15px;
    font-weight: bold;
}

/* Footer fix for responsive */
@media (max-width: 768px) {
    footer {
        padding: 10px;
        font-size: 14px;
    }
}

        
        /* Body styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        /* Navbar styles */
        nav {
            background-color: #ff9f00; /* Ayam Goreng Jos primary color */
            padding: 10px 0;
        }
        nav a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            margin-right: 20px;
        }
        nav a:hover {
            text-decoration: underline;
        }

        /* Header styles */
        header {
            background-color: #ff9f00;
            color: white;
            text-align: center;
            padding: 50px 0;
        }
        header h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        header p {
            font-size: 1.2rem;
        }

        /* Menu container styles */
        .menu-container {
            margin-top: 30px;
        }
        /* Buat card lebih kecil */
.menu-item {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    margin-bottom: 15px;
    overflow: hidden;
    padding: 10px;
    font-size: 0.9rem; 
}

/* Gambar jadi lebih ramping */
.menu-item img {
    height: 150px;
}

/* Padding body lebih kecil */
.menu-item .card-body {
    padding: 15px;
}

/* Judul dan teks dibuat lebih kecil */
.menu-item h3 {
    font-size: 1.2rem;
    margin-bottom: 10px;
}

.menu-item p {
    font-size: 0.9rem;
    margin-bottom: 10px;
}

/* Ukuran harga juga dikecilkan */
.menu-item .price {
    font-size: 1.1rem;
}

/* Tombol disesuaikan */
.btn-add-to-order {
    font-size: 14px;
    padding: 8px 16px;
    background-color: #e4fa23;
}
.btn-add-to-order:hover {
     background-color: #e68900;    
}

        /* Footer styles */
        footer {
            background-color: #ff9f00;
            color: white;
            text-align: center;
            padding: 20px;
            position: fixed;
            width: 100%;
            bottom: 0;
            height: 10px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <div class="container">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/chat') }}">Chat</a>
            <a href="{{ url('/order') }}">Order</a>
            @guest
                <a href="{{ url('/login') }}">Login</a>
                <a href="{{ url('/register') }}">Register</a>
            @endguest
            @auth
                <span>Hello, {{ Auth::user()->name }}</span>
                <a href="{{ route('logout') }}">Logout</a>
            @endauth
        </div>
    </nav>
    <!-- Header -->
    <header>
        <h1>Selamat datang di Ayam Goreng Jos</h1>
        <p>Temukan menu terbaik untuk Anda</p>
    </header>

  <!-- Menu Items -->
  <div class="container menu-container">
      <div class="row">
          @foreach($menus as $menu)
          <div class="col-md-4 mb-4">
              <div class="menu-item card">
                  <img src="{{ asset('gambar/' . $menu->image) }}" alt="{{ $menu->name }}">
                  <div class="card-body">
                      <h3>{{ $menu->name }}</h3>
                      <p>{{ $menu->description }}</p>
                      <p class="price">Rp. {{ number_format($menu->price, 2) }}</p>
                      <form action="{{ route('order.addToCart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        @auth
                            <button type="submit" class="btn-add-to-order">Tambah ke Pesanan</button>
                        @endauth
                        @guest
                            <a href="{{ route('login') }}" class="btn-add-to-order">Login untuk Menambah Pesanan</a>
                        @endguest
                    </form>                    
                  </div>
              </div>
          </div>
          @endforeach
      </div>
  </div>

    <!-- Footer -->
    <footer>
        <p>© 2025 Ayam Goreng Jos - Semua Hak Dilindungi</p>
    </footer>

</body>
</html>
