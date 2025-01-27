<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
    <!-- Menambahkan CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        /* CSS untuk Banner Dinamis */
        #banner .carousel-inner {
            position: relative;
            overflow: hidden;
        }

        /* Membuat gambar responsif dan memiliki tinggi yang konsisten */
        .carousel-item img {
            width: 100%;
            height: 500px; /* Tentukan tinggi gambar tetap */
            object-fit: cover; /* Memastikan gambar tidak terdistorsi dan tetap proporsional */
            object-position: center; /* Menjaga agar gambar terpusat */
        }

        /* Efek transisi lebih halus */
        .carousel-item {
            transition: transform 0.5s ease-in-out;
        }

        /* Menambahkan border-radius untuk sudut yang lebih halus */
        .carousel-inner {
            border-radius: 10px;
        }

        /* Menambahkan shadow pada gambar untuk kesan depth */
        .carousel-item img {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Mengubah ukuran tombol navigasi */
        .carousel-control-prev, .carousel-control-next {
            width: 40px; /* Lebar tombol */
            height: 40px; /* Tinggi tombol */
        }

        .carousel-control-prev-icon, .carousel-control-next-icon {
            width: 20px; /* Lebar ikon */
            height: 20px; /* Tinggi ikon */
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="bg-light py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Menu Navigasi -->
                <nav>
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="pageshop.php">Produk</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">Tentang Kami</a></li>
                        <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                    </ul>
                </nav>
                <!-- Kolom Pencarian -->
                <div>
                    <input type="text" class="form-control" placeholder="Cari Produk...">
                </div>
                <!-- Register dan Login -->
                <div>
                    <a class="btn btn-outline-primary btn-sm" href="register.php">Register</a>
                    <a class="btn btn-outline-primary btn-sm" href="login.php">Login</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Banner Dinamis yang Ditingkatkan -->
    <section id="banner" class="container my-4">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <!-- Indikator -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            
            <!-- Wrapper untuk slides -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/tv.jpeg" class="d-block w-100" alt="Banner 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Promo Spesial</h5>
                        <p>Dapatkan diskon hingga 50% untuk pembelian pertama Anda</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/logo.jpeg" class="d-block w-100" alt="Banner 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Koleksi Terbaru</h5>
                        <p>Temukan berbagai produk terbaru dengan kualitas terbaik</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/ran.jpg" class="d-block w-100" alt="Banner 3">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Gratis Ongkir</h5>
                        <p>Nikmati gratis ongkir untuk setiap pembelian di atas Rp 500.000</p>
                    </div>
                </div>
            </div>

            <!-- Kontrol -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- Produk -->
    <section id="produk" class="container my-4">
        <div class="row">
            <!-- Produk 1 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="images/Ran.jpg" class="card-img-top" alt="Produk 1">
                    <div class="card-body">
                        <h5 class="card-title">Nama Produk 1</h5>
                        <p class="card-text">Harga: Rp 100.000</p>
                        <a href="cart.php?add_to_cart=1&product_name=Produk%201&price=100000" class="btn btn-primary">Beli Sekarang</a>
                    </div>
                </div>
            </div>
            <!-- Produk 2 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="images/seven samurai.jpeg" class="card-img-top" alt="Produk 2">
                    <div class="card-body">
                        <h5 class="card-title">Nama Produk 2</h5>
                        <p class="card-text">Harga: Rp 200.000</p>
                        <a href="cart.php?add_to_cart=2&product_name=Produk%202&price=200000" class="btn btn-primary">Beli Sekarang</a>
                    </div>
                </div>
            </div>
            <!-- Produk 3 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="images/The Hidden fortress.jpeg" class="card-img-top" alt="Produk 3">
                    <div class="card-body">
                        <h5 class="card-title">Nama Produk 3</h5>
                        <p class="card-text">Harga: Rp 150.000</p>
                        <a href="cart.php?add_to_cart=3&product_name=Produk%203&price=150000" class="btn btn-primary">Beli Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-light py-4">
        <div class="container">
            <div class="row">
                <!-- Menu Footer -->
                <div class="col-md-3">
                    <ul class="list-unstyled">
                        <li><a href="#">Menu</a></li>
                        <li><a href="#">Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <!-- Pembayaran -->
                <div class="col-md-3">
                    <h5>Pembayaran</h5>
                    <ul class="list-unstyled">
                        <li>Transfer Bank</li>
                        <li>COD</li>
                    </ul>
                </div>
                <!-- Media Sosial -->
                <div class="col-md-3">
                    <h5>Media Sosial</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">Twitter</a></li>
                    </ul>
                </div>
                <!-- Kontak -->
                <div class="col-md-3">
                    <h5>Kontak</h5>
                    <p>Email: info@tokoonline.com</p>
                    <p>Telepon: 0800-1234-5678</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Menambahkan CDN Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
