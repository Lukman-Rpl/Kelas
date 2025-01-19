<?php

$host = 'localhost'; // Change to your database host if it's different
$username = 'root';  // Your database username
$password = '';      // Your database password
$dbname = 'dbgpt'; // Your database name

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
include 'Barang.php';

$barang = new Barang($conn);
$id = $_GET['id'] ?? null;
$nama_barang = $harga = $stok = $gambar = "";

if ($id) {
    $query = "SELECT * FROM barang WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $nama_barang = $row['nama_barang'];
    $harga = $row['harga'];
    $stok = $row['stok'];
    $gambar = $row['gambar'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Upload gambar
    $gambar_baru = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $gambar_path = "uploads/" . basename($gambar_baru);
    move_uploaded_file($gambar_tmp, $gambar_path);

    if ($id) {
        $barang->update($id, $nama_barang, $harga, $stok, $gambar_baru);
    } else {
        $barang->create($nama_barang, $harga, $stok, $gambar_baru);
    }

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
 
</body>
</html>
