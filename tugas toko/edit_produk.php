<?php 
session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'dbdvc'; // Ganti dengan nama database Anda

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);
    // Ambil data produk berdasarkan ID
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form dan update ke database
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Cek jika ada gambar baru yang diupload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image = $_FILES['image'];
        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];
        $imageError = $image['error'];
        $imageSize = $image['size'];

        // Memeriksa apakah file gambar diupload dengan benar
        if ($imageError === 0) {
            $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($imageExtension, $allowedExtensions)) {
                // Validasi ukuran gambar (maksimal 2MB)
                if ($imageSize > 2 * 1024 * 1024) {
                    echo "Ukuran gambar terlalu besar. Maksimum 2MB.";
                } else {
                    // Membuat nama file yang unik untuk menghindari konflik
                    $newImageName = uniqid('', true) . '.' . $imageExtension;
                    $imageDestination = 'uploads/' . $newImageName;

                    // Memindahkan file gambar ke folder "uploads"
                    if (move_uploaded_file($imageTmpName, $imageDestination)) {
                        // Update URL gambar di database
                        $stmt = $conn->prepare("UPDATE products SET title = ?, description = ?, price = ?, image_url = ? WHERE id = ?");
                        $stmt->bind_param("ssisi", $title, $description, $price, $imageDestination, $productId);
                        $stmt->execute();
                        echo "<p>Produk berhasil diperbarui dengan gambar baru!</p>";
                    } else {
                        echo "Gagal mengupload gambar.";
                    }
                }
            } else {
                echo "Format file gambar tidak didukung. Harap unggah file dengan ekstensi JPG, JPEG, PNG, atau GIF.";
            }
        } else {
            echo "Terjadi kesalahan saat mengupload gambar.";
        }
    } else {
        // Update produk tanpa mengganti gambar
        $stmt = $conn->prepare("UPDATE products SET title = ?, description = ?, price = ? WHERE id = ?");
        $stmt->bind_param("ssii", $title, $description, $price, $productId);
        $stmt->execute();
        echo "<p>Produk berhasil diperbarui!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
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

        .form-container {
            background-color: var(--card-bg);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
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
            box-shadow: 3px 3px 0px #000;
            width: 100%;
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
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Edit Produk</h1>
            <p>Perbarui informasi produk di bawah ini</p>
        </header>

        <div class="form-container">
            <form method="POST" action="" enctype="multipart/form-data">
                <label for="title">Nama Produk:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($product['title']); ?>" required>

                <label for="description">Deskripsi Produk:</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>

                <label for="price">Harga Produk (Rp):</label>
                <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>

                <label for="image">Pilih Gambar Baru (Opsional):</label>
                <input type="file" id="image" name="image" accept="image/*">

                <button type="submit">Perbarui Produk</button>
            </form>
        </div>

        <form action="produk.php" method="get">
            <button type="submit" class="back-btn">Kembali ke Daftar Produk</button>
        </form>
    </div>
</body>
</html>

<?php
// Menutup koneksi setelah semua operasi selesai
$conn->close();
?>