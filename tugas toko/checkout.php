<?php 
session_start();

// Jika keranjang kosong
if (empty($_SESSION['cart'])) {
    echo "Keranjang Anda kosong.";
    exit;
}

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

// Menangani pengisian data checkout (misalnya nama dan alamat)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'], $_POST['address'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];

    // Proses checkout - Simpan data pesanan
    $totalAmount = array_sum(array_map(function($item) {
        return $item['price'] * $item['quantity'];
    }, $cartItems));

    // Simpan transaksi ke database atau lakukan pemrosesan lebih lanjut
    $sql = "INSERT INTO orders (customer_name, customer_address, total_amount) VALUES ('$name', '$address', '$totalAmount')";
    if ($conn->query($sql) === TRUE) {
        // Hapus keranjang setelah berhasil checkout
        unset($_SESSION['cart']);
        echo "Checkout berhasil! Terima kasih telah berbelanja.";
    } else {
        echo "Terjadi kesalahan saat memproses checkout: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Retro DVD & VCD Store</title>
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

        .cart-items {
            margin-bottom: 2rem;
        }

        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            background-color: var(--card-bg);
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 1rem;
        }

        .cart-item h4 {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
        }

        .cart-item p {
            font-size: 1rem;
            color: var(--primary-color);
        }

        .total {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 2rem;
            color: var(--secondary-color);
        }

        .form-container {
            background-color: var(--card-bg);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
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
            width: 100%;
            box-shadow: 3px 3px 0px #000;
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

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }

            .form-container {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Checkout</h1>
        </header>

        <div class="cart-items">
            <?php foreach ($cartItems as $item): ?>
                <div class="cart-item">
                    <img src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['title']; ?>">
                    <div>
                        <h4><?php echo $item['title']; ?></h4>
                        <p>Jumlah: <?php echo $item['quantity']; ?></p>
                        <p>Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="total">
            Total: Rp <?php echo number_format(array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $cartItems)), 0, ',', '.'); ?>
        </div>

        <!-- Form Checkout -->
        <div class="form-container">
            <form method="POST" action="checkout.php">
                <label for="name">Nama Lengkap:</label>
                <input type="text" id="name" name="name" required>

                <label for="address">Alamat Pengiriman:</label>
                <textarea id="address" name="address" required></textarea>

                <button type="submit">Proses Checkout</button>
            </form>
        </div>

        <!-- Tombol Kembali ke Beranda -->
        <form action="index.php" method="get">
            <button type="submit" class="back-btn">Kembali ke Beranda</button>
        </form>
    </div>
</body>
</html>