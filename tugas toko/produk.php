<?php  
session_start();
// Cek apakah pengguna sudah login dan apakah dia admin
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    // Jika belum login atau bukan admin, arahkan ke halaman login_register.php
    header("Location: login_register.php?redirect=produk.php"); // Redirect ke halaman produk
    exit();
}


$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'dbdvc'; // Ganti dengan nama database Anda

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menambah produk ke database jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title'], $_POST['description'], $_POST['price'], $_FILES['image']['name'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Menangani upload file gambar
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
                    // Menyimpan produk ke database dengan prepared statement
                    $stmt = $conn->prepare("INSERT INTO products (title, description, price, image_url) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssis", $title, $description, $price, $imageDestination); // "s" untuk string, "i" untuk integer

                    if ($stmt->execute()) {
                        echo "Produk berhasil ditambahkan!";
                    } else {
                        echo "Error: " . $conn->error;
                    }
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
}

// Menghapus produk jika tombol hapus ditekan
if (isset($_GET['delete'])) {
    $productId = intval($_GET['delete']); // Mengamankan ID dengan intval
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId); // Bind parameter integer
    if ($stmt->execute()) {
        echo "Produk berhasil dihapus!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Menampilkan produk
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Retro DVD & VCD Store</title>
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
            margin: 0;
            padding: 0;
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
            border: 2px solid #000;
            box-shadow: 5px 5px 0px #000;
            margin-bottom: 30px;
        }

        .form-container {
            background-color: var(--card-bg);
            padding: 20px;
            border: 2px solid #000;
            box-shadow: 4px 4px 0px #000;
        }

        input[type="text"], input[type="number"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        button {
            background-color: var(--secondary-color);
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 3px 3px 0px #000;
        }

        button:hover {
            background-color: #b71c1c;
            transform: translateY(2px);
            box-shadow: 1px 1px 0px #000;
        }

        /* Tombol Kembali ke Beranda */
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

        /* Tabel Produk */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: var(--primary-color);
            color: white;
        }

        td img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Tambah Produk</h1>
        </header>

        <div class="form-container">
            <form method="POST" action="produk.php" enctype="multipart/form-data">
                <label for="title">Nama Produk:</label>
                <input type="text" id="title" name="title" required>

                <label for="description">Deskripsi Produk:</label>
                <textarea id="description" name="description" required></textarea>

                <label for="price">Harga Produk (Rp):</label>
                <input type="number" id="price" name="price" required>

                <label for="image">Gambar Produk:</label>
                <input type="file" id="image" name="image" accept="image/*" required>

                <button type="submit">Tambah Produk</button>
            </form>

            <!-- Tombol Kembali ke Beranda -->
            <form action="index.php" method="get">
                <button type="submit" class="back-btn">Kembali ke Beranda</button>
            </form>
        </div>

        <!-- Tabel Produk -->
        <div class="form-container">
            <h2>Daftar Produk</h2>
            <table>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Opsi</th>
                </tr>
                <?php 
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='" . $row['image_url'] . "' alt='" . $row['title'] . "'></td>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>Rp " . number_format($row['price'], 0, ',', '.') . "</td>";
                        echo "<td> <a href='edit_produk.php?id=" . $row['id'] . "'>Edit</a> | <a href='produk.php?delete=" . $row['id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus produk ini?\")'>Hapus</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada produk.</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>

<?php
// Menutup koneksi setelah semua operasi selesai
$conn->close();
?>
