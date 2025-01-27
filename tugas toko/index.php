<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// PHP code remains the same as before
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'dbdvc';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT id, title, description, price, image_url FROM products";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['user'])) {
        header("Location: login_register.php");
        exit();
    }

    $productId = $_POST['product_id'];
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]++;
    } else {
        $_SESSION['cart'][$productId] = 1;
    }
}

$conn->close();
$totalItems = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;

$reviews = '';
if (file_exists('reviews.txt')) {
    $reviews = file_get_contents('reviews.txt');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classic Cinema Collection</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
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
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-info h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }

        .price {
            font-size: 1.2rem;
            color: var(--secondary-color);
            font-weight: 600;
            margin: 1rem 0;
        }

        .btn {
            background: var(--secondary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s ease;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
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
            <a href="index.php">Home</a>
            <a href="kontak.php">Reviews</a>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="#">Welcome, <?php echo $_SESSION['user']; ?></a>
                <a href="logout.php">Logout</a>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <a href="produk.php">Manage Products</a>
                <?php endif; ?>
            <?php else: ?>
                <a href="login_register.php">Login/Register</a>
            <?php endif; ?>
            <a href="keranjang.php">Cart <span class="cart-badge"><?php echo $totalItems; ?></span></a>
        </div>
    </nav>

    <div class="container">
        <div class="featured-section">
            <div class="featured-header">
                <h2>Featured Collections</h2>
                <p>Discover our carefully curated selection of classic films</p>
            </div>
        </div>

        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="<?php echo htmlspecialchars($product['image_url']); ?>" 
                         alt="<?php echo htmlspecialchars($product['title']); ?>" 
                         class="product-image">
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($product['title']); ?></h3>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                        <p class="price">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                        <form method="POST" action="">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <button type="submit" name="add_to_cart" class="btn">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="reviews-section">
            <h2>Customer Reviews</h2>
            <?php if (!empty($reviews)): ?>
                <div class="review">
                    <?php echo nl2br(htmlspecialchars($reviews)); ?>
                </div>
            <?php else: ?>
                <p>No reviews yet. Be the first to leave a review!</p>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2025 Classic Cinema Collection. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>