<?php
session_start(); // Mulai session

// Cek jika keranjang belanja ada isinya
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    header("Location: cart.php"); // Jika keranjang kosong, arahkan ke cart.php
    exit();
}

// Menghitung total harga keranjang
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'];
}

// Proses form ketika tombol 'Submit' ditekan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];

    // Simulasi pemrosesan pesanan
    // Di sini, Anda bisa menyimpan data pesanan ke database atau melakukan tindakan lain.
    // Untuk sementara kita simulasikan dengan menampilkan data pesanan.

    echo "<h3>Pesanan Anda Telah Diterima</h3>";
    echo "<p>Nama: $name</p>";
    echo "<p>Alamat: $address</p>";
    echo "<p>Metode Pembayaran: $payment_method</p>";
    echo "<p>Total Harga: Rp " . number_format($total, 0, ',', '.') . "</p>";
    
    // Kosongkan keranjang setelah checkout
    unset($_SESSION['cart']);
    exit();
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Toko Online</title>
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

    <!-- Checkout -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Checkout</h2>

        <!-- Tabel Keranjang Belanja -->
        <h4>Daftar Produk di Keranjang</h4>
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

        <!-- Form Checkout -->
        <h4 class="mt-5">Informasi Pembeli</h4>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat Pengiriman</label>
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                <select class="form-select" id="payment_method" name="payment_method" required>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="COD">Cash On Delivery (COD)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Proses Pembayaran</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="bg-light py-4">
        <div class="container">
            <p class="text-center">© 2025 Toko Online</p>
        </div>
    </footer>

</body>
</html>