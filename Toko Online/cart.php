<?php 
session_start(); // Mulai session

// Menambahkan data dummy ke dalam keranjang jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();

    // Menambahkan produk dummy (contoh produk sementara)
    $_SESSION['cart'][] = array(
        'product_id' => 1,
        'product_name' => 'Produk Dummy 1',
        'price' => 100000
    );
    $_SESSION['cart'][] = array(
        'product_id' => 2,
        'product_name' => 'Produk Dummy 2',
        'price' => 200000
    );
    $_SESSION['cart'][] = array(
        'product_id' => 3,
        'product_name' => 'Produk Dummy 3',
        'price' => 150000
    );
}

// Cek jika ada item yang ditambahkan ke keranjang
if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['product_id'];
    $product_name = $_GET['product_name'];
    $price = $_GET['price'];

    // Tambahkan produk ke keranjang
    $_SESSION['cart'][] = array(
        'product_id' => $product_id,
        'product_name' => $product_name,
        'price' => $price
    );
}

// Menghitung total harga keranjang
$total = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'];
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Header -->
    <header class="bg-light py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <nav>
                    <ul class="nav">
                        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="pageshop.php">Produk</a></li>
                        <li class="nav-item"><a class="nav-link" href="cart.php">Keranjang</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Keranjang Belanja -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Keranjang Belanja</h2>
        
        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $item['product_name']; ?></td>
                            <td>Rp <?= number_format($item['price'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h3 class="text-end">Total: Rp <?= number_format($total, 0, ',', '.'); ?></h3>
        <?php else: ?>
            <p class="text-center">Keranjang Anda kosong.</p>
        <?php endif; ?>

        <!-- Tombol Checkout -->
        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
            <div class="text-center">
                <a href="checkout.php" class="btn btn-success">Checkout</a>
            </div>
        <?php endif; ?>
    </section>

    <!-- Footer -->
    <footer class="bg-light py-4">
        <div class="container">
            <p class="text-center">© 2025 Toko Online</p>
        </div>
    </footer>
</body>
</html>
