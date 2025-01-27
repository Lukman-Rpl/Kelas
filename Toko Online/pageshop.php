<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Produk</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" >
    <style>
         .card-img-top {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

    </style>
</head>
<body>

    <!-- Header -->
    <header class="bg-light py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <nav>
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="pageshop.php">Toko</a></li> <!-- Tautan ke Pageshop -->
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Produk -->
    <section id="produk" class="container my-4">
        <h2>Daftar Produk</h2>
        <div class="row">
            <!-- Produk 1 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="images/Ran.jpg" class="card-img-top" alt="Produk 1">
                    <div class="card-body">
                        <h5 class="card-title">Nama Produk 1</h5>
                        <p class="card-text">Harga: Rp 100.000</p>
                        <a href="#" class="btn btn-primary">Beli Sekarang</a>
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
                        <a href="#" class="btn btn-primary">Beli Sekarang</a>
                    </div>
                </div>
            </div>
            <!-- Produk 3 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="images/3.jpg" class="card-img-top" alt="Produk 3">
                    <div class="card-body">
                        <h5 class="card-title">Nama Produk 3</h5>
                        <p class="card-text">Harga: Rp 150.000</p>
                        <a href="#" class="btn btn-primary">Beli Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-light py-4">
        <div class="container">
            <p class="text-center">© 2025 Toko Online</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqT9tXQ7y5p2UfjYy7hJr59/ZmZQ9ygV91Ds3W2v2Ds1z" crossorigin="anonymous"></script>
</body>
</html>
