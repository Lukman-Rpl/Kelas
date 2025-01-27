<?php    
session_start();

// Jika keranjang kosong
$cartEmpty = empty($_SESSION['cart']);
if ($cartEmpty) {
    $cartItems = [];
} else {
    // Koneksi ke database
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'dbdvc';
    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Mengambil produk yang ada di keranjang
    $cartItems = [];
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $sql = "SELECT id, title, price, image_url FROM products WHERE id = $productId";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            $product['quantity'] = $quantity;
            $cartItems[] = $product;
        }
    }

    // Menangani penghapusan produk dari keranjang
    if (isset($_GET['remove'])) {
        $productIdToRemove = $_GET['remove'];
        unset($_SESSION['cart'][$productIdToRemove]); // Menghapus produk dari keranjang
        header("Location: keranjang.php"); // Mengarahkan kembali ke halaman keranjang setelah menghapus produk
        exit;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Retro DVD & VCD Store</title>
    <style>
        :root {
            --primary-color: #1a237e;
            --secondary-color: #c62828;
            --text-color: #333;
            --bg-color: #fafafa;
            --card-bg: #ffffff;
            --accent-color: #ffeb3b;
        }

        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: var(--bg-color);
            color: var(--text-color);
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .cart-items {
            margin-top: 20px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .cart-item img {
            width: 120px;
            height: 60px;
            object-fit: cover;
        }

        .total {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .back-btn, .checkout-btn {
            background-color: var(--secondary-color);
            color: white;
            padding: 10px 20px;
            border: 2px solid #000;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 3px 3px 0px #000;
            margin-top: 20px;
            text-align: center;
            display: inline-block;
        }

        .back-btn:hover, .checkout-btn:hover {
            background: #b71c1c;
            transform: translateY(2px);
            box-shadow: 1px 1px 0px #000;
        }

        .remove-btn {
            background-color: #ff4d4d;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 2px 2px 0px #000;
            height: 20px;
            width: 50px;
            text-decoration: none;
        }

        .remove-btn:hover {
            background-color: #ff3333;
        }

        .instruction {
            margin-top: 20px;
            font-size: 16px;
            font-weight: normal;
            color: #333;
            background-color: #fff3cd;
            border: 1px solid #ffecb5;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Keranjang Belanja</h1>
        </header>

        <?php if ($cartEmpty): ?>
            <div class="instruction">
                Keranjang Anda kosong.
            </div>
        <?php else: ?>
            <div class="cart-items">
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <img src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['title']; ?>">
                        <div>
                            <h4><?php echo $item['title']; ?></h4>
                            <p>Jumlah: <?php echo $item['quantity']; ?></p>
                            <p>Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></p>
                        </div>
                        <!-- Tombol Hapus Produk -->
                        <a href="?remove=<?php echo $item['id']; ?>" class="remove-btn">Hapus</a>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="total">
                Total: Rp <?php echo number_format(array_sum(array_map(function($item) {
                    return $item['price'] * $item['quantity'];
                }, $cartItems)), 0, ',', '.'); ?>
            </div>

            <!-- Instruksi untuk pengambilan atau pengiriman -->
            <div class="instruction">
                Jika ingin ambil silakan datang ke toko Luki, jika ingin dihantar silakan tekan tombol checkout.
            </div>
        <?php endif; ?>

        <!-- Tombol Kembali ke Beranda -->
        <form action="index.php" method="get">
            <button type="submit" class="back-btn">Kembali ke Beranda</button>
        </form>

        <!-- Tombol Checkout -->
        <form action="checkout.php" method="get">
            <button type="submit" class="checkout-btn">Checkout</button>
        </form>
    </div>
</body>
</html>
